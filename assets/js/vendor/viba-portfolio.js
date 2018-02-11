'use strict';
var viba_portfolio = {
    init: ['viba_portfolio_layout', 'viba_portfolio_filter', 'viba_portfolio_hoverdirections', 'viba_portfolio_max_height', 'viba_portfolio_on_resize', 'viba_portfolio_single_media', 'viba_portfolio_open_with_ajax', 'viba_portfolio_lightbox', ],
    after_open_with_ajax: ['viba_portfolio_single_media', 'viba_portfolio_lightbox', ],
    load_functions: function(type) {
        var length = viba_portfolio[type].length;
        for (var i = 0; i < length; i++) {
            window[viba_portfolio[type][i]]();
        }
    },
    ajax: {
        previous: 'Previous',
        next: 'Next',
        close: 'Close'
    }
};
$j(document).ready(function() {
    'use strict';
    viba_portfolio.load_functions('init');
    $j.merge(viba_portfolio.after_open_with_ajax, azra_js.init);
    azra_js.after_load_more.push('viba_portfolio_hoverdirections', 'viba_portfolio_max_height', 'viba_portfolio_on_resize', 'viba_portfolio_lightbox');
});
if (typeof window['viba_portfolio_hoverdirections'] !== 'function') {
    window.viba_portfolio_hoverdirections = function() {
        'use strict';
        $j('.vp-direction-aware .viba-portfolio-item-inner').hoverdirections({
            prefix_in: 'vp-in',
            prefix_out: 'vp-out'
        });
    }
}
if (typeof window['viba_portfolio_max_height'] !== 'function') {
    window.viba_portfolio_max_height = function() {
        'use strict';
        if ($j('.viba-portfolio-max-height').length) {
            $j(document).on('mouseenter', '.viba-portfolio-item-inner', function() {
                var $max_height = $j(this).find('.viba-portfolio-max-height');
                $max_height.each(function() {
                    $j(this).css({
                        maxHeight: $j(this).get(0).scrollHeight + 'px'
                    });
                })
            }).on('mouseleave', '.viba-portfolio-item-inner', function() {
                $j('.viba-portfolio-max-height').css({
                    maxHeight: '0px'
                });
            });
        }
    }
}
if (typeof window['viba_portfolio_on_resize'] !== 'function') {
    window.viba_portfolio_on_resize = function() {
        'use strict';
        $j(window).on('resize', function() {
            if ($j('.viba-portfolio-js-height').length) {
                $j('.viba-portfolio-item-inner').each(function() {
                    var contentHeight = $j(this).find('.viba-portfolio-content').outerHeight(),
                        maxHeight = $j(this).find('.viba-portfolio-max-height').length ? $j(this).find('.viba-portfolio-max-height').get(0).scrollHeight : 0,
                        height = contentHeight + maxHeight;
                    $j(this).find('.viba-portfolio-js-height').css('padding-bottom', height);
                });
            }
            if ($j('.viba-portfolio-js-width').length) {
                $j('.viba-portfolio-item-inner').each(function() {
                    var contentWidth = $j(this).find('.viba-portfolio-content').outerWidth();
                    $j(this).find('.viba-portfolio-js-width').css('padding-right', contentWidth);
                });
            }
        }).resize();
    }
}
if (typeof window['viba_portfolio_lightbox'] !== 'function') {
    window.viba_portfolio_lightbox = function() {
        'use strict';
        var options = apalodi_get_lightbox_options();
        $j('.viba-portfolio').each(function() {
            var $this = $j(this),
                $button = $this.find('.vp-zoom-button');
            $button.magnificPopup(options.gallery);
        });
        $j('.viba-portfolio-gallery').each(function() {
            var $this = $j(this),
                $link = $this.find('.gallery-lightbox');
            $link.magnificPopup(options.gallery);
        });
    }
}
if (typeof window['viba_portfolio_layout'] !== 'function') {
    window.viba_portfolio_layout = function() {
        'use strict';
        $j('.viba-portfolio.vp-isotope').each(function(index, value) {
            var $this = $j(this),
                columnn_width = '.viba-portfolio-item';
            $this.addClass('is-ready');
            if ($this.hasClass('vp-layout-multi-size-grid')) {
                columnn_width = '.viba-portfolio-item-default';
            }
            $this.apalodi_isotope({
                itemSelector: '.viba-portfolio-item',
                layoutMode: 'packery',
                percentPosition: true,
                packery: {
                    columnWidth: columnn_width
                },
                filter: '*',
                transitionDuration: 0
            });
        });
        $j('.viba-portfolio.vp-layout-carousel').waypoint({
            handler: function() {
                var $this = $j(this.element);
                var col_mp = $this.data('col-mp'),
                    col_ml = $this.data('col-ml'),
                    col_tp = $this.data('col-tp'),
                    col_tl = $this.data('col-tl'),
                    col_ds = $this.data('col-ds'),
                    col_dl = $this.data('col-dl');
                $this.apalodi_owlCarousel({
                    theme: 'apalodi-owl-carousel is-ready',
                    lazyLoad: true,
                    singleItem: false,
                    itemsCustom: [
                        [0, col_mp],
                        [480, col_ml],
                        [768, col_tp],
                        [960, col_tl],
                        [1124, col_ds],
                        [1400, col_dl]
                    ],
                    navigation: true,
                    navigationText: false,
                    slideSpeed: 600,
                    paginationSpeed: 800,
                    rewindSpeed: 400,
                    addClassActive: true,
                    dragBeforeAnimFinish: false,
                    touchDrag: true,
                    responsiveRefreshRate: 200,
                    afterAction: function() {
                        var $item = $this.find('.apalodi-owl-item.is-active'),
                            array = [];
                        $item.each(function(index, item) {
                            array.push($j(item).outerHeight(true));
                        });
                        var max = Math.max.apply(Math, array);
                        $this.find('.apalodi-owl-wrapper').css({
                            'height': max
                        });
                    }
                });
                this.destroy();
            },
            offset: '120%'
        });
    }
}
if (typeof window['viba_portfolio_filter'] !== 'function') {
    window.viba_portfolio_filter = function() {
        'use strict';
        $j('.filter-list a').on(azra_js.event_type, function(event) {
            event.preventDefault();
            var $this = $j(this),
                $wrapper = $this.parents('.filter-navigation'),
                $viba = $this.parents('.viba-portfolio-wrapper').find('.viba-portfolio'),
                hidden_style = $viba.data('isotope-hidden-style'),
                filter = $this.data('filter');
            $wrapper.find('a').removeClass('is-active');
            $this.addClass('is-active');
            $viba.apalodi_isotope({
                transitionDuration: 500 + 'ms',
                hiddenStyle: {
                    opacity: 0,
                    transform: hidden_style,
                },
                visibleStyle: {
                    opacity: 1,
                    transform: 'translate3d(0,0,0) rotate(0deg) scale3d(1,1,1)',
                }
            });
            $viba.apalodi_isotope({
                filter: filter
            });
            setTimeout(function() {
                Waypoint.refreshAll();
            }, 100);
            if ($wrapper.find('.filter-dropdown').length) {
                var $filter_button = $wrapper.find('.filter-button'),
                    selected_text = $this.text();
                $filter_button.text(selected_text);
            }
        });
        $j('.filter-button').on(azra_js.event_type, function(event) {
            var $this = $j(this),
                $wrapper = $this.parents('.filter-navigation');
            $this.toggleClass('is-active');
            if ($wrapper.hasClass('filter-type-slide-in')) {
                $this.next('.filter-list').slideToggle(300);
            } else {
                $this.next('.filter-list').toggleClass('is-active');
            }
        });
        $j('.viba-portfolio-widget-filter a').on(azra_js.event_type, function(event) {
            event.preventDefault();
            var $this = $j(this),
                filter = $this.data('filter'),
                $viba = $j('.viba-portfolio.vp-isotope'),
                hidden_style = $viba.data('isotope-hidden-style');
            $this.parents('.viba-portfolio-widget-filter').find('a').removeClass('is-active');
            $this.addClass('is-active');
            $viba.apalodi_isotope({
                transitionDuration: 500 + 'ms',
                hiddenStyle: {
                    opacity: 0,
                    transform: hidden_style,
                },
                visibleStyle: {
                    opacity: 1,
                    transform: 'translate3d(0,0,0) rotate(0deg) scale3d(1,1,1)',
                }
            });
            $viba.apalodi_isotope({
                filter: filter
            });
            setTimeout(function() {
                Waypoint.refreshAll();
            }, 100);
        });
    }
}
if (typeof window['viba_portfolio_single_media'] !== 'function') {
    window.viba_portfolio_single_media = function() {
        'use strict';
        $j('.viba-portfolio-gallery-grid').each(function(index, value) {
            var $this = $j(this);
            $this.addClass('is-ready');
            $this.apalodi_isotope({
                itemSelector: '.gallery-item',
                masonry: {
                    columnWidth: '.gallery-item'
                },
            });
        });
        $j('.viba-portfolio-gallery-carousel, .viba-portfolio-gallery-slider').waypoint({
            handler: function() {
                var $this = $j(this.element);
                var single = $this.hasClass('viba-portfolio-gallery-slider') ? true : false;
                $this.apalodi_owlCarousel({
                    theme: 'apalodi-owl-carousel is-ready',
                    lazyLoad: true,
                    singleItem: single,
                    itemsCustom: [
                        [0, 1],
                        [660, 2],
                        [860, 3],
                        [1200, 3]
                    ],
                    navigation: true,
                    navigationText: false,
                    slideSpeed: 600,
                    paginationSpeed: 800,
                    rewindSpeed: 400,
                    addClassActive: true,
                    dragBeforeAnimFinish: false,
                    touchDrag: true,
                    responsiveRefreshRate: 200,
                    afterAction: function() {
                        var $item = $this.find('.apalodi-owl-item.is-active'),
                            array = [];
                        $item.each(function(index, item) {
                            array.push($j(item).outerHeight(true));
                        });
                        var max = Math.max.apply(Math, array);
                        $this.find('.apalodi-owl-wrapper').css({
                            'height': max
                        });
                    }
                });
                this.destroy();
            },
            offset: '120%'
        });
    }
}
if (typeof window['viba_portfolio_open_with_ajax'] !== 'function') {
    window.viba_portfolio_open_with_ajax = function() {
        'use strict';
        var viba_portfolio_actions = '<div class="vp-ajax-actions-wrapper"><div class="vp-ajax-actions"><a class="vp-ajax-prev"><span>' + viba_portfolio.ajax.previous + '</span></a><a class="vp-ajax-next"><span>' + viba_portfolio.ajax.next + '</span></a><a class="vp-ajax-close"><span>' + viba_portfolio.ajax.close + '</span></a></div></div>',
            viba_portfolio_ajax_content = '<div class="vp-ajax-wrapper"><div class="vp-ajax-content">' + viba_portfolio_actions + '<span class="vp-ajax-loader"><span></span></span><div class="vp-ajax-inner content"></div></div></div>';
        $j('.vp-ajax').each(function() {
            var $this = $j(this),
                $vp_wrapper = $this.parents('.viba-portfolio-wrapper'),
                animation = $this.data('ajax-animation'),
                width = $this.data('ajax-width');
            
            if ($this.hasClass('vp-ajax-above')) {
                $vp_wrapper.prepend($j(viba_portfolio_ajax_content));
                var $ajax_wrapper_above = $vp_wrapper.find('.vp-ajax-wrapper');
                $ajax_wrapper_above.addClass('vp-ajax-type-slide vp-ajax-slide-above');
                $ajax_wrapper_above.find('.vp-ajax-content').css('maxWidth', width + 'px');
            }
            if ($this.hasClass('vp-ajax-below')) {
                $vp_wrapper.append($j(viba_portfolio_ajax_content));
                var $ajax_wrapper_below = $vp_wrapper.find('.vp-ajax-wrapper');
                $ajax_wrapper_below.addClass('vp-ajax-type-slide vp-ajax-slide-below');
                $ajax_wrapper_below.find('.vp-ajax-content').css('maxWidth', width + 'px');
            }
        });
        $j(document).on(azra_js.event_type, '.vp-ajax .viba-portfolio-link:not(.vp-ext-link)', function(event) {
            event.preventDefault();
            var $this = $j(this),
                $parents = $this.parents('.viba-portfolio'),
                $wrapper = $this.parents('.viba-portfolio-wrapper'),
                link = $this.attr('href'),
                path = $this.data('path'),
                id = $this.data('id'),
                first_link = $parents.find('.viba-portfolio-item:not(.vp-format-link):first').find('.viba-portfolio-link').attr('href'),
                last_link = $parents.find('.viba-portfolio-item:not(.vp-format-link):last').find('.viba-portfolio-link').attr('href'),
                prev_link = $this.parents('.viba-portfolio-item').prevAll('.viba-portfolio-item:not(.vp-format-link):first').find('.viba-portfolio-link').attr('href'),
                next_link = $this.parents('.viba-portfolio-item').nextAll('.viba-portfolio-item:not(.vp-format-link):first').find('.viba-portfolio-link').attr('href'),
                offset = $parents.data('ajax-offset'),
                $ajax_wrapper = $wrapper.find('.vp-ajax-wrapper'),
                $ajax_inner = $ajax_wrapper.find('.vp-ajax-inner'),
                $ajax_slide = $wrapper.find('.vp-ajax-type-slide'),
                $ajax_slide_content = $ajax_slide.find('.vp-ajax-inner');
            if ($parents.hasClass('vp-layout-carousel')) {
                prev_link = $this.parents('.apalodi-owl-item').prevAll('.apalodi-owl-item').find('.viba-portfolio-item:not(.vp-format-link)').last().find('.viba-portfolio-link').attr('href');
                next_link = $this.parents('.apalodi-owl-item').nextAll('.apalodi-owl-item').find('.viba-portfolio-item:not(.vp-format-link)').first().find('.viba-portfolio-link').attr('href');
            }
            if (next_link == null) {
                next_link = first_link;
            }
            if (prev_link == null) {
                prev_link = last_link;
            }
            $ajax_wrapper.find('.vp-ajax-next').attr('href', next_link);
            $ajax_wrapper.find('.vp-ajax-prev').attr('href', prev_link);
            if ($ajax_slide.length) {
                var elementOffset = $ajax_slide.offset().top,
                    headerOffset = 0,
                    wpadminbar = 0,
                    large_screen = Modernizr.mq('(min-width: 1025px)'),
                    stickyResizeOffset = parseInt(azra_js.header_height * 2, 10) + 150;
                if (large_screen) {
                    headerOffset = azra_js.header_height;
                    if ($j('.site-header').hasClass('header-resize') && elementOffset > stickyResizeOffset) {
                        headerOffset = azra_js.header_resized_height;
                    }
                } else {
                    headerOffset = azra_js.header_mobile_height;
                }
                if ($j('body').hasClass('admin-bar')) {
                    wpadminbar = $j('#wpadminbar').height();
                }
                var sc_offset = elementOffset - headerOffset - wpadminbar - offset;
                $j('html, body').animate({
                    scrollTop: sc_offset
                }, 450);
            }
            $ajax_slide_content.slideUp(400);
            $ajax_wrapper.addClass('is-loading is-visible');
        });
        $j(document).on(azra_js.event_type, '.vp-ajax-prev, .vp-ajax-next', function(event) {
            event.preventDefault();
            var $this = $j(this),
                link = $this.attr('href'),
                $vp_wrapper = $this.parents('.viba-portfolio-wrapper').find('.viba-portfolio');
            $vp_wrapper.find('a[href="' + link + '"]:first').trigger(azra_js.event_type);
        });
        $j(document).on(azra_js.event_type, '.vp-ajax-close', function(event) {
            event.preventDefault();
            var $this = $j(this),
                $vp_wrapper = $j(this).parents('.viba-portfolio-wrapper'),
                $ajax_modal = $vp_wrapper.find('.vp-ajax-type-modal'),
                $ajax_modal_inner = $ajax_modal.find('.vp-ajax-inner'),
                $ajax_slide = $vp_wrapper.find('.vp-ajax-type-slide'),
                $ajax_slide_content = $ajax_slide.find('.vp-ajax-content'),
                $ajax_slide_inner = $ajax_slide.find('.vp-ajax-inner');
            $ajax_modal.removeClass('is-visible is-loading is-loaded');
            $ajax_slide_inner.slideUp(400);
            setTimeout(function() {
                $ajax_slide.removeClass('is-visible is-loading is-loaded');
                $ajax_modal_inner.empty();
                $ajax_slide_inner.empty();
            }, 400);
            $j('.viba-portfolio-single-media audio, .viba-portfolio-single-media video').each(function() {
                $j(this).get(0).pause();
            });
            $j('.viba-portfolio-single-media iframe').remove();
            $j('html').removeClass('vp-modal-open');
        });
        $j(document).on(azra_js.event_type, '.vp-ajax-backdrop', function(event) {
            $j('.vp-ajax-close').trigger(azra_js.event_type);
        });
        $j(document).keydown(function(e) {
            if ($j('.mfp-wrap').length) {
                e.stopPropagation();
                return false;
            }
            if (e.which === 37) {
                $j('.vp-ajax-prev').trigger(azra_js.event_type);
            }
            if (e.which === 39) {
                $j('.vp-ajax-next').trigger(azra_js.event_type);
            }
            if (e.which === 27) {
                $j('.vp-ajax-close').trigger(azra_js.event_type);
            }
        });
    }
}