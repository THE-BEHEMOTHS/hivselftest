'use strict';
var $j = jQuery.noConflict(),
    $apalodi_window = $j(window),
    apalodi_rAF = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        return window.setTimeout(callback, 1000 / 60);
    };
var azra_js = {
    ajax_url: base_url + 'API/loadPage',
    header_height: 65,
    header_resized_height: 50,
    header_mobile_height: 45,
    is_mobile: jQuery.browser.apalodi_mobile,
    is_mobile_animations: false,
    is_mobile_video: false,
    skrollr: undefined,
    event_type: 'click',
    window_width: $apalodi_window.width(),
    ready: ['apalodi_check_doc_height', 'apalodi_header_scroll_animations', 'apalodi_menu', 'apalodi_site_actions', 'apalodi_pagination_load_more', 'apalodi_button_onclick', 'apalodi_shop_tabs', 'apalodi_shop_ratings', 'apalodi_link_hash_scroll', 'apalodi_contact_form', 'apalodi_back_to_top', ],
    init: ['apalodi_parallax', 'apalodi_object_fit', 'apalodi_preload_images', 'apalodi_html5_video', 'apalodi_disable_mobile_video', 'apalodi_lazy_load', 'apalodi_columns_masonry', 'apalodi_carousel', 'apalodi_tabs', 'apalodi_accordion', 'apalodi_before_after', 'apalodi_counter', 'apalodi_bg_gallery', 'apalodi_lightbox', 'apalodi_progress_bar', 'apalodi_progress_circle', 'apalodi_google_maps', 'apalodi_animate_elements', ],
    load: [],
    after_load_more: ['apalodi_animate_elements', 'apalodi_lazy_load', ],
    load_functions: function(type) {
        var length = azra_js[type].length;
        for (var i = 0; i < length; i++) {
            window[azra_js[type][i]]();
        }
    },
    load_script: function(url, obj, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript', script.readyState && (script.onreadystatechange = function() {
            'loaded' !== script.readyState && 'complete' !== script.readyState || (script.onreadystatechange = null, callback())
        }), script.src = url, obj.get(0).appendChild(script);
    }
};
if (azra_js.is_mobile) {
    $j('html').addClass('is-mobile');
    if (!azra_js.is_mobile_animations) {
        $j('html').addClass('no-animations');
    }
}
$j(window).load(function() {
    'use strict';
    azra_js.load_functions('load');
});
$j(document).ready(function($) {
    'use strict';
    azra_js.load_functions('ready');
    azra_js.load_functions('init');
    $apalodi_window.on('throttledresize orientationchange', function() {
        apalodi_rAF(apalodi_resize_window);
    });
});
if (typeof window['apalodi_check_doc_height'] !== 'function') {
    window.apalodi_check_doc_height = function() {
        'use strict';
        var last_height = document.body.clientHeight,
            counter = 0;
        var check_doc_height = function() {
            var new_height = document.body.clientHeight;
            if (last_height != new_height || counter < 10) {
                counter++;
                last_height = new_height;
                if (typeof azra_js.skrollr !== 'undefined') {
                    azra_js.skrollr.refresh();
                }
            }
            apalodi_rAF(check_doc_height);
        };
        check_doc_height();
    }
}
if (typeof window['apalodi_resize_window'] !== 'function') {
    window.apalodi_resize_window = function() {
        'use strict';
        if (azra_js.is_mobile && azra_js.window_width == $apalodi_window.width()) {} else {
            azra_js.window_width = $apalodi_window.width();
            apalodi_object_fit();
            apalodi_before_after();
        }
    }
}
if (typeof window['apalodi_mediaelement'] !== 'function') {
    window.apalodi_mediaelement = function() {
        'use strict';
        if (typeof jQuery.fn.mediaelementplayer !== 'undefined') {
            var $audio_shortcode = $j('audio.wp-audio-shortcode'),
                $video_shortcode = $j('video.wp-video-shortcode');
            mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
            mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');
            $j(function() {
                var settings = {};
                if (typeof _wpmejsSettings !== 'undefined') {
                    settings = _wpmejsSettings;
                }
                settings.success = function(mejs) {
                    var autoplay, loop;
                    if ('flash' === mejs.pluginType) {
                        autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
                        loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
                        autoplay && mejs.addEventListener('canplay', function() {
                            mejs.play();
                        }, false);
                        loop && mejs.addEventListener('ended', function() {
                            mejs.play();
                        }, false);
                    }
                };
                if (!$audio_shortcode.hasClass('mejs-audio')) {
                    $audio_shortcode.mediaelementplayer(settings);
                }
                if (!$video_shortcode.parent('mejs-mediaelement').length) {
                    $video_shortcode.mediaelementplayer(settings);
                }
            });
        }
        if (typeof WPPlaylistView !== 'undefined') {
            $j('.wp-playlist').each(function() {
                return new WPPlaylistView({
                    el: this
                });
            });
        }
    }
}
if (typeof window['apalodi_parallax'] !== 'function') {
    window.apalodi_parallax = function() {
        'use strict';
        if (!azra_js.is_mobile) {
            azra_js.skrollr = skrollr.init({
                forceHeight: false,
                smoothScrolling: false,
                mobileCheck: function() {
                    return false;
                }
            });
        }
    }
}
if (typeof window['apalodi_header_scroll_animations'] !== 'function') {
    window.apalodi_header_scroll_animations = function() {
        'use strict';
        var $resized = $j('#masthead.header-resize'),
            $transparent = $j('.header-transparent #masthead'),
            stickyResizeOffset = parseInt(azra_js.header_height, 10) + 150;
        $j('body').waypoint({
            handler: function() {
                $j('#masthead').toggleClass('is-sticky');
            },
            offset: -5
        });
        if ($transparent.length) {
            $j('body').waypoint({
                handler: function() {
                    $transparent.toggleClass('is-transparent');
                },
                offset: -5
            });
        }
        if ($resized.length && !azra_js.is_mobile) {
            $j('body').waypoint({
                handler: function() {
                    $resized.toggleClass('is-resized');
                },
                offset: -stickyResizeOffset
            });
        }
    }
}
if (typeof window['apalodi_menu'] !== 'function') {
    window.apalodi_menu = function() {
        'use strict';
        var center_mega_menu = function() {
            $j('.site-nav > li.mega-menu-center').each(function() {
                var $this = $j(this),
                    $sub = $this.children('.sub-menu'),
                    offsetLeft = $this.offset().left,
                    rightSpace = azra_js.window_width - offsetLeft,
                    subWidth = $sub.outerWidth(),
                    offset = rightSpace - (subWidth / 2) - 35;
                if (offset > 0) {
                    $this.addClass('is-mega-menu-centered');
                } else {
                    $this.removeClass('is-mega-menu-centered');
                }
            });
        }();
        $apalodi_window.on('throttledresize orientationchange', center_mega_menu);
        $j('.site-nav li.menu-item-has-children > a').each(function() {
            $j('<i class="mobile-sub-menu-trigger apalodi-icon-right-circled-alt"></i>').appendTo(this);
        });
        $j(document).on(azra_js.event_type, '.site-nav li.menu-item-has-children > a', function(e) {
            var large_screen = Modernizr.mq('(min-width: 1025px)');
            if (!large_screen) {
                var $this = $j(this),
                    $nav = $j('.menu'),
                    $list = $this.closest('li'),
                    has_hash = this.href.indexOf('#') != -1 ? true : false,
                    animation = 'slideDown';
                if ($this.closest('li').hasClass('is-active')) {
                    animation = 'slideUp';
                } else {
                    e.preventDefault();
                }
                if (has_hash) {
                    e.preventDefault();
                }
                $this.closest('li').toggleClass('is-active');
                if ('slideDown' == animation) {
                    $list.find('ul:first').slideDown(200, function() {
                        $j(this).css('display', "");
                        $this.closest('li').toggleClass('is-submenu-active');
                    });
                } else {
                    $list.find('ul:first').slideUp(200, function() {
                        $j(this).css('display', "");
                        $this.closest('li').toggleClass('is-submenu-active');
                    });
                }
                $list.siblings().children().next('ul').slideUp(200, function() {
                    $j(this).css('display', "");
                    $j(this).parent().removeClass('is-submenu-active');
                });
                $list.siblings().find('.is-active ul').slideUp(200, function() {
                    $j(this).css('display', "");
                    $j(this).parent().removeClass('is-submenu-active');
                });
                $list.siblings().removeClass('is-active');
                $list.siblings().find('.is-active').removeClass('is-active');
            }
        });
    }
}
if (typeof window['apalodi_site_actions'] !== 'function') {
    window.apalodi_site_actions = function() {
        'use strict';
        var $html = $j('html');
        $j(document).on(azra_js.event_type, '.mobile-menu-trigger', function(event) {
            event.preventDefault();
            $html.addClass('is-mobile-menu-active');
            $j('.mobile-menu-close-trigger').addClass('is-active');
        });
        $j(document).on(azra_js.event_type, '.mobile-menu-close-trigger, .site-actions-overlay', function(event) {
            event.preventDefault();
            $html.removeClass('is-mobile-menu-active');
            $j('.mobile-menu-close-trigger').removeClass('is-active');
        });
        $j(document).on(azra_js.event_type, '.header-cart-trigger', function(event) {
            event.preventDefault();
            $html.addClass('is-header-cart-active');
            $j('.header-cart-close-trigger').addClass('is-active');
        });
        $j(document).on(azra_js.event_type, '.header-cart-close-trigger, .site-actions-overlay', function(event) {
            event.preventDefault();
            $html.removeClass('is-header-cart-active');
            $j('.header-cart-close-trigger').removeClass('is-active');
        });
        $j(document).on(azra_js.event_type, '.header-search-trigger', function(event) {
            event.preventDefault();
            $j('.header-search-form .search-form .search-field').focus();
            $html.addClass('is-header-search-active');
        });
        $j(document).on(azra_js.event_type, '.header-search-form-close', function(event) {
            event.preventDefault();
            $html.removeClass('is-header-search-active');
        });
    }
}
if (typeof window['apalodi_pagination_load_more'] !== 'function') {
    window.apalodi_pagination_load_more = function() {
        'use strict';
        $j(document).on(azra_js.event_type, '.pagination-load-more', function(event) {
            event.preventDefault();
            var $this = $j(this),
                $container = '',
                $load_more = $this.parent(),
                $count = $this.find('.load-more-count'),
                container = $this.data('container'),
                items = $this.data('items'),
                count_posts = parseInt($this.data('count-posts'), 10),
                is_masonry = $this.data('is-masonry'),
                query = $this.data('query');
            $this.addClass('is-loading');
            if ($j.isPlainObject(container)) {
                $container = $load_more.prev(container.wrapper).find(container.container);
            } else {
                $container = $load_more.prev(container)
            }
            $j.ajax({
                type: 'POST',
                url: azra_js.ajax_url,
                data: {
                    action: query.action,
                },
                success: function(data) {
                    data = $j.parseJSON(data);
                    console.log(data);
                    if (data.type == 'success') {
                        var $all_items = $j(data.html).filter(items),
                            $load_items = [],
                            new_offset = parseInt(query.offset, 10) + parseInt(query.posts_per_page, 10),
                            max_counter = Math.min(count_posts, new_offset);
                        for (var i = query.offset; i < max_counter; i++) {
                            $load_items.push($all_items[i]);
                        }
                        var $new_items = $j($load_items);
                        $this.data('query', $j.extend(query, {
                            offset: new_offset
                        }));
                        $count.html('(' + (count_posts - new_offset) + ')');
                        apalodi_rAF(function() {
                            $this.removeClass('is-loading');
                            if (is_masonry) {
                                $container.apalodi_isotope({
                                    transitionDuration: 0
                                });
                                $container.append($new_items).apalodi_isotope('appended', $new_items);
                            } else {
                                $container.append($new_items);
                            }
                            azra_js.load_functions('after_load_more');
                            if (new_offset >= count_posts) {
                                $load_more.slideUp(200);
                            }
                        });
                    } else if (data.type == 'empty') {
                        apalodi_rAF(function() {
                            $load_more.slideUp(200);
                        });
                    } else if (data.type == 'error') {
                        $this.addClass('is-ajax-error');
                        setTimeout(function() {
                            $this.removeClass('is-loading');
                        }, 3000);
                    }
                },
                error: function() {
                    $this.addClass('is-ajax-error');
                    setTimeout(function() {
                        $this.removeClass('is-loading');
                    }, 3000);
                }
            });
        });
    }
}
if (typeof window['apalodi_object_fit'] !== 'function') {
    window.apalodi_object_fit = function() {
        'use strict';
        $j('.object-fit').each(function() {
            var $this = $j(this),
                $parent = $this.parent(),
                ratio = ($this.innerHeight() / $this.innerWidth() * 100),
                parent_ratio = ($parent.height() / $parent.width() * 100);
            $this.addClass('is-object-fit');
            if (ratio >= parent_ratio) {
                $this.addClass('object-fit-taller').removeClass('object-fit-wider');
            } else {
                $this.addClass('object-fit-wider').removeClass('object-fit-taller');
            }
        });
    }
}
if (typeof window['apalodi_preload_images'] !== 'function') {
    window.apalodi_preload_images = function() {
        'use strict';
        $j('.preload-image:not(.is-ready):not(.lazy-load-img)').each(function() {
            var $this = $j(this);
            $this.addClass('is-loaded');
            $this.waitForImages({
                finished: function() {
                    $this.addClass('is-ready');
                },
                waitForAll: true
            });
        });
        $j('.preload-bg-image:not(.is-ready):not(.lazy-load-bg-img):not(.bg-video-fallback)').each(function() {
            var $this = $j(this);
            $this.addClass('is-loaded');
            $this.waitForImages({
                finished: function() {
                    $this.addClass('is-ready');
                },
                waitForAll: true
            });
        });
    }
}
if (typeof window['apalodi_html5_video'] !== 'function') {
    window.apalodi_html5_video = function() {
        'use strict';
        $j('.html5-video:not(.is-ready):not(.lazy-load-video)').each(function() {
            var $this = $j(this),
                is_autoplay = $this.data('autoplay') !== undefined ? true : false;
            $this.aVideoReady({
                finished: function() {
                    apalodi_object_fit();
                    $this.addClass('is-ready');
                    if (is_autoplay) {
                        $this.get(0).play();
                    }
                },
                waitForAll: true
            });
        });
    }
}
if (typeof window['apalodi_disable_mobile_video'] !== 'function') {
    window.apalodi_disable_mobile_video = function() {
        'use strict';
        if (azra_js.is_mobile && !azra_js.is_mobile_video) {
            $j('.html5-video').each(function() {
                var $this = $j(this),
                    $fallback = $this.next('.bg-video-fallback');
                $this.remove();
                $fallback.removeClass('bg-video-fallback');
            });
        }
    }
}
if (typeof window['apalodi_lazy_load'] !== 'function') {
    window.apalodi_lazy_load = function() {
        'use strict';
        $j('.lazy-load-img:not(.is-loaded):not(.gallery-image)').waypoint({
            handler: function() {
                var $this = $j(this.element),
                    src = $this.data('src');
                $this.attr('src', src).addClass('is-loaded');
                $this.waitForImages({
                    finished: function() {
                        $this.addClass('is-ready');
                    },
                    waitForAll: true
                });
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '120%'
        });
        $j('.lazy-load-bg-img:not(.is-loaded):not(.bg-video-fallback):not(.bg-gallery-item)').waypoint({
            handler: function() {
                var $this = $j(this.element),
                    src = $this.data('src');
                $this.css('background-image', 'url(' + src + ')').addClass('is-loaded');
                $this.waitForImages({
                    finished: function() {
                        $this.addClass('is-ready');
                    },
                    waitForAll: true
                });
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '120%'
        });
        $j('.lazy-load-video:not(.is-loaded)').waypoint({
            handler: function() {
                var $video = $j(this.element),
                    is_autoplay = $video.data('autoplay') !== undefined ? true : false,
                    src = $video.data('src');
                $video.attr('src', src).addClass('is-loaded');
                $video.aVideoReady({
                    finished: function() {
                        apalodi_object_fit();
                        $video.addClass('is-ready');
                        if (is_autoplay) {
                            $video.get(0).play();
                        }
                    },
                    waitForAll: true
                });
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '120%'
        });
    }
}
if (typeof window['apalodi_columns_masonry'] !== 'function') {
    window.apalodi_columns_masonry = function() {
        'use strict';
        $j('.columns-masonry').each(function(index, element) {
            var $this = $j(element);
            $this.addClass('is-masonry-ready');
            $this.apalodi_isotope({
                itemSelector: '.column',
                layoutMode: 'packery',
                percentPosition: true,
                packery: {
                    columnWidth: '.column',
                },
                filter: '*',
                transitionDuration: 0
            });
        });
    }
}
if (typeof window['apalodi_carousel'] !== 'function') {
    window.apalodi_carousel = function() {
        'use strict';
        $j('.carousel').waypoint({
            handler: function() {
                var $this = $j(this.element);
                var single = $this.hasClass('gallery-slider') ? true : false,
                    col_xs = $this.data('col-xs'),
                    col_sm = $this.data('col-sm'),
                    col_md = $this.data('col-md'),
                    col_lg = $this.data('col-lg');
                $this.apalodi_owlCarousel({
                    theme: 'apalodi-owl-carousel is-ready',
                    lazyLoad: true,
                    singleItem: single,
                    itemsCustom: [
                        [0, col_xs],
                        [660, col_sm],
                        [860, col_md],
                        [1200, col_lg]
                    ],
                    navigation: true,
                    navigationText: false,
                    slideSpeed: 600,
                    paginationSpeed: 600,
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
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '120%'
        });
    }
}
if (typeof window['apalodi_tabs'] !== 'function') {
    window.apalodi_tabs = function() {
        'use strict';
        $j('.tabs-type-indicator').each(function() {
            var $active = $j(this).find('.tabs a.is-active'),
                position = $active.position(),
                width = $active.width(),
                height = $active.height();
            $j(this).find('.tabs').append('<span class="tab-indicator"></span>');
            if ($j(this).hasClass('tabs-vertical')) {
                $j(this).find('.tab-indicator').css({
                    'transform': 'translateY(' + position.top + 'px)',
                    'height': height
                });
            } else {
                $j(this).find('.tab-indicator').css({
                    'transform': 'translateX(' + position.left + 'px)',
                    'width': width
                });
            }
        });
        $j(document).on(azra_js.event_type, '.tabs a', function(event) {
            event.preventDefault();
            var $this = $j(this),
                $wrapper = $this.parents('.tabs-wrapper'),
                $indic = $wrapper.find('.tab-indicator'),
                $tabs = $wrapper.find('.tabs a'),
                $panels = $wrapper.find('.panel'),
                $apanels = $wrapper.find('.panel.is-active'),
                $panel = $wrapper.find($this.attr('href'));
            if (!$this.hasClass('is-active')) {
                $apanels.css({
                    'display': 'block'
                });
                $tabs.removeClass('is-active');
                $panels.removeClass('is-visible').slideUp(200);
                $panel.slideDown(200);
                $this.addClass('is-active');
                if ($indic.length) {
                    var position = $this.position(),
                        width = $this.width(),
                        height = $this.height();
                    if ($wrapper.hasClass('tabs-vertical')) {
                        $indic.css({
                            'transform': 'translateY(' + position.top + 'px)',
                            'height': height
                        });
                    } else {
                        $indic.css({
                            'transform': 'translateX(' + position.left + 'px)',
                            'width': width
                        });
                    }
                }
                setTimeout(function() {
                    $panels.removeClass('is-active');
                    $panel.addClass('is-active');
                    setTimeout(function() {
                        $panel.addClass('is-visible')
                    }, 50);
                }, 50);
            }
        });
    }
}
if (typeof window['apalodi_accordion'] !== 'function') {
    window.apalodi_accordion = function() {
        'use strict';
        $j(document).on(azra_js.event_type, '.accordion-nav', function(event) {
            event.preventDefault();
            var $this = $j(this),
                $wrapper = $this.parent(),
                is_collapsible = $wrapper.data('collapsible'),
                $all_nav = $wrapper.find('.accordion-nav');
            if ($this.hasClass('is-active') && true == is_collapsible) {
                $this.removeClass('is-active').next().slideUp(200);
            } else if (!$this.hasClass('is-active')) {
                $all_nav.removeClass('is-active').next().slideUp(200);
                $this.addClass('is-active').next().slideDown(200);
            }
        });
    }
}
if (typeof window['apalodi_before_after'] !== 'function') {
    window.apalodi_before_after = function() {
        'use strict';
        $j('.before-after').each(function() {
            var $this = $j(this),
                $img = $this.find('.image-thumbnail:first-child'),
                $handle = $this.find('.before-after-handle'),
                width = $this.width(),
                offset = $this.offset().left;
            var changePosition = function(percentage) {
                $img.css({
                    'width': percentage + '%'
                });
                $handle.css({
                    'left': percentage + '%'
                });
            };
            $handle.on('mousedown', function(event) {
                event.preventDefault();
                $handle.addClass('is-grabbing');
            });
            $handle.on('mouseup', function(event) {
                event.preventDefault();
                $handle.removeClass('is-grabbing');
            });
            $handle.on('move', function(event) {
                var percentage = (event.pageX - offset) / width * 100;
                if (0 > percentage) {
                    percentage = 0;
                }
                if (100 < percentage) {
                    percentage = 100
                }
                changePosition(percentage);
            });
        });
    }
}
if (typeof window['apalodi_counter'] !== 'function') {
    window.apalodi_counter = function() {
        'use strict';
        $j('.counter-number').waypoint({
            handler: function(direction) {
                var $this = $j(this.element),
                    number = $this.data('number').toString(),
                    time = 1000,
                    delay = 70;
                $this.text(0).addClass('is-loaded');
                var counter = function() {
                    var numbers = [],
                        num = number.replace(/,/g, ''),
                        divisions = time / delay,
                        is_comma = /[0-9]+,[0-9]+/.test(number),
                        is_int = /^[0-9]+$/.test(num),
                        is_float = /^[0-9]+\.[0-9]+$/.test(num),
                        decimalPlaces = is_float ? (num.split('.')[1] || []).length : 0;
                    for (var i = divisions; i >= 1; i--) {
                        var new_num = parseInt(num / divisions * i, 10);
                        if (is_float) {
                            new_num = parseFloat(num / divisions * i).toFixed(decimalPlaces);
                        }
                        if (is_comma) {
                            while (/(\d+)(\d{3})/.test(new_num.toString())) {
                                new_num = new_num.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
                            }
                        }
                        numbers.unshift(new_num);
                    }
                    var count = function() {
                        $this.text(numbers.shift());
                        if (numbers.length) {
                            setTimeout(count, delay);
                        }
                    };
                    setTimeout(count, delay);
                };
                counter();
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '95%'
        });
    }
}
if (typeof window['apalodi_bg_gallery'] !== 'function') {
    window.apalodi_bg_gallery = function() {
        'use strict';
        $j('.bg-gallery').waypoint({
            handler: function() {
                var $gallery = $j(this.element),
                    $slides = $gallery.children(),
                    length = $slides.length,
                    cycle_started = false,
                    counter = 0,
                    preload = 0;
                var slide_to = function(index) {
                    var $current_slide = $slides.eq(index);
                    $slides.removeClass('is-active');
                    $current_slide.addClass('is-active');
                    counter = index;
                }
                var lazy_load_slides = function(index) {
                    var $current_slide = $slides.eq(index),
                        src = $current_slide.data('src');
                    if (!$current_slide.hasClass('is-loaded') && undefined != src) {
                        $current_slide.css('background-image', 'url(' + src + ')').addClass('is-loaded');
                        $current_slide.waitForImages({
                            finished: function() {
                                $current_slide.addClass('is-ready');
                                if (!cycle_started) {
                                    start_the_cycle();
                                }
                            },
                            waitForAll: true
                        });
                    } else {
                        if (!cycle_started) {
                            start_the_cycle();
                        }
                    }
                }
                var start_the_cycle = function() {
                    cycle_started = true;
                    var slide_interval = setInterval(function() {
                        counter++;
                        var index = counter < length ? counter : 0;
                        if (length > 1) {
                            slide_to(index);
                        } else {
                            clearInterval(slide_interval);
                        }
                    }, 4000);
                }
                slide_to(0);
                lazy_load_slides(0);
                var preload_interval = setInterval(function() {
                    preload++;
                    if (preload < length) {
                        lazy_load_slides(preload);
                    } else {
                        clearInterval(preload_interval);
                    }
                }, 2500);
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '120%'
        });
    }
}
if (typeof window['apalodi_get_lightbox_options'] !== 'function') {
    window.apalodi_get_lightbox_options = function() {
        'use strict';
        var mfp_options = {
            closeOnContentClick: true,
            fixedContentPos: true,
            fixedBgPos: true,
            overflowY: 'hidden',
            mainClass: 'apalodi-mfp apalodi-mfp-zoom-in',
            closeMarkup: '<span class="apalodi-mfp-close"></span>',
            tClose: '',
            tLoading: '',
        };
        var image = $j.extend({}, mfp_options, {
            type: 'image',
            removalDelay: 200,
            image: {
                verticalFit: true,
                markup: '<div class="mfp-figure">' + '<div class="mfp-counter"></div>' + '<div class="mfp-close"></div>' + '<div class="mfp-img"></div>' + '<div class="mfp-title"></div>' + '</div>',
                tError: '<a href="%url%">The image</a> could not be loaded.'
            },
            callbacks: {
                open: function() {
                    $j('html').addClass('mfp-no-scroll');
                },
                close: function() {
                    $j('html').removeClass('mfp-no-scroll');
                },
                imageLoadComplete: function() {
                    var self = this;
                    setTimeout(function() {
                        self.wrap.addClass('apalodi-mfp-image-loaded');
                    }, 16);
                },
                change: function() {
                    var self = this,
                        items = self.items,
                        index = self.index;
                    self.wrap.removeClass('apalodi-mfp-image-loaded');
                    if ('' != items[index].el[0].title) {
                        self.wrap.addClass('apalodi-mfp-caption');
                    } else {
                        self.wrap.removeClass('apalodi-mfp-caption');
                    }
                }
            }
        });
        var gallery = $j.extend({}, image, {
            gallery: {
                enabled: true,
                tPrev: '',
                tNext: '',
                arrowMarkup: '<span class="apalodi-mfp-arrow apalodi-mfp-arrow-%dir%"></span>',
                tCounter: '%curr% / %total%',
                preload: [1, 2]
            }
        });
        var video = $j.extend({}, mfp_options, {
            type: 'iframe',
            iframe: {
                markup: '<div class="apalodi-mfp-iframe-scaler">' + '<div class="apalodi-mfp-close"></div>' + '<iframe class="mfp-iframe" allowfullscreen></iframe>' + '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
            }
        });
        var options = {
            image: image,
            gallery: gallery,
            video: video
        };
        return options;
    }
}
if (typeof window['apalodi_lightbox'] !== 'function') {
    window.apalodi_lightbox = function() {
        'use strict';
        var options = apalodi_get_lightbox_options();
        $j('.gallery').each(function() {
            var $this = $j(this),
                $link = $this.find('.gallery-lightbox');
            $link.magnificPopup(options.gallery);
        });
        $j('.lightbox').magnificPopup(options.image);
    }
}
if (typeof window['apalodi_button_onclick'] !== 'function') {
    window.apalodi_button_onclick = function() {
        'use strict';
        $j(document).on(azra_js.event_type, '.button-onclick', function(event) {
            event.preventDefault();
            var $this = $j(this),
                src = $this.data('onclick'),
                options = apalodi_get_lightbox_options(),
                video = $j.extend({}, options.video, {
                    items: {
                        src: src
                    }
                });
            $j.magnificPopup.open(video);
        });
    }
}
if (typeof window['apalodi_progress_bar'] !== 'function') {
    window.apalodi_progress_bar = function() {
        'use strict';
        var collection = [];
        var stagger_animation = function() {
            setTimeout(function() {
                $j.each(collection, function(index, element) {
                    var stagger = 80 * index;
                    setTimeout(function() {
                        element.addClass('is-animated');
                    }, stagger);
                });
                collection = [];
            }, 50);
        };
        $j('.progress-bar-line').waypoint({
            handler: function(direction) {
                collection.push($j(this.element));
                apalodi_rAF(stagger_animation);
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '95%'
        });
    }
}
if (typeof window['apalodi_progress_circle'] !== 'function') {
    window.apalodi_progress_circle = function() {
        'use strict';
        var line_width = 8,
            one_percent = 360 / 100,
            start_point = Math.PI / 180;
        var draw_circle = function(context, width, center, radius, deegre) {
            context.clearRect(0, 0, width, width);
            context.beginPath();
            context.arc(center, center, radius, start_point * 270, start_point * (270 + deegre));
            context.stroke();
        };
        $apalodi_window.on('throttledresize orientationchange', function() {
            apalodi_rAF(function() {
                $j('.progress-circle.is-ready').each(function(index, value) {
                    var $el = $j(this),
                        width = $el.width(),
                        percent = $el.data('percent') ? parseInt($el.data('percent'), 10) : 25,
                        fill_color = $el.data('fill-color'),
                        radius = (width - line_width) / 2,
                        center = width / 2,
                        canvas = $el.find('canvas')[0],
                        context = canvas.getContext('2d'),
                        total_deegres = one_percent * percent;
                    canvas.width = canvas.height = width;
                    context.strokeStyle = fill_color;
                    context.lineWidth = line_width;
                    draw_circle(context, width, center, radius, total_deegres);
                });
            });
        });
        $j('.progress-circle:not(.is-loaded)').waypoint({
            handler: function(direction) {
                var $el = $j(this.element),
                    width = $el.width(),
                    percent = $el.data('percent') ? parseInt($el.data('percent'), 10) : 25,
                    fill_color = $el.data('fill-color'),
                    radius = (width - line_width) / 2,
                    center = width / 2,
                    canvas = document.createElement('canvas'),
                    context = canvas.getContext('2d'),
                    deegres = 0,
                    total_deegres = one_percent * percent;
                $el.addClass('is-loaded');
                canvas.className = 'progress-circle-canvas';
                canvas.width = canvas.height = width;
                $el.append(canvas);
                context.strokeStyle = fill_color;
                context.lineWidth = line_width;
                draw_circle(context, width, center, radius, deegres);
                var draw = setInterval(function() {
                    deegres += 7;
                    deegres = Math.min(deegres, total_deegres);
                    apalodi_rAF(function() {
                        draw_circle(context, width, center, radius, deegres);
                    });
                    if (deegres >= total_deegres) {
                        clearInterval(draw);
                        $el.addClass('is-ready');
                    }
                }, 10);
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '95%'
        });
    }
}
if (typeof window['apalodi_google_maps'] !== 'function') {
    window.apalodi_google_maps = function() {
        'use strict';
        if (typeof google != 'undefined') {
            var geocoder = new google.maps.Geocoder();
        }
        $j('.google-map').waypoint({
            handler: function(direction) {
                var $this = $j(this.element),
                    address = $this.data('address'),
                    text = $this.data('text'),
                    zoom = $this.data('zoom'),
                    scrollwheel = $this.data('scrollwheel'),
                    map_type_id = $this.data('map_type_id'),
                    icon = $this.data('icon'),
                    styles = $this.data('styles'),
                    map, marker, info_window;
                switch (map_type_id) {
                    case 'SATELLITE':
                        map_type_id = google.maps.MapTypeId.SATELLITE;
                        break;
                    case 'HYBRID':
                        map_type_id = google.maps.MapTypeId.HYBRID;
                        break;
                    case 'TERRAIN':
                        map_type_id = google.maps.MapTypeId.TERRAIN;
                        break;
                    case 'ROADMAP':
                        map_type_id = google.maps.MapTypeId.ROADMAP;
                        break;
                }
                var map_options = {
                    zoom: zoom,
                    scrollwheel: scrollwheel,
                    mapTypeId: map_type_id
                }
                if ('' != styles) {
                    $j.extend(map_options, {
                        styles: [{
                            stylers: [{
                                hue: styles.hue
                            }, {
                                saturation: styles.saturation
                            }, {
                                lightness: styles.lightness
                            }, {
                                gamma: styles.gamma
                            }]
                        }]
                    });
                }
                map = new google.maps.Map($this[0], map_options);
                info_window = new google.maps.InfoWindow({
                    content: text ? text : address
                });
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (google.maps.GeocoderStatus.OK === status) {
                        map.setCenter(results[0].geometry.location);
                        marker = new google.maps.Marker({
                            map: map,
                            icon: icon,
                            position: results[0].geometry.location
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            info_window.open(map, marker);
                        });
                        google.maps.event.addDomListener(window, 'resize', function() {
                            map.setCenter(results[0].geometry.location);
                        });
                        setTimeout(function() {
                            $this.addClass('is-ready');
                        }, 100);
                    } else {
                        $this.html("Google Maps can't find the address: " + address + ". Please add more info about the address like city and country");
                    }
                });
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '95%'
        });
    }
}
if (typeof window['apalodi_animate_elements'] !== 'function') {
    window.apalodi_animate_elements = function() {
        'use strict';
        if (azra_js.is_mobile && !azra_js.is_mobile_animations) {
            return;
        }
        var collection = [];
        var stagger_animation = function() {
            setTimeout(function() {
                $j.each(collection, function(index, element) {
                    var stagger = 80 * index;
                    setTimeout(function() {
                        var animation = element.data('animation') ? element.data('animation') : 'fadeInUp';
                        element.addClass('is-animated ' + animation);
                    }, stagger);
                });
                collection = [];
            }, 50);
        };
        $j('.animate-element:not(.animate-stagger):not(.is-animated)').waypoint({
            handler: function() {
                var $element = $j(this.element);
                apalodi_rAF(function() {
                    var animation = $element.data('animation') ? $element.data('animation') : 'fadeInUp';
                    $element.addClass('is-animated ' + animation);
                });
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '90%'
        });
        $j('.animate-stagger:not(.is-animated)').waypoint({
            handler: function() {
                collection.push($j(this.element));
                apalodi_rAF(stagger_animation);
                this.destroy();
            },
            context: 'window, .vp-ajax-type-modal .vp-ajax-inner',
            offset: '90%'
        });
    }
}
if (typeof window['apalodi_shop_tabs'] !== 'function') {
    window.apalodi_shop_tabs = function() {
        'use strict';
        $j('.product-tabs').on('init', function() {
            var $tabs = $j(this).find('.tabs'),
                hash = window.location.hash,
                url = window.location.href;
            if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews') {
                $tabs.find('.tab[href="#tab-reviews"]').trigger(azra_js.event_type);
            } else if (url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {
                $tabs.find('.tab[href=#tab-reviews]').addClass('sup').trigger(azra_js.event_type);
            }
        });
        setTimeout(function() {
            $j('.product-tabs').trigger('init');
        }, 10);
    }
}
if (typeof window['apalodi_shop_ratings'] !== 'function') {
    window.apalodi_shop_ratings = function() {
        'use strict';
        $j('#rating').hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');
        $j('body #respond').on('click', 'p.stars a', function(event) {
            event.preventDefault();
            var $star = $j(this),
                $rating = $j(this).closest('#respond').find('#rating'),
                $container = $j(this).closest('.stars');
            $rating.val($star.text());
            $star.siblings('a').removeClass('active');
            $star.addClass('active');
            $container.addClass('selected');
        });
    }
}
if (typeof window['apalodi_link_hash_scroll'] !== 'function') {
    window.apalodi_link_hash_scroll = function() {
        'use strict';
        var selector = 'a[href*="#"]:not(.no-hash-scroll):not(.tab):not(.accordion-nav):not(.toggle-nav)';
        $j(document).on(azra_js.event_type, selector, function(event) {
            var $this = $j(this),
                hash = this.hash,
                no_scroll = ['#respond', '#comments'];
            if (location.hostname == this.hostname && '-1' == $j.inArray(hash, no_scroll)) {
                var $el = $j(hash);
                if ($el.length) {
                    event.preventDefault();
                    var elementOffset = $el.offset().top,
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
                        wpadminbar = $j('#wpadminbar').height() * 2;
                    }
                    var offset = elementOffset - headerOffset - wpadminbar;
                    $j('html, body').animate({
                        scrollTop: offset
                    }, 450);
                }
            }
        });
    }
}
if (typeof window['apalodi_contact_form'] !== 'function') {
    window.apalodi_contact_form = function() {
        'use strict';
        var $form = $j('.contact-form');
        $form.submit(function(event) {
            event.preventDefault();
            var $submit = $form.find('.contact-submit'),
                submit_text = $submit.text(),
                sending_text = $submit.data('sending-text'),
                sent_text = $submit.data('sent-text'),
                error_text = $submit.data('error-text'),
                send_again_text = $submit.data('send-again-text'),
                data = $form.serialize();
            if ($submit.hasClass('is-sent')) {
                return false;
            }
            $submit.text(sending_text).addClass('is-sending');
            $j.ajax({
                type: 'POST',
                url: azra_js.ajax_url,
                data: {
                    action: 'contact_form',
                    form: data
                },
                success: function(data) {
                    data = $j.parseJSON(data);
                    setTimeout(function() {
                        if ('success' == data.type) {
                            $submit.text(sent_text).addClass('is-sent').removeClass('is-sending');
                        } else {
                            $submit.text(error_text).addClass('is-error').removeClass('is-sending');
                            setTimeout(function() {
                                $submit.text(send_again_text).removeClass('is-error');
                            }, 2000);
                        }
                    }, 600);
                },
                error: function() {
                    $submit.text(error_text).addClass('is-error').removeClass('is-sending');
                    setTimeout(function() {
                        $submit.text(send_again_text).removeClass('is-error');
                    }, 2000);
                }
            });
        });
    }
}
if (typeof window['apalodi_back_to_top'] !== 'function') {
    window.apalodi_back_to_top = function() {
        'use strict';
        var $button = $j('.back-to-top');
        if (!azra_js.is_mobile && $button.length) {
            $j('body').waypoint({
                handler: function(direction) {
                    $button.toggleClass('is-visible');
                },
                offset: -200
            });
        }
        $j(document).on(azra_js.event_type, '.back-to-top', function() {
            $j('html, body').animate({
                scrollTop: 0
            }, 450);
        });
    }
}