jQuery(document).ready(function($){

    $('.v-slider.news-stories-in').slick({
        dots: false,
        arrows: true,
        vertical: true,
        draggable: true,
        slidesToShow: news_24x7_object.fresh_stories_slides_to_show,
        slidesToScroll: 1,
        verticalSwiping: true,
        autoplay: true,
        infinite: true,
        swipeToSlide: true,
        touchThreshold: 100,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    arrows: false,
                    draggable: false,
                    verticalSwiping: false,
                },
            },
        ],
    });

    $('.breaking-content').marquee({
        //duration in milliseconds of the marquee
        duration: 30000,
        //gap in pixels between the tickers
        gap: 0,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: 'left',
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true,
        pauseOnHover: true
    });

});

jQuery(document).on( 'click' , '.news_24_section_2_wrapper .rt-post-tab .post-cat-tab a' , function(){

    var data_id = jQuery(this).data('id');

    // Remove active class
    jQuery(this).closest('.post-cat-tab').find('a').removeClass('current');
    // Add active class
    jQuery(this).addClass('current');

    // Hide all tab content
    jQuery(this).closest('.news_24_section_2_wrapper').find('.tab_content').hide();

    // Show selected tab content
    jQuery(this).closest('.news_24_section_2_wrapper').find('.tab_content[data-id="' + data_id + '"]').show();

});