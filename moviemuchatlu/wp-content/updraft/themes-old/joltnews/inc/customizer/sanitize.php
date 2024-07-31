<?php
/**
* Custom Functions.
*
* @package JoltNews
*/


if( !function_exists( 'joltnews_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_sidebar_option( $joltnews_input ){

        $joltnews_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $joltnews_input,$joltnews_metabox_options ) ){

            return $joltnews_input;

        }

        return;

    }

endif;

if( !function_exists( 'joltnews_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_single_pagination_layout( $joltnews_input ){

        $joltnews_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $joltnews_input,$joltnews_single_pagination ) ){

            return $joltnews_input;

        }

        return;

    }

endif;

if( !function_exists( 'joltnews_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_archive_layout( $joltnews_input ){

        $joltnews_archive_option = array( 'default','full','grid' );
        if( in_array( $joltnews_input,$joltnews_archive_option ) ){

            return $joltnews_input;

        }

        return;

    }

endif;

if( !function_exists( 'joltnews_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function joltnews_sanitize_single_post_layout( $joltnews_input ){

        $joltnews_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $joltnews_input,$joltnews_single_layout ) ){

            return $joltnews_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'joltnews_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function joltnews_sanitize_checkbox( $joltnews_checked ) {

		return ( ( isset( $joltnews_checked ) && true === $joltnews_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'joltnews_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function joltnews_sanitize_select( $joltnews_input, $joltnews_setting ) {

        // Ensure input is a slug.
        $joltnews_input = sanitize_text_field( $joltnews_input );

        // Get list of choices from the control associated with the setting.
        $choices = $joltnews_setting->manager->get_control( $joltnews_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $joltnews_input, $choices ) ? $joltnews_input : $joltnews_setting->default );

    }

endif;

if ( ! function_exists( 'joltnews_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function joltnews_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = joltnews_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = joltnews_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = joltnews_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_post_cat_1' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  joltnews_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function joltnews_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function joltnews_sanitize_home_sections( $input ) {

    $home_sections = array(

        'main-banner' => esc_html__('Sub-Banner Block','joltnews'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','joltnews'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','joltnews'),
        'slider-blocks' => esc_html__('Slider Block','joltnews'),
        'content-rich-blocks' => esc_html__('Content Rich Block','joltnews'),
        'advertise-blocks' => esc_html__('Advertise Block','joltnews'),
        'home-widget-area' => esc_html__('Widgets Area Block','joltnews'),
        'you-may-like-blocks' => esc_html__('You May Like Block','joltnews'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function joltnews_sanitize_category( $input ) {

   $joltnews_post_category_list = joltnews_post_category_list();
    if ( array_key_exists( $input , $joltnews_post_category_list ) ) {
        return $input;
    }
    return '';

}

function joltnews_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'joltnews' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'joltnews' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'joltnews' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'joltnews' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}