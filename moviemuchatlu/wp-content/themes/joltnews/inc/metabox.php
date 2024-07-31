<?php
/**
* Sidebar Metabox.
*
* @package JoltNews
*/
 
add_action( 'add_meta_boxes', 'joltnews_metabox' );

if( ! function_exists( 'joltnews_metabox' ) ):


    function  joltnews_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'joltnews' ),
            'joltnews_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'joltnews' ),
            'joltnews_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$joltnews_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'joltnews' ),
    'layout-2' => esc_html__( 'Banner Layout', 'joltnews' ),
);

$joltnews_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'joltnews' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'joltnews' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'joltnews' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'joltnews' ),
                ),
);

$joltnews_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'joltnews' ),
    'layout-1' => esc_html__( 'Simple Layout', 'joltnews' ),
    'layout-2' => esc_html__( 'Banner Layout', 'joltnews' ),
);

$joltnews_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'joltnews' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'joltnews' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'joltnews_post_metafield_callback' ) ):
    
    function joltnews_post_metafield_callback() {
        global $post, $joltnews_post_sidebar_fields, $joltnews_post_layout_options,  $joltnews_page_layout_options, $joltnews_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'joltnews_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'joltnews'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'joltnews'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'joltnews'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','joltnews'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $joltnews_post_sidebar = esc_html( get_post_meta( $post->ID, 'joltnews_post_sidebar_option', true ) ); 
                            if( $joltnews_post_sidebar == '' ){ $joltnews_post_sidebar = 'global-sidebar'; }

                            foreach ( $joltnews_post_sidebar_fields as $joltnews_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="joltnews_post_sidebar_option" value="<?php echo esc_attr( $joltnews_post_sidebar_field['value'] ); ?>" <?php if( $joltnews_post_sidebar_field['value'] == $joltnews_post_sidebar ){ echo "checked='checked'";} if( empty( $joltnews_post_sidebar ) && $joltnews_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $joltnews_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','joltnews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $joltnews_page_layout = esc_html( get_post_meta( $post->ID, 'joltnews_page_layout', true ) ); 
                                if( $joltnews_page_layout == '' ){ $joltnews_page_layout = 'layout-1'; }

                                foreach ( $joltnews_page_layout_options as $key => $joltnews_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="joltnews_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $joltnews_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $joltnews_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','joltnews'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $joltnews_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'joltnews_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="joltnews-header-overlay" name="joltnews_ed_header_overlay" value="1" <?php if( $joltnews_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="joltnews-header-overlay"><?php esc_html_e( 'Enable Header Overlay','joltnews' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','joltnews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $joltnews_post_layout = esc_html( get_post_meta( $post->ID, 'joltnews_post_layout', true ) ); 
                                if( $joltnews_post_layout == '' ){ $joltnews_post_layout = 'global-layout'; }

                                foreach ( $joltnews_post_layout_options as $key => $joltnews_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="joltnews_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $joltnews_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $joltnews_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','joltnews'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $joltnews_header_overlay = esc_html( get_post_meta( $post->ID, 'joltnews_header_overlay', true ) ); 
                                if( $joltnews_header_overlay == '' ){ $joltnews_header_overlay = 'global-layout'; }

                                foreach ( $joltnews_header_overlay_options as $key => $joltnews_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="joltnews_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $joltnews_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $joltnews_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','joltnews'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $joltnews_ed_feature_image = esc_html( get_post_meta( $post->ID, 'joltnews_ed_feature_image', true ) ); 
                            if (!isset( $_POST['joltnews_ed_feature_image'] )) {
                                $joltnews_ed_feature_image = get_theme_mod('ed_post_thumbnail');
                            }
                            ?>

                            <input type="checkbox" id="joltnews-ed-feature-image" name="joltnews_ed_feature_image" value="<?php echo $joltnews_default_feature_image; ?>" <?php if( $joltnews_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="joltnews-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','joltnews' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','joltnews'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','joltnews' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','joltnews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','joltnews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','joltnews'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','joltnews'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $joltnews_ed_post_views = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_views', true ) );
                    $joltnews_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_read_time', true ) );
                    $joltnews_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_like_dislike', true ) );
                    $joltnews_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_author_box', true ) );
                    $joltnews_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_social_share', true ) );
                    $joltnews_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_reaction', true ) );
                    $joltnews_ed_post_rating = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','joltnews'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-views" name="joltnews_ed_post_views" value="1" <?php if( $joltnews_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-views"><?php esc_html_e( 'Disable Post Views','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-read-time" name="joltnews_ed_post_read_time" value="1" <?php if( $joltnews_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-like-dislike" name="joltnews_ed_post_like_dislike" value="1" <?php if( $joltnews_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-author-box" name="joltnews_ed_post_author_box" value="1" <?php if( $joltnews_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-social-share" name="joltnews_ed_post_social_share" value="1" <?php if( $joltnews_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-reaction" name="joltnews_ed_post_reaction" value="1" <?php if( $joltnews_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','joltnews' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="joltnews-ed-post-rating" name="joltnews_ed_post_rating" value="1" <?php if( $joltnews_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="joltnews-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','joltnews' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'joltnews_save_post_meta' );

if( ! function_exists( 'joltnews_save_post_meta' ) ):

    function joltnews_save_post_meta( $post_id ) {

        global $post, $joltnews_post_sidebar_fields, $joltnews_post_layout_options, $joltnews_header_overlay_options,  $joltnews_page_layout_options;

        if ( !isset( $_POST[ 'joltnews_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['joltnews_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $joltnews_post_sidebar_fields as $joltnews_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'joltnews_post_sidebar_option', true ) ); 
                $new = isset( $_POST['joltnews_post_sidebar_option'] ) ? joltnews_sanitize_sidebar_option_meta( wp_unslash( $_POST['joltnews_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'joltnews_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'joltnews_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? joltnews_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $joltnews_post_layout_options as $joltnews_post_layout_option ) {  
            
            $joltnews_post_layout_old = esc_html( get_post_meta( $post_id, 'joltnews_post_layout', true ) ); 
            $joltnews_post_layout_new = isset( $_POST['joltnews_post_layout'] ) ? joltnews_sanitize_post_layout_option_meta( wp_unslash( $_POST['joltnews_post_layout'] ) ) : '';

            if ( $joltnews_post_layout_new && $joltnews_post_layout_new != $joltnews_post_layout_old ){

                update_post_meta ( $post_id, 'joltnews_post_layout', $joltnews_post_layout_new );

            }elseif( '' == $joltnews_post_layout_new && $joltnews_post_layout_old ) {

                delete_post_meta( $post_id,'joltnews_post_layout', $joltnews_post_layout_old );

            }
            
        }



        foreach ( $joltnews_header_overlay_options as $joltnews_header_overlay_option ) {  
            
            $joltnews_header_overlay_old = esc_html( get_post_meta( $post_id, 'joltnews_header_overlay', true ) ); 
            $joltnews_header_overlay_new = isset( $_POST['joltnews_header_overlay'] ) ? joltnews_sanitize_header_overlay_option_meta( wp_unslash( $_POST['joltnews_header_overlay'] ) ) : '';

            if ( $joltnews_header_overlay_new && $joltnews_header_overlay_new != $joltnews_header_overlay_old ){

                update_post_meta ( $post_id, 'joltnews_header_overlay', $joltnews_header_overlay_new );

            }elseif( '' == $joltnews_header_overlay_new && $joltnews_header_overlay_old ) {

                delete_post_meta( $post_id,'joltnews_header_overlay', $joltnews_header_overlay_old );

            }
            
        }



        $joltnews_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_feature_image', true ) ); 
        $joltnews_ed_feature_image_new = isset( $_POST['joltnews_ed_feature_image'] ) ? absint( wp_unslash( $_POST['joltnews_ed_feature_image'] ) ) : '';

        if ( $joltnews_ed_feature_image_new && $joltnews_ed_feature_image_new != $joltnews_ed_feature_image_old ){

            update_post_meta ( $post_id, 'joltnews_ed_feature_image', $joltnews_ed_feature_image_new );

        }elseif( '' == $joltnews_ed_feature_image_new && $joltnews_ed_feature_image_old ) {

            delete_post_meta( $post_id,'joltnews_ed_feature_image', $joltnews_ed_feature_image_old );

        }



        $joltnews_ed_post_views_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_views', true ) ); 
        $joltnews_ed_post_views_new = isset( $_POST['joltnews_ed_post_views'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_views'] ) ) : '';

        if ( $joltnews_ed_post_views_new && $joltnews_ed_post_views_new != $joltnews_ed_post_views_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_views', $joltnews_ed_post_views_new );

        }elseif( '' == $joltnews_ed_post_views_new && $joltnews_ed_post_views_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_views', $joltnews_ed_post_views_old );

        }



        $joltnews_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_read_time', true ) ); 
        $joltnews_ed_post_read_time_new = isset( $_POST['joltnews_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_read_time'] ) ) : '';

        if ( $joltnews_ed_post_read_time_new && $joltnews_ed_post_read_time_new != $joltnews_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_read_time', $joltnews_ed_post_read_time_new );

        }elseif( '' == $joltnews_ed_post_read_time_new && $joltnews_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_read_time', $joltnews_ed_post_read_time_old );

        }



        $joltnews_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_like_dislike', true ) ); 
        $joltnews_ed_post_like_dislike_new = isset( $_POST['joltnews_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_like_dislike'] ) ) : '';

        if ( $joltnews_ed_post_like_dislike_new && $joltnews_ed_post_like_dislike_new != $joltnews_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_like_dislike', $joltnews_ed_post_like_dislike_new );

        }elseif( '' == $joltnews_ed_post_like_dislike_new && $joltnews_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_like_dislike', $joltnews_ed_post_like_dislike_old );

        }



        $joltnews_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_author_box', true ) ); 
        $joltnews_ed_post_author_box_new = isset( $_POST['joltnews_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_author_box'] ) ) : '';

        if ( $joltnews_ed_post_author_box_new && $joltnews_ed_post_author_box_new != $joltnews_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_author_box', $joltnews_ed_post_author_box_new );

        }elseif( '' == $joltnews_ed_post_author_box_new && $joltnews_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_author_box', $joltnews_ed_post_author_box_old );

        }



        $joltnews_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_social_share', true ) ); 
        $joltnews_ed_post_social_share_new = isset( $_POST['joltnews_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_social_share'] ) ) : '';

        if ( $joltnews_ed_post_social_share_new && $joltnews_ed_post_social_share_new != $joltnews_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_social_share', $joltnews_ed_post_social_share_new );

        }elseif( '' == $joltnews_ed_post_social_share_new && $joltnews_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_social_share', $joltnews_ed_post_social_share_old );

        }



        $joltnews_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_reaction', true ) ); 
        $joltnews_ed_post_reaction_new = isset( $_POST['joltnews_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_reaction'] ) ) : '';

        if ( $joltnews_ed_post_reaction_new && $joltnews_ed_post_reaction_new != $joltnews_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_reaction', $joltnews_ed_post_reaction_new );

        }elseif( '' == $joltnews_ed_post_reaction_new && $joltnews_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_reaction', $joltnews_ed_post_reaction_old );

        }



        $joltnews_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'joltnews_ed_post_rating', true ) ); 
        $joltnews_ed_post_rating_new = isset( $_POST['joltnews_ed_post_rating'] ) ? absint( wp_unslash( $_POST['joltnews_ed_post_rating'] ) ) : '';

        if ( $joltnews_ed_post_rating_new && $joltnews_ed_post_rating_new != $joltnews_ed_post_rating_old ){

            update_post_meta ( $post_id, 'joltnews_ed_post_rating', $joltnews_ed_post_rating_new );

        }elseif( '' == $joltnews_ed_post_rating_new && $joltnews_ed_post_rating_old ) {

            delete_post_meta( $post_id,'joltnews_ed_post_rating', $joltnews_ed_post_rating_old );

        }

        foreach ( $joltnews_page_layout_options as $joltnews_post_layout_option ) {  
        
            $joltnews_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'joltnews_page_layout', true ) ); 
            $joltnews_page_layout_new = isset( $_POST['joltnews_page_layout'] ) ? joltnews_sanitize_post_layout_option_meta( wp_unslash( $_POST['joltnews_page_layout'] ) ) : '';

            if ( $joltnews_page_layout_new && $joltnews_page_layout_new != $joltnews_page_layout_old ){

                update_post_meta ( $post_id, 'joltnews_page_layout', $joltnews_page_layout_new );

            }elseif( '' == $joltnews_page_layout_new && $joltnews_page_layout_old ) {

                delete_post_meta( $post_id,'joltnews_page_layout', $joltnews_page_layout_old );

            }
            
        }

        $joltnews_ed_header_overlay_old = absint( get_post_meta( $post_id, 'joltnews_ed_header_overlay', true ) ); 
        $joltnews_ed_header_overlay_new = isset( $_POST['joltnews_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['joltnews_ed_header_overlay'] ) ) : '';

        if ( $joltnews_ed_header_overlay_new && $joltnews_ed_header_overlay_new != $joltnews_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'joltnews_ed_header_overlay', $joltnews_ed_header_overlay_new );

        }elseif( '' == $joltnews_ed_header_overlay_new && $joltnews_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'joltnews_ed_header_overlay', $joltnews_ed_header_overlay_old );

        }

    }

endif;   