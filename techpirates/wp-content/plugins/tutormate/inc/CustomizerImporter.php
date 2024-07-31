<?php
/**
 * Class for the customizer importer used in the One Click Demo Import plugin.
 *
 * Code is mostly from the Customizer Export/Import plugin.
 *
 * @see https://wordpress.org/plugins/customizer-export-import/
 * @package Tutormate
 */

namespace TUTORMATE;

defined( 'ABSPATH' ) || exit;

/**
 * Customizer Imoport class
 */
class CustomizerImporter {

	/**
	 * Import customizer from a DAT file, generated by the Customizer Export/Import plugin.
	 *
	 * @param string $customizer_import_file_path path to the customizer import file.
	 */
	public static function import( $customizer_import_file_path ) {
		$tutormate          = OneClickDemoImport::get_instance();
		$log_file_path = $tutormate->get_log_file_path();

		// Try to import the customizer settings.
		$results = self::import_customizer_options( $customizer_import_file_path );

		// Check for errors, else write the results to the log file.
		if ( is_wp_error( $results ) ) {
			$error_message = $results->get_error_message();

			// Add any error messages to the frontend_error_messages variable in TUTORMATE main class.
			$tutormate->append_to_frontend_error_messages( $error_message );

			// Write error to log file.
			Helpers::append_to_file(
				$error_message,
				$log_file_path,
				esc_html__( 'Importing customizer settings', 'tutormate' )
			);
		}
		else {
			// Add this message to log file.
			$log_added = Helpers::append_to_file(
				esc_html__( 'Customizer settings import finished!', 'tutormate' ),
				$log_file_path,
				esc_html__( 'Importing customizer settings' , 'tutormate' )
			);
		}
	}

	/**
	 * Imports uploaded mods and calls WordPress core customize_save actions so
	 * themes that hook into them can act before mods are saved to the database.
	 *
	 * Update: WP core customize_save actions were removed, because of some errors.
	 *
	 * @since 1.0.0
	 * @param string $import_file_path Path to the import file.
	 * @return void|WP_Error
	 */
	public static function import_customizer_options( $import_file_path ) {
		// Setup global vars.
		global $wp_customize;

		// Setup internal vars.
		$template = get_template();

		// Make sure we have an import file.
		if ( ! file_exists( $import_file_path ) ) {
			return new \WP_Error(
				'missing_cutomizer_import_file',
				sprintf(
					esc_html__( 'Error: The customizer import file is missing! File path: %s', 'tutormate' ),
					$import_file_path
				)
			);
		}

		// Get the upload data.
		$raw = Helpers::data_from_file( $import_file_path );

		// Make sure we got the data.
		if ( is_wp_error( $raw ) ) {
			return $raw;
		}

		$data = unserialize( $raw );

		// Data checks.
		if ( ! is_array( $data ) && ( ! isset( $data['template'] ) || ! isset( $data['mods'] ) ) ) {
			return new \WP_Error(
				'customizer_import_data_error',
				esc_html__( 'Error: The customizer import file is not in a correct format. Please make sure to use the correct customizer import file.', 'tutormate' )
			);
		}
		if ( $data['template'] !== $template ) {
			return new \WP_Error(
				'customizer_import_wrong_theme',
				esc_html__( 'Error: The customizer import file is not suitable for current theme. You can only import customizer settings for the same theme or a child theme.', 'tutormate' )
			);
		}

		// Import images.
		if ( apply_filters( 'tutormate_customizer_import_images', true ) ) {
			$data['mods'] = self::import_customizer_images( $data['mods'] );
		}

		// Import custom options.
		if ( isset( $data['options'] ) ) {
			// Require modified customizer options class.
			if ( ! class_exists( '\WP_Customize_Setting' ) ) {
				require_once ABSPATH . 'wp-includes/class-wp-customize-setting.php';
			}

			foreach ( $data['options'] as $option_key => $option_value ) {
				$option = new CustomizerOption( $wp_customize, $option_key, array(
					'default'    => '',
					'type'       => 'option',
					'capability' => 'edit_theme_options',
				) );

				$option->import( $option_value );
			}
		}

		// Should the customizer import use the WP customize_save* hooks?
		$use_wp_customize_save_hooks = apply_filters( 'tutormate_enable_wp_customize_save_hooks', false );

		if ( $use_wp_customize_save_hooks ) {
			do_action( 'customize_save', $wp_customize );
		}

		// Loop through the mods and save the mods.
		foreach ( $data['mods'] as $key => $val ) {
			if ( $use_wp_customize_save_hooks ) {
				do_action( 'customize_save_' . $key, $wp_customize );
			}

			set_theme_mod( $key, $val );
		}

		if ( $use_wp_customize_save_hooks ) {
			do_action( 'customize_save_after', $wp_customize );
		}
	}

	/**
	 * Helper function: Customizer import - imports images for settings saved as mods.
	 *
	 * @since 1.0.0
	 * @param array $mods An array of customizer mods.
	 * @return array The mods array with any new import data.
	 */
	private static function import_customizer_images( $mods ) {
		foreach ( $mods as $key => $val ) {
			if ( self::customizer_is_image_url( $val ) ) {
				$data = self::customizer_sideload_image( $val );
				if ( ! is_wp_error( $data ) ) {
					$mods[ $key ] = $data->url;

					// Handle header image controls.
					if ( isset( $mods[ $key . '_data' ] ) ) {
						$mods[ $key . '_data' ] = $data;
						update_post_meta( $data->attachment_id, '_wp_attachment_is_custom_header', get_stylesheet() );
					}
				}
			}
		}

		return $mods;
	}

	/**
	 * Helper function: Customizer import
	 * Taken from the core media_sideload_image function and
	 * modified to return an array of data instead of html.
	 *
	 * @since 1.0.0.
	 * @param string $file The image file path.
	 * @return array An array of image data.
	 */
	private static function customizer_sideload_image( $file ) {
		$data = new \stdClass();

		if ( ! function_exists( 'media_handle_sideload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		}
		if ( ! empty( $file ) ) {
			// Set variables for storage, fix file filename for query strings.
			preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
			$file_array = array();
			$file_array['name'] = basename( $matches[0] );

			// Download file to temp location.
			$file_array['tmp_name'] = download_url( $file );

			// If error storing temporarily, return the error.
			if ( is_wp_error( $file_array['tmp_name'] ) ) {
				return $file_array['tmp_name'];
			}

			// Do the validation and storage stuff.
			$id = media_handle_sideload( $file_array, 0 );

			// If error storing permanently, unlink.
			if ( is_wp_error( $id ) ) {
				unlink( $file_array['tmp_name'] );
				return $id;
			}

			// Build the object to return.
			$meta                = wp_get_attachment_metadata( $id );
			$data->attachment_id = $id;
			$data->url           = wp_get_attachment_url( $id );
			$data->thumbnail_url = wp_get_attachment_thumb_url( $id );
			$data->height        = $meta['height'];
			$data->width         = $meta['width'];
		}

		return $data;
	}

	/**
	 * Checks to see whether a string is an image url or not.
	 *
	 * @since 1.0.0
	 * @param string $string The string to check.
	 * @return bool Whether the string is an image url or not.
	 */
	private static function customizer_is_image_url( $string = '' ) {
		if ( is_string( $string ) ) {
			if ( preg_match( '/\.(jpg|jpeg|png|gif)/i', $string ) ) {
				return true;
			}
		}

		return false;
	}
}
