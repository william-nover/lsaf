"use strict";
var lastScroll = 0,
    isMobile = !1,
    isiPhoneiPad = !1;

function SetMegamenuPosition() {
    $(window).width() > 991 ? setTimeout(function() {
        var e = $("nav.navbar").outerHeight();
        $(".mega-menu").css({
            top: e
        }), 0 === $(".navbar-brand-top").length && $(".dropdown.simple-dropdown > .dropdown-menu").css({
            top: e
        })
    }, 200) : ($(".mega-menu").css("top", ""), $(".dropdown.simple-dropdown > .dropdown-menu").css("top", ""))
}

function pad(e) {
    return e < 10 ? "0" + e.toString() : e.toString()
}

function isIE() {
    return !!(window.navigator.userAgent.indexOf("MSIE ") > 0 || navigator.userAgent.match(/Trident.*rv\:11\./))
}

function setPageTitleSpace() {
    if (($(".navbar").hasClass("navbar-top") || $("nav").hasClass("navbar-fixed-top")) && $(".top-space").length > 0) {
        var e = $(".navbar").outerHeight();
        $(".top-header-area").length > 0 && (e += $(".top-header-area").outerHeight()), $(".top-space").css("margin-top", e + "px")
    }
}

function setButtonPosition() {
    if ($(window).width() > 767 && $(".swiper-auto-height-container").length > 0) {
        var e = parseInt($(".swiper-auto-height-container .swiper-slide").css("padding-left")),
            t = parseInt($(".swiper-auto-height-container .swiper-slide").css("padding-bottom")),
            i = parseInt($(".swiper-auto-height-container .slide-banner").outerWidth());
        $(".navigation-area").css({
            left: i + e + "px",
            bottom: t + "px"
        })
    } else $(".swiper-auto-height-container").length > 0 && $(".navigation-area").css({
        left: "",
        bottom: ""
    })
}

function init_scroll_navigate() {
    var e = $(".navbar-nav li a"),
        t = $(document).scrollTop();
    t += 60, e.each(function() {
        var i = $(this),
            a = i.attr("href").indexOf("#");
        if (a > -1) {
            var n = i.attr("href").substring(a);
            if ($(n).length > 0) {
                var o = $(n);
                o.offset().top <= t && o.offset().top + o.height() > t ? (e.not(i).removeClass("active"), i.addClass("active")) : i.removeClass("active")
            }
        }
    });
    var i = $(window),
        a = $(".bg-background-fade"),
        n = $(".color-code"),
        o = i.scrollTop() + i.height() / 2;
    n.each(function() {
        var e = $(this);
        e.position().top <= o && e.position().top + e.height() > o && (a.removeClass(function(e, t) {
            return (t.match(/(^|\s)color-\S+/g) || []).join(" ")
        }), a.addClass("color-" + $(this).data("color")))
    });
    var s = $("nav").outerHeight();
    $("header").hasClass("no-sticky") || ($(document).scrollTop() >= s ? $("header").addClass("sticky") : $(document).scrollTop() <= s && ($("header").removeClass("sticky"), setTimeout(function() {
        setPageTitleSpace()
    }, 500)), SetMegamenuPosition());
    var l = $(this).scrollTop();
    l > lastScroll ? $(".sticky").removeClass("header-appear") : $(".sticky").addClass("header-appear"), (lastScroll = l) <= s && $("header").removeClass("header-appear")
}

function parallax_text() {
    $(window).width() > 1024 && 0 !== $(".swiper-auto-slide .swiper-slide").length && ($(document).on("mousemove", ".swiper-auto-slide .swiper-slide", function(e) {
        var t = e.clientX,
            i = e.clientY;
        t = Math.round(t / 10) - 80, i = Math.round(i / 10) - 40, $(this).find(".parallax-text").css({
            transform: "translate(" + t + "px," + i + "px)",
            "transition-duration": "0s"
        })
    }), $(document).on("mouseout", ".swiper-auto-slide .swiper-slide", function(e) {
        $(".parallax-text").css({
            transform: "translate(0,0)",
            "transition-duration": "0.5s"
        })
    }))
}

function ScrollStop() {
    return !1
}

function ScrollStart() {
    return !0
}

function validationSearchForm() {
    var e = !0;
    return $("#search-header input[type=text]").each(function(t) {
        0 === t && (null === $(this).val() || "" === $(this).val() ? ($("#search-header").find("input:eq(" + t + ")").css({
            border: "none",
            "border-bottom": "2px solid red"
        }), e = !1) : $("#search-header").find("input:eq(" + t + ")").css({
            border: "none",
            "border-bottom": "2px solid #000"
        }))
    }), e
}

function equalizeHeight() {
    $(document).imagesLoaded(function() {
        return $(window).width() < 768 ? ($(".equalize").equalize({
            equalize: "outerHeight",
            reset: !0
        }), $(".equalize.md-equalize-auto").children().css("height", ""), $(".equalize.sm-equalize-auto").children().css("height", ""), $(".equalize.xs-equalize-auto").children().css("height", ""), !1) : $(window).width() < 992 ? ($(".equalize").equalize({
            equalize: "outerHeight",
            reset: !0
        }), $(".equalize.md-equalize-auto").children().css("height", ""), $(".equalize.sm-equalize-auto").children().css("height", ""), !1) : $(window).width() < 1199 ? ($(".equalize").equalize({
            equalize: "outerHeight",
            reset: !0
        }), $(".equalize.md-equalize-auto").children().css("height", ""), !1) : void $(".equalize").equalize({
            equalize: "outerHeight",
            reset: !0
        })
    })
}

function feature_dynamic_font_line_height() {
    if ($(".dynamic-font-size").length > 0) {
        var e = $(window).width();
        if (e < 1100) {
            var t = e / 1100;
            $(".dynamic-font-size").each(function() {
                var e = $(this).attr("data-fontsize"),
                    i = $(this).attr("data-lineheight");
                if ("" != e && null != e) {
                    var a = Math.round(e * t * 1e3) / 1e3;
                    $(this).css("font-size", a + "px")
                }
                if ("" !== i && void 0 !== i) {
                    var n = Math.round(i * t * 1e3) / 1e3;
                    $(this).css("line-height", n + "px")
                }
            })
        } else $(".dynamic-font-size").each(function() {
            var e = $(this).attr("data-fontsize"),
                t = $(this).attr("data-lineheight");
            "" !== e && void 0 !== e && $(this).css("font-size", e + "px"), "" !== t && void 0 !== t && $(this).css("line-height", t + "px")
        })
    }
}

function stellarParallax() {
    $(window).width() > 1024 ? $.stellar() : ($.stellar("destroy"), $(".parallax").css("background-position", ""))
}

function fullScreenHeight() {
    var e = $(".full-screen"),
        t = $(window).height();
    e.parents("section").imagesLoaded(function() {
        if ($(".top-space .full-screen").length > 0) {
            var i = $("header nav.navbar").outerHeight();
            $(".top-space .full-screen").css("min-height", t - i)
        } else e.css("min-height", t)
    });
    var i = $(window).width();
    $(".full-screen-width").css("min-width", i);
    var a = $(".sidebar-nav-style-1").height() - $(".logo-holder").parent().height() - $(".footer-holder").parent().height() - 10;
    $(".sidebar-nav-style-1 .nav").css("height", a);
    var n = parseInt($(".sidebar-part2").height() - parseInt($(".sidebar-part2 .sidebar-middle").css("padding-top")) - parseInt($(".sidebar-part2 .sidebar-middle").css("padding-bottom")) - parseInt($(".sidebar-part2 .sidebar-middle .sidebar-middle-menu .nav").css("margin-bottom")));
    $(".sidebar-part2 .sidebar-middle .sidebar-middle-menu .nav").css("height", n)
}

function SetResizeContent() {
    feature_dynamic_font_line_height(), SetMegamenuPosition(), setPageTitleSpace(), setButtonPosition(), parallax_text(), stellarParallax(), fullScreenHeight(), equalizeHeight()
}
/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && (isMobile = !0), /iPhone|iPad|iPod/i.test(navigator.userAgent) && (isiPhoneiPad = !0), $(window).on("scroll", init_scroll_navigate), $(window).resize(function(e) {
    $("nav.navbar.bootsnav ul.nav").each(function() {
        $("li.dropdown", this).on("mouseenter", function(e) {
            if ($(window).width() > 991) return $(this).find(".equalize").equalize({
                equalize: "outerHeight",
                reset: !0
            }), !1
        })
    }), setTimeout(function() {
        SetResizeContent()
    }, 500), e.preventDefault()
}), $(document).ready(function() {
    $("nav.navbar.bootsnav ul.nav").each(function() {
        $("li.dropdown", this).on("mouseenter", function() {
            if ($(window).width() > 991) return $(this).find(".equalize").equalize({
                equalize: "outerHeight",
                reset: !0
            }), !1
        })
    }), $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
        var t = $(e.target).attr("href");
        if ($(window).width() > 991) return $(t).find(".equalize").equalize({
            equalize: "outerHeight",
            reset: !0
        }), !1
    });
    var e = window.location.href.substr(window.location.href.lastIndexOf("/") + 1),
        t = window.location.hash.substring(1);
    t ? (t = "#" + t, e = e.replace(t, "")) : e = e.replace("#", ""), $(".nav li a").each(function() {
        $(this).attr("href") != e && $(this).attr("href") != e + ".html" || ($(this).parent().addClass("active"), $(this).parents("li.dropdown").addClass("active"))
    }), $(window).scroll(function() {
        $(this).scrollTop() > 150 ? $(".scroll-top-arrow").fadeIn("slow") : $(".scroll-top-arrow").fadeOut("slow")
    }), $(document).on("click", ".scroll-top-arrow", function() {
        return $("html, body").animate({
            scrollTop: 0
        }, 800), !1
    });
    var i = new Swiper(".swiper-full-screen", {
            loop: !0,
            slidesPerView: 1,
            preventClicks: !1,
            allowTouchMove: !0,
            pagination: {
                el: ".swiper-full-screen-pagination",
                clickable: !0
            },
            autoplay: {
                delay: 5e3
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            on: {
                resize: function() {
                    i.update()
                }
            }
        }),
        a = new Swiper(".swiper-auto-fade", {
            allowTouchMove: !0,
            loop: !0,
            slidesPerView: 1,
            preventClicks: !1,
            effect: "fade",
            autoplay: {
                delay: 5e3
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-auto-pagination",
                clickable: !0
            },
            on: {
                resize: function() {
                    a.update()
                }
            }
        }),
        n = new Swiper(".swiper-slider-second", {
            allowTouchMove: !0,
            slidesPerView: 1,
            preventClicks: !1,
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination-second",
                clickable: !0
            },
            on: {
                resize: function() {
                    n.update()
                }
            }
        }),
        o = new Swiper(".swiper-slider-third", {
            allowTouchMove: !0,
            slidesPerView: 1,
            preventClicks: !1,
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination-third",
                clickable: !0
            },
            on: {
                resize: function() {
                    o.update()
                }
            }
        }),
        s = new Swiper(".swiper-number-pagination", {
            allowTouchMove: !0,
            preventClicks: !1,
            autoplay: {
                delay: 4e3,
                disableOnInteraction: !0
            },
            pagination: {
                el: ".swiper-number",
                clickable: !0,
                renderBullet: function(e, t) {
                    return '<span class="' + t + '">' + pad(e + 1) + "</span>"
                }
            },
            on: {
                resize: function() {
                    s.update()
                }
            }
        }),
        l = new Swiper(".swiper-vertical-pagination", {
            allowTouchMove: !0,
            direction: "vertical",
            slidesPerView: 1,
            spaceBetween: 0,
            preventClicks: !1,
            mousewheel: {
                mousewheel: !0,
                sensitivity: 1,
                releaseOnEdges: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination-vertical",
                clickable: !0
            },
            on: {
                resize: function() {
                    l.update()
                }
            }
        }),
        r = new Swiper(".swiper-slider-clients", {
            allowTouchMove: !0,
            slidesPerView: 4,
            paginationClickable: !0,
            preventClicks: !0,
            autoplay: {
                delay: 3e3,
                disableOnInteraction: !0
            },
            pagination: {
                el: null
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3
                },
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    r.update()
                }
            }
        }),
        d = new Swiper(".swiper-slider-clients-second", {
            allowTouchMove: !0,
            slidesPerView: 4,
            paginationClickable: !0,
            preventClicks: !0,
            autoplay: {
                delay: 3e3,
                disableOnInteraction: !0
            },
            pagination: {
                el: null
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3
                },
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    d.update()
                }
            }
        }),
        c = new Swiper(".swiper-three-slides", {
            allowTouchMove: !0,
            slidesPerView: 3,
            preventClicks: !1,
            pagination: {
                el: ".swiper-pagination-three-slides",
                clickable: !0
            },
            autoplay: {
                delay: 3e3
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-three-slide-next",
                prevEl: ".swiper-three-slide-prev"
            },
            breakpoints: {
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    c.update()
                }
            }
        }),
        p = new Swiper(".swiper-four-slides", {
            allowTouchMove: !0,
            slidesPerView: 4,
            preventClicks: !1,
            pagination: {
                el: ".swiper-pagination-four-slides",
                clickable: !0
            },
            autoplay: {
                delay: 3e3
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3
                },
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    p.update()
                }
            }
        }),
        u = new Swiper(".swiper-demo-header-style", {
            allowTouchMove: !0,
            loop: !0,
            slidesPerView: 4,
            preventClicks: !0,
            slidesPerGroup: 4,
            pagination: {
                el: ".swiper-pagination-demo-header-style",
                clickable: !0
            },
            autoplay: {
                delay: 3e3
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                1199: {
                    slidesPerGroup: 2,
                    slidesPerView: 2
                },
                767: {
                    slidesPerGroup: 1,
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    u.update()
                }
            }
        }),
        h = 0,
        g = new Swiper(".swiper-auto-slide", {
            allowTouchMove: !0,
            slidesPerView: "auto",
            centeredSlides: !0,
            spaceBetween: 80,
            preventClicks: !1,
            observer: !0,
            speed: 1e3,
            pagination: {
                el: null
            },
            scrollbar: {
                el: ".swiper-scrollbar",
                draggable: !0,
                hide: !1,
                snapOnRelease: !0
            },
            autoplay: {
                delay: 3e3
            },
            mousewheel: {
                invert: !1
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-next-style2",
                prevEl: ".swiper-prev-style2"
            },
            breakpoints: {
                1199: {
                    spaceBetween: 60
                },
                960: {
                    spaceBetween: 30
                },
                767: {
                    spaceBetween: 15
                }
            },
            on: {
                resize: function() {
                    g.update()
                }
            }
        });
    if ($(window).width() > 767) var f = new Swiper(".swiper-bottom-scrollbar-full", {
        allowTouchMove: !0,
        slidesPerView: "auto",
        grabCursor: !0,
        preventClicks: !1,
        spaceBetween: 30,
        keyboardControl: !0,
        speed: 1e3,
        pagination: {
            el: null
        },
        scrollbar: {
            el: ".swiper-scrollbar",
            draggable: !0,
            hide: !1,
            snapOnRelease: !0
        },
        mousewheel: {
            enable: !0
        },
        keyboard: {
            enabled: !0
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
    });
    var w, m = new Swiper(".swiper-auto-height-container", {
            allowTouchMove: !0,
            effect: "fade",
            loop: !0,
            autoHeight: !0,
            pagination: {
                el: ".swiper-auto-height-pagination",
                clickable: !0
            },
            autoplay: {
                delay: 3e3
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            on: {
                resize: function() {
                    m.update()
                }
            }
        }),
        v = new Swiper(".swiper-multy-row-container", {
            allowTouchMove: !0,
            slidesPerView: 4,
            spaceBetween: 15,
            pagination: {
                el: ".swiper-multy-row-pagination",
                clickable: !0
            },
            autoplay: {
                delay: 3e3,
                disableOnInteraction: !0
            },
            navigation: {
                nextEl: ".swiper-portfolio-next",
                prevEl: ".swiper-portfolio-prev"
            },
            breakpoints: {
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    v.update()
                }
            }
        }),
        b = new Swiper(".swiper-blog", {
            allowTouchMove: !0,
            slidesPerView: "auto",
            centeredSlides: !0,
            spaceBetween: 15,
            preventClicks: !1,
            loop: !0,
            loopedSlides: 3,
            pagination: {
                el: ".swiper-blog-pagination",
                clickable: !0
            },
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            on: {
                resize: function() {
                    b.update()
                }
            }
        }),
        y = new Swiper(".swiper-presentation", {
            allowTouchMove: !0,
            slidesPerView: 4,
            centeredSlides: !0,
            spaceBetween: 30,
            preventClicks: !0,
            loop: !0,
            loopedSlides: 6,
            pagination: {
                el: ".swiper-presentation-pagination",
                clickable: !0
            },
            autoplay: {
                delay: 3e3,
                disableOnInteraction: !0
            },
            keyboard: {
                enabled: !0
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                991: {
                    spaceBetween: 15,
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function() {
                    y.update()
                }
            }
        });

    function C() {
        f && (f.detachEvents(), f.destroy(!0, !0), f = void 0), $(".swiper-bottom-scrollbar-full .swiper-wrapper").css("transform", "").css("transition-duration", ""), $(".swiper-bottom-scrollbar-full .swiper-slide").css("margin-right", ""), $(".swiper-bottom-scrollbar-full .swiper-wrapper").removeAttr("style"), $(".swiper-bottom-scrollbar-full .swiper-slide").removeAttr("style"), $(window).width() > 767 && setTimeout(function() {
            f = new Swiper(".swiper-bottom-scrollbar-full", {
                allowTouchMove: !0,
                slidesPerView: "auto",
                grabCursor: !0,
                preventClicks: !1,
                spaceBetween: 30,
                keyboardControl: !0,
                speed: 1e3,
                pagination: {
                    el: null
                },
                scrollbar: {
                    el: ".swiper-scrollbar",
                    draggable: !0,
                    hide: !1,
                    snapOnRelease: !0
                },
                mousewheel: {
                    enable: !0
                },
                keyboard: {
                    enabled: !0
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            })
        }, 500)
    }
    $(window).resize(function() {
        $(".swiper-auto-slide").length > 0 && g && (h = g.activeIndex, g.detachEvents(), g.destroy(!0, !1), g = void 0, $(".swiper-auto-slide .swiper-wrapper").css("transform", "").css("transition-duration", ""), $(".swiper-auto-slide .swiper-slide").css("margin-right", ""), setTimeout(function() {
            (g = new Swiper(".swiper-auto-slide", {
                allowTouchMove: !0,
                slidesPerView: "auto",
                centeredSlides: !0,
                spaceBetween: 80,
                preventClicks: !1,
                mousewheelControl: !0,
                observer: !0,
                speed: 1e3,
                pagination: {
                    el: null
                },
                scrollbar: {
                    el: ".swiper-scrollbar",
                    draggable: !0,
                    hide: !1,
                    snapOnRelease: !0
                },
                autoplay: {
                    delay: 3e3
                },
                keyboard: {
                    enabled: !0
                },
                navigation: {
                    nextEl: ".swiper-next-style2",
                    prevEl: ".swiper-prev-style2"
                },
                breakpoints: {
                    1199: {
                        spaceBetween: 60
                    },
                    960: {
                        spaceBetween: 30
                    },
                    767: {
                        spaceBetween: 15
                    }
                },
                on: {
                    resize: function() {
                        g.update()
                    }
                }
            })).slideTo(h, 1e3, !1)
        }, 1e3)), $(".swiper-bottom-scrollbar-full").length > 0 && (clearTimeout(w), w = setTimeout(C, 1e3)), setTimeout(function() {
            $(".swiper-full-screen").length > 0 && i && i.update(), $(".swiper-auto-fade").length > 0 && a && a.update(), $(".swiper-slider-second").length > 0 && n && n.update(), $(".swiper-slider-third").length > 0 && o && o.update(), $(".swiper-number-pagination").length > 0 && s && s.update(), $(".swiper-vertical-pagination").length > 0 && l && l.update(), $(".swiper-slider-clients").length > 0 && r && r.update(), $(".swiper-slider-clients-second").length > 0 && d && d.update(), $(".swiper-three-slides").length > 0 && c && c.update(), $(".swiper-four-slides").length > 0 && p && p.update(), $(".swiper-demo-header-style").length > 0 && u && u.update(), $(".swiper-auto-slide").length > 0 && g && g.update(), $(".swiper-auto-height-container").length > 0 && m && m.update(), $(".swiper-multy-row-container").length > 0 && v && v.update(), $(".swiper-blog").length > 0 && b && b.update(), $(".swiper-presentation").length > 0 && y && y.update()
        }, 500), isIE() && setTimeout(function() {
            $(".swiper-full-screen").length > 0 && i && i.update(), $(".swiper-auto-fade").length > 0 && a && a.update(), $(".swiper-slider-second").length > 0 && n && n.update(), $(".swiper-slider-third").length > 0 && o && o.update(), $(".swiper-number-pagination").length > 0 && s && s.update(), $(".swiper-vertical-pagination").length > 0 && l && l.update(), $(".swiper-slider-clients").length > 0 && r && r.update(), $(".swiper-slider-clients-second").length > 0 && d && d.update(), $(".swiper-three-slides").length > 0 && c && c.update(), $(".swiper-four-slides").length > 0 && p && p.update(), $(".swiper-demo-header-style").length > 0 && u && u.update(), $(".swiper-auto-slide").length > 0 && g && g.update(), $(".swiper-auto-height-container").length > 0 && m && m.update(), $(".swiper-multy-row-container").length > 0 && v && v.update(), $(".swiper-blog").length > 0 && b && b.update(), $(".swiper-presentation").length > 0 && y && y.update()
        }, 500)
    });
    $(document).on("click.smoothscroll", "a.scrollto", function(e) {
        e.preventDefault();
        var t = this.hash;
        0 != $(t).length && $("html, body").stop().animate({
            scrollTop: $(t).offset().top
        }, 1200, "easeInOutExpo", function() {
            window.location.hash = t
        })
    }), $(".full-width-pull-menu").length > 0 && $(document).on("click", ".full-width-pull-menu .inner-link", function(e) {
        $(".full-width-pull-menu .close-button-menu").trigger("click");
        var t = $(this);
        setTimeout(function() {
            var e = t.attr("href");
            $(e).length > 0 && $("html, body").stop().animate({
                scrollTop: $(e).offset().top
            })
        }, 500)
    }), $(".navbar-top").length > 0 || $(".navbar-scroll-top").length > 0 || $(".nav-top-scroll").length > 0 ? $(".inner-link").smoothScroll({
        speed: 900,
        offset: 0
    }) : $(".inner-link").smoothScroll({
        speed: 900,
        offset: -59
    }), $(".section-link").smoothScroll({
        speed: 900,
        offset: 1
    }), $(".chart1").length > 0 && ($(".chart1").appear(), $(".chart1").easyPieChart({
        barColor: "#929292",
        trackColor: "#d9d9d9",
        scaleColor: !1,
        easing: "easeOutBounce",
        scaleLength: 1,
        lineCap: "round",
        lineWidth: 3,
        size: 150,
        animate: {
            duration: 2e3,
            enabled: !0
        },
        onStep: function(e, t, i) {
            $(this.el).find(".percent").text(Math.round(i))
        }
    }), $(document.body).on("appear", ".chart1", function(e) {
        $(this).hasClass("appear") || ($(this).addClass("appear"), $(this).data("easyPieChart").update(0).update($(this).data("percent")))
    })), $(".chart2").length > 0 && ($(".chart2").appear(), $(".chart2").easyPieChart({
        easing: "easeOutCirc",
        barColor: "#ff214f",
        trackColor: "#c7c7c7",
        scaleColor: !1,
        scaleLength: 1,
        lineCap: "round",
        lineWidth: 2,
        size: 120,
        animate: {
            duration: 2e3,
            enabled: !0
        },
        onStep: function(e, t, i) {
            $(this.el).find(".percent").text(Math.round(i))
        }
    }), $(document.body).on("appear", ".chart2", function(e) {
        $(this).hasClass("appear") || ($(this).addClass("appear"), $(this).data("easyPieChart").update(0).update($(this).data("percent")))
    })), $(".chart3").length > 0 && ($(".chart3").appear(), $(".chart3").easyPieChart({
        easing: "easeOutCirc",
        barColor: "#ff214f",
        trackColor: "",
        scaleColor: !1,
        scaleLength: 1,
        lineCap: "round",
        lineWidth: 3,
        size: 140,
        animate: {
            duration: 2e3,
            enabled: !0
        },
        onStep: function(e, t, i) {
            $(this.el).find(".percent").text(Math.round(i))
        }
    }), $(document.body).on("appear", ".chart3", function(e) {
        $(this).hasClass("appear") || ($(this).addClass("appear"), $(this).data("easyPieChart").update(0).update($(this).data("percent")))
    }));
    var k = $(".portfolio-grid");
    k.imagesLoaded(function() {
        k.isotope({
            layoutMode: "masonry",
            itemSelector: ".grid-item",
            percentPosition: !0,
            masonry: {
                columnWidth: ".grid-sizer"
            }
        }), k.isotope()
    });
    var x = $(".portfolio-filter > li > a");
    x.on("click", function() {
        x.parent().removeClass("active"), $(this).parent().addClass("active");
        var e = $(this).attr("data-filter");
        return k.find(".grid-item").removeClass("animated").css("visibility", ""), k.find(".grid-item").each(function() {
            S.removeBox(this), $(this).css("-webkit-animation", "none"), $(this).css("-moz-animation", "none"), $(this).css("-ms-animation", "none"), $(this).css("animation", "none")
        }), k.isotope({
            filter: e
        }), !1
    }), $(window).resize(function() {
        isMobile || isiPhoneiPad || k.imagesLoaded(function() {
            setTimeout(function() {
                k.find(".grid-item").removeClass("wow").removeClass("animated"), k.isotope("layout")
            }, 300)
        })
    });
    var P = $(".blog-grid");
    P.imagesLoaded(function() {
        P.isotope({
            layoutMode: "masonry",
            itemSelector: ".grid-item",
            percentPosition: !0,
            masonry: {
                columnWidth: ".grid-sizer"
            }
        })
    }), $(window).resize(function() {
        setTimeout(function() {
            P.find(".grid-item").removeClass("wow").removeClass("animated"), P.isotope("layout")
        }, 300)
    }), $(".lightbox-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        tLoading: "Loading image #%curr%...",
        mainClass: "mfp-fade",
        fixedContentPos: !0,
        closeBtnInside: !1,
        gallery: {
            enabled: !0,
            navigateByImgClick: !0,
            preload: [0, 1]
        }
    });
    var z = {};
    $(".lightbox-group-gallery-item").each(function() {
        var e = $(this).attr("data-group");
        z[e] || (z[e] = []), z[e].push(this)
    }), $.each(z, function() {
        $(this).magnificPopup({
            type: "image",
            closeOnContentClick: !0,
            closeBtnInside: !1,
            gallery: {
                enabled: !0
            }
        })
    }), $(".lightbox-portfolio").magnificPopup({
        delegate: ".gallery-link",
        type: "image",
        tLoading: "Loading image #%curr%...",
        mainClass: "mfp-fade",
        fixedContentPos: !0,
        closeBtnInside: !1,
        gallery: {
            enabled: !0,
            navigateByImgClick: !1,
            preload: [0, 1]
        }
    }), $(".single-image-lightbox").magnificPopup({
        type: "image",
        closeOnContentClick: !0,
        fixedContentPos: !0,
        closeBtnInside: !1,
        mainClass: "mfp-no-margins mfp-with-zoom",
        image: {
            verticalFit: !0
        },
        zoom: {
            enabled: !0,
            duration: 300
        }
    }), $(".zoom-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        mainClass: "mfp-with-zoom mfp-img-mobile",
        fixedContentPos: !0,
        closeBtnInside: !1,
        image: {
            verticalFit: !0,
            titleSrc: function(e) {
                return e.el.attr("title")
            }
        },
        gallery: {
            enabled: !0
        },
        zoom: {
            enabled: !0,
            duration: 300,
            opener: function(e) {
                return e.find("img")
            }
        }
    }), $(".modal-popup").magnificPopup({
        type: "inline",
        preloader: !1,
        blackbg: !0,
        callbacks: {
            open: function() {
                $("html").css("margin-right", 0)
            }
        }
    }), $(document).on("click", ".popup-modal-dismiss", function(e) {
        e.preventDefault(), $.magnificPopup.close()
    }), $(".popup-with-zoom-anim").magnificPopup({
        type: "inline",
        fixedContentPos: !1,
        fixedBgPos: !0,
        overflowY: "auto",
        closeBtnInside: !0,
        preloader: !1,
        midClick: !0,
        removalDelay: 300,
        blackbg: !0,
        mainClass: "my-mfp-zoom-in"
    }), $(".popup-with-move-anim").magnificPopup({
        type: "inline",
        fixedContentPos: !1,
        fixedBgPos: !0,
        overflowY: "auto",
        closeBtnInside: !0,
        preloader: !1,
        midClick: !0,
        removalDelay: 300,
        blackbg: !0,
        mainClass: "my-mfp-slide-bottom"
    }), $(".popup-with-form").magnificPopup({
        type: "inline",
        preloader: !1,
        closeBtnInside: !1,
        fixedContentPos: !0,
        focus: "#name",
        callbacks: {
            beforeOpen: function() {
                $(window).width() < 700 ? this.st.focus = !1 : this.st.focus = "#name"
            }
        }
    }), $(".ajax-popup").magnificPopup({
        type: "ajax",
        alignTop: !0,
        fixedContentPos: !0,
        overflowY: "scroll",
        callbacks: {
            open: function() {
                $(".navbar .collapse").removeClass("in"), $(".navbar a.dropdown-toggle").addClass("collapsed")
            }
        }
    }), $("ul.mega-menu-full").each(function(e, t) {
        var i = 0;
        $(this).children("li").each(function(e, t) {
            i += $(this).outerWidth()
        }), $(this).width(i + 95), i = 0
    });
    var S = new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: !1,
        live: !0
    });

    function T() {
        $(".timer").each(function(e) {
            var t = $(this);
            e = $.extend({}, e || {}, t.data("countToOptions") || {}), t.countTo(e)
        })
    }
    $(window).imagesLoaded(function() {
        S.init()
    }), $(function(e) {
        T()
    }), $(".timer").appear(), $(document.body).on("appear", ".timer", function(e) {
        $(this).hasClass("appear") || (T(), $(this).addClass("appear"))
    }), $(".countdown").countdown($(".countdown").attr("data-enddate")).on("update.countdown", function(e) {
        $(this).html(e.strftime('<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d</span></div><div class="counter-box"><div class="number">%H</div><span>Hours</span></div><div class="counter-box"><div class="number">%M</div><span>Minutes</span></div><div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'))
    }), $(document).on("click", ".right-menu-button", function(e) {
        $("body").toggleClass("left-nav-on")
    }), $(document).on("click", ".btn-hamburger", function() {
        $(".hamburger-menu").toggleClass("show-menu"), $("body").removeClass("show-menu")
    }), $(document).on("click", "#mobileToggleSidenav", function() {
        $(this).closest("nav").toggleClass("sidemenu-open")
    }), $(document).imagesLoaded(function() {
        $(".justified-gallery").length > 0 && $(".justified-gallery").justifiedGallery({
            rowHeight: 400,
            maxRowHeight: !1,
            captions: !0,
            margins: 10,
            waitThumbnailsLoad: !0
        })
    }), $(".atr-nav").on("click", function() {
        $(".atr-div").append("<a class='close-cross' href='#'>X</a>"), $(".atr-div").animate({
            width: "toggle"
        })
    }), $(".close-cross").on("click", function() {
        $(".atr-div").hide()
    });
    var _ = document.getElementById("cbp-spmenu-s2"),
        E = document.getElementById("showRightPush");
    document.body;
    E && (E.onclick = function() {
        classie.toggle(this, "active"), _ && classie.toggle(_, "cbp-spmenu-open")
    });
    var I = document.getElementById("close-pushmenu");
    (I && (I.onclick = function() {
        classie.toggle(this, "active"), _ && classie.toggle(_, "cbp-spmenu-open")
    }), $(".blog-header-style1 li").hover(function() {
        $(".blog-header-style1 li.blog-column-active").removeClass("blog-column-active"), $(this).addClass("blog-column-active")
    }, function() {
        $(this).removeClass("blog-column-active"), $(".blog-header-style1 li:first-child").addClass("blog-column-active")
    }), $(".big-menu-open").on("click", function() {
        $(".big-menu-right").addClass("open")
    }), $(".big-menu-close").on("click", function() {
        $(".big-menu-right").removeClass("open")
    }), 0 != $("#instaFeed-style1").length) && new Instafeed({
        target: "instaFeed-style1",
        get: "user",
        userId: 14193375854,
        limit: "8",
        accessToken: "14193375854.5011f83.5e9c0d781fa340368440a315048ee280",
        resolution: "low_resolution",
        error: {
            template: '<div class="col-md-12 col-sm-12 col-xs-12"><span class=text-center>No Images Found</span></div>'
        },
        template: '<div class="swiper-slide swiper-slide col-md-3 instafeed-style1">\n                            <a class="insta-link" href="{{link}}" target="_blank"><img src="{{image}}" alt="Sewa Mobil Box Jakarta" class="appr_slide thumb img-fluid mx-auto d-block insta-image" />\n                            <div class="insta-counts">\n                            <span><i class="fa fa-heart-o fa-2x"></i> <span class="count-number">{{likes}}</span></span><span>\n                            <i class="fa fa-comment-o"></i> \n                            <span class="count-number">{{comments}}</span></span></div></a>\n                            </div>',
        after: function() {
            var e = new Swiper(".swiper-four-slides", {
                allowTouchMove: !0,
                slidesPerView: 4,
                preventClicks: !1,
                pagination: {
                    el: ".swiper-pagination-four-slides",
                    clickable: !0
                },
                autoplay: {
                    delay: 3e3
                },
                keyboard: {
                    enabled: !0
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3
                    },
                    991: {
                        slidesPerView: 2
                    },
                    767: {
                        slidesPerView: 1
                    }
                },
                on: {
                    resize: function() {
                        e.update()
                    }
                }
            })
        }
    }).run();
    0 != $("#instaFeed-style3").length && new Instafeed({
        target: "instaFeed-style3",
        get: "user",
        userId: 14193375854,
        limit: "8",
        accessToken: "14193375854.5011f83.5e9c0d781fa340368440a315048ee280",
        resolution: "low_resolution",
        error: {
            template: '<div class="col-md-12 col-sm-12 col-xs-12"><span class=text-center>No Images Found</span></div>'
        },
        template: '<div class="col-md-4 instafeed-style1">\n                            <a class="insta-link" href="{{link}}" target="_blank"><img src="{{image}}" alt="Sewa Mobil Box Jakarta" class="appr_slide thumb img-fluid mx-auto d-block insta-image" />\n                            <div class="insta-counts">\n                            <span><i class="fa fa-heart-o fa-2x"></i> <span class="count-number">{{likes}}</span></span><span>\n                            <i class="fa fa-comment-o"></i> \n                            <span class="count-number">{{comments}}</span></span></div></a>\n                            </div>'
    }).run();
    0 != $("#instaFeed-aside").length && new Instafeed({
        target: "instaFeed-aside",
        get: "user",
        userId: 14193375854,
        limit: "80",
        accessToken: "14193375854.5011f83.5e9c0d781fa340368440a315048ee280",
        resolution: "low_resolution",
        after: function() {
            equalizeHeight()
        },
        error: {
            template: '<div class="col-md-12 col-sm-12 col-xs-12"><span class=text-center>No Images Found</span></div>'
        },
        template: '<li><figure><a href="{{link}}" target="_blank"><img src="{{image}}" class="insta-image" /><span class="insta-counts"><i class="ti-heart"></i>{{likes}}</span></a></figure></li>'
    }).run();
    0 != $("#instaFeed-footer").length && new Instafeed({
        target: "instaFeed-footer",
        get: "user",
        userId: 5640046896,
        limit: "6",
        accessToken: "5640046896.1677ed0.f7cd85767e124a9f9f8d698cb33252a0",
        resolution: "low_resolution",
        after: function() {
            equalizeHeight()
        },
        error: {
            template: '<div class="col-md-12 col-sm-12 col-xs-12"><span class=text-center>No Images Found</span></div>'
        },
        template: '<li><figure><a href="{{link}}" target="_blank"><img src="{{image}}" class="insta-image" /><span class="insta-counts"><i class="ti-heart"></i><span>{{likes}}</span></span></a></figure></li>'
    }).run();
    null == $("#rev_slider_151_1").revolution ? revslider_showDoubleJqueryError("#rev_slider_151_1") : $("#rev_slider_151_1").show().revolution({
        sliderType: "standard",
        jsFileLocation: "revolution/js/",
        sliderLayout: "fullscreen",
        dottedOverlay: "none",
        delay: 9e3,
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "vertical",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "off",
            touch: {
                touchenabled: "on",
                swipe_threshold: 75,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: !1
            },
            arrows: {
                style: "uranus",
                enable: !0,
                hide_onmobile: !1,
                hide_over: 479,
                hide_onleave: !1,
                tmp: "",
                left: {
                    h_align: "left",
                    v_align: "center",
                    h_offset: 0,
                    v_offset: 0
                },
                right: {
                    h_align: "right",
                    v_align: "center",
                    h_offset: 0,
                    v_offset: 0
                }
            }
        },
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1240, 1024, 778, 480],
        gridheight: [868, 768, 960, 720],
        lazyType: "none",
        scrolleffect: {
            blur: "on",
            maxblur: "20",
            on_slidebg: "on",
            direction: "top",
            multiplicator: "2",
            multiplicator_layers: "2",
            tilt: "10",
            disable_on_mobile: "off"
        },
        parallax: {
            type: "scroll",
            origo: "slidercenter",
            speed: 400,
            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55]
        },
        shadow: 0,
        spinner: "spinner3",
        stopLoop: "off",
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        fullScreenAutoWidth: "off",
        fullScreenAlignForce: "off",
        fullScreenOffsetContainer: "",
        fullScreenOffset: "0px",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: !1,
        fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: !1
        }
    }), $("input.search-input").on("keypress", function(e) {
        13 != e.which || isMobile || ($("button.search-button").trigger("click"), e.preventDefault())
    }), $("input.search-input").on("keyup", function(e) {
        null == $(this).val() || "" == $(this).val() ? $(this).css({
            border: "none",
            "border-bottom": "2px solid red"
        }) : $(this).css({
            border: "none",
            "border-bottom": "2px solid rgba(255,255,255,0.5)"
        })
    }), $("form.search-form, form.search-form-result").submit(function(e) {
        if (validationSearchForm()) {
            var t = $(this).attr("action");
            t = (t = "#" == t || "" == t ? "blog-grid-3columns.html" : t) + "?" + $(this).serialize(), window.location = t
        }
        e.preventDefault()
    }), $(document).on("click", '.navbar .navbar-collapse a.dropdown-toggle, .accordion-style1 .panel-heading a, .accordion-style2 .panel-heading a, .accordion-style3 .panel-heading a, .toggles .panel-heading a, .toggles-style2 .panel-heading a, .toggles-style3 .panel-heading a, a.carousel-control, .nav-tabs a[data-toggle="tab"], a.shopping-cart', function(e) {
        e.preventDefault()
    }), $(document).on("touchstart click", "body", function(e) {
        $(window).width() < 992 ? $(".navbar-collapse").has(e.target).is(".navbar-collapse") || !$(".navbar-collapse").hasClass("in") || $(e.target).hasClass("navbar-toggle") || $(".navbar-collapse").collapse("hide") : !$(".navbar-collapse").has(e.target).is(".navbar-collapse") && $(".navbar-collapse ul").hasClass("in") && ($(".navbar-collapse").find("a.dropdown-toggle").addClass("collapsed"), $(".navbar-collapse").find("ul.dropdown-menu").removeClass("in"), $(".navbar-collapse a.dropdown-toggle").removeClass("active"))
    }), $(".navbar-collapse a.dropdown-toggle").on("touchstart", function(e) {
        $(".navbar-collapse a.dropdown-toggle").not(this).removeClass("active"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active")
    }), $("button.navbar-toggle").on("click", function(e) {
        isMobile && ($(".cart-content").css("opacity", "0"), $(".cart-content").css("visibility", "hidden"))
    }), $("a.dropdown-toggle").on("click", function(e) {
        isMobile && ($(".cart-content").css("opacity", "0"), $(".cart-content").css("visibility", "hidden"))
    }), $(document).on("touchstart click", '.navbar-collapse [data-toggle="dropdown"]', function(e) {
        var t = $(this).parents("ul.navbar-nav").find("li.dropdown a.inner-link").parent("li.dropdown");
        $(this).hasClass("inner-link") || $(this).hasClass("dropdown-toggle") || !t.hasClass("open") || t.removeClass("open");
        var i = $(this).attr("target");
        if ($(window).width() <= 991 && $(this).attr("href") && $(this).attr("href").indexOf("#") <= -1 && !$(e.target).is("i")) {
            if (e.ctrlKey || e.metaKey) return window.open($(this).attr("href"), "_blank"), !1;
            i ? window.open($(this).attr("href"), i) : window.location = $(this).attr("href")
        } else if ($(window).width() > 991 && $(this).attr("href").indexOf("#") <= -1) {
            if (e.ctrlKey || e.metaKey) return window.open($(this).attr("href"), "_blank"), !1;
            i ? window.open($(this).attr("href"), i) : window.location = $(this).attr("href")
        } else $(window).width() <= 991 && $(this).attr("href") && $(this).attr("href").length > 1 && $(this).attr("href").indexOf("#") >= 0 && $(this).hasClass("inner-link") && ($(this).parents("ul.navbar-nav").find("li.dropdown").not($(this).parent(".dropdown")).removeClass("open"), $(this).parent(".dropdown").hasClass("open") ? $(this).parent(".dropdown").removeClass("open") : $(this).parent(".dropdown").addClass("open"), $(this).toggleClass("active"))
    }), $("body").on("touchstart click", function(e) {
        $(window).width()
    }), $("nav.full-width-pull-menu ul.panel-group li.dropdown a.dropdown-toggle").on("click", function(e) {
        $(this).parent("li").find("ul.dropdown-menu").length > 0 && ($(this).parent("li").hasClass("open") ? $(this).parent("li").removeClass("open") : $(this).parent("li").addClass("open"))
    }), $(".accordion-style1 .collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="ti-minus"></i>')
    }), $(".accordion-style1 .collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="ti-plus"></i>')
    }), $(".nav.navbar-nav a.inner-link").on("click", function(e) {
        $(this).parents("ul.navbar-nav").find("a.inner-link").removeClass("active");
        var t = $(this);
        $(".nav-header-container .navbar-toggle").is(":visible") && $(this).parents(".navbar-collapse").collapse("hide"), setTimeout(function() {
            t.addClass("active")
        }, 1e3)
    }), $(".accordion-style2 .collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("active-accordion"), $('a[href="#' + e + '"] .panel-title').find("i").addClass("fa-angle-up").removeClass("fa-angle-down")
    }), $(".accordion-style2 .collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("active-accordion"), $('a[href="#' + e + '"] .panel-title').find("i").removeClass("fa-angle-up").addClass("fa-angle-down")
    }), $(".accordion-style3 .collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("active-accordion"), $('a[href="#' + e + '"] .panel-title').find("i").addClass("fa-angle-up").removeClass("fa-angle-down")
    }), $(".accordion-style3 .collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("active-accordion"), $('a[href="#' + e + '"] .panel-title').find("i").removeClass("fa-angle-up").addClass("fa-angle-down")
    }), $(".toggles .collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="ti-minus"></i>')
    }), $(".toggles .collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="ti-plus"></i>')
    }), $(".toggles-style2 .collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>')
    }), $(".toggles-style2 .collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("active-accordion"), $('a[href="#' + e + '"] .panel-title span').html('<i class="fas fa-angle-down"></i>')
    }), $(document).on("mouseenter", ".blog-post-style4 .grid-item", function(e) {
        $(this).find("figcaption .blog-hover-text").slideDown(300)
    }), $(document).on("mouseleave", ".blog-post-style4 .grid-item", function(e) {
        $(this).find("figcaption .blog-hover-text").slideUp(300)
    }), SetResizeContent(), $("img:not([data-rjs])").attr("data-no-retina", ""), $(document).on("touchstart", ".sidebar-wrapper", function() {
        $("li.dropdown").removeClass("on").removeClass("open"), $(".dropdown-menu").stop().fadeOut("fast"), $(".dropdown-menu").removeClass(q), $(".dropdown-menu").addClass(V)
    });
    var M = $("nav.navbar.bootsnav"),
        q = M.find("ul.nav").data("in"),
        V = M.find("ul.nav").data("out")
}), $(window).load(function() {
    var e = window.location.hash.substr(1);
    "" != e && setTimeout(function() {
        $(window).imagesLoaded(function() {
            var t = "#" + e;
            $(t).length > 0 && $("html, body").stop().animate({
                scrollTop: $(t).offset().top
            }, 1200, "easeInOutExpo", function() {
                window.location.hash = t
            })
        })
    }, 500), fullScreenHeight()
});