jQuery(document).ready(function ($) {

    var ajaxurl = joltnews_pagination.ajax_url;

    function joltnews_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(joltnews_pagination.paged) + 1;
    var maxpage = joltnews_pagination.maxpage;
    var nextLink = joltnews_pagination.nextLink;
    var loadmore = joltnews_pagination.loadmore;
    var loading = joltnews_pagination.loading;
    var nomore = joltnews_pagination.nomore;
    var pagination_layout = joltnews_pagination.pagination_layout;
    var permalink_structure = joltnews_pagination.permalink_structure;

    //Function to load posts
    function joltnews_load_posts(loadType){
        let btn;

        if('click' === loadType){
            btn = $('.twp-loading-button');
        }else{
            btn = $('.joltnews-auto-pagination');
        }

        $('.twp-loaded-content').load(nextLink + ' .theme-article-area', function () {
            paged++;
            if (paged < 10) {
                var newlink = nextLink.substring(0, nextLink.length - 2);
            } else {
                var newlink = nextLink.substring(0, nextLink.length - 3);

            }
            if (permalink_structure == ''){
                newlink = newlink.replace('=', '');
                nextLink = newlink +"="+ paged + '/';
            } else {
                nextLink = newlink + paged + '/';
            }
            if (paged > maxpage) {
                btn.addClass('twp-no-posts');
                btn.text(nomore);
            } else {
                btn.text(loadmore);
            }

            $('.twp-loaded-content .theme-article-area').each(function(){
                $(this).addClass(paged + '-twp-article-ajax');
            });

            var lodedContent = $('.twp-loaded-content').html();
            $('.twp-loaded-content').html('');


            $('.content-area .article-wraper').append(lodedContent);

            btn.removeClass('twp-ajax-loading');

            $('.theme-article-area').each(function () {

                if (!$(this).hasClass('theme-article-loaded')) {

                    $(this).addClass(paged + '-twp-article-ajax');
                    $(this).addClass('theme-article-loaded');
                }

            });

            $('.theme-article-area').each(function(){
                $(this).removeClass(paged + '-twp-article-ajax');
            });

            var pageSection = $(".data-bg");
            pageSection.each(function (indx) {

                if ($(this).attr("data-background")) {

                    $(this).css("background-image", "url(" + $(this).data("background") + ")");

                }

            });

        });
    }

    $('.twp-loading-button').click(function () {

        if ((!$('.twp-no-posts').hasClass('twp-no-posts'))) {

            $('.twp-loading-button').text(loading);
            $('.twp-loging-status').addClass('twp-ajax-loading');

            joltnews_load_posts('click');

        }
    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {

            if (!$('.joltnews-auto-pagination').hasClass('twp-ajax-loading') && !$('.joltnews-auto-pagination').hasClass('twp-no-posts') && maxpage > 1 && joltnews_is_on_screen('.joltnews-auto-pagination')) {

                $('.joltnews-auto-pagination').addClass('twp-ajax-loading');
                $('.joltnews-auto-pagination').text(loading);

                joltnews_load_posts('autoload');
            }

        });
    }

    $(window).scroll(function () {

        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && joltnews_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'joltnews_single_infinity',
                '_wpnonce': joltnews_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid['0'];
                    $('.twp-single-infinity').attr('next-post', newpostid);

                    // Single Post content gallery slide
                    $(".after-load-ajax ul.wp-block-gallery.columns-1, .after-load-ajax .wp-block-gallery.columns-1 .blocks-gallery-grid, .after-load-ajax .gallery-columns-1").each(function () {
                        $(this).slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            autoplay: false,
                            autoplaySpeed: 8000,
                            infinite: true,
                            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">'+joltnews_custom.next_svg+'</button>',
                            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">'+joltnews_custom.prev_svg+'</button>',
                            dots: false,
                        });
                    });

                    // Content Gallery popup Start
                    $('.after-load-ajax .entry-content .gallery, .after-load-ajax .widget .gallery, .after-load-ajax .wp-block-gallery, .after-load-ajax .zoom-gallery').each(function () {
                        $(this).magnificPopup({
                            delegate: 'a',
                            type: 'image',
                            closeOnContentClick: false,
                            closeBtnInside: false,
                            mainClass: 'mfp-with-zoom mfp-img-mobile',
                            image: {
                                verticalFit: true,
                                titleSrc: function (item) {
                                    return item.el.attr('title');
                                }
                            },
                            gallery: {
                                enabled: true
                            },
                            zoom: {
                                enabled: true,
                                duration: 300,
                                opener: function (element) {
                                    return element.find('img');
                                }
                            }
                        });
                    });

                    $('article').each(function () {

                         if ($('body').hasClass('booster-extension') && $(this).hasClass('after-load-ajax') ) {

                                var cid = $(this).attr('id');
                                $(this).addClass( cid );
                                   
                                likedislike(cid);
                                booster_extension_post_reaction(cid);

                        }

                        $(this).removeClass('after-load-ajax');

                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});