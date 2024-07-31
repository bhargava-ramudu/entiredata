<?php
/**
 * JoltNews Customizer Active Callback Functions
 *
 * @package JoltNews
 */

function joltnews_header_archive_layout_ac( $control ){

    $joltnews_archive_layout = $control->manager->get_setting( 'joltnews_archive_layout' )->value();
    if( $joltnews_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function joltnews_overlay_layout_ac( $control ){

    $joltnews_single_post_layout = $control->manager->get_setting( 'joltnews_single_post_layout' )->value();
    if( $joltnews_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function joltnews_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}