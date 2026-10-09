(function() {
	"use strict";

    try {
        // Header Sticky
        window.addEventListener('scroll', event => {
            const height = 150;
            const { scrollTop } = event.target.scrollingElement;
            document.querySelector('#navbar').classList.toggle('sticky', scrollTop >= height);
        });    
    } catch {}

    window.onload = function(){
        
        // Back to Top
        const getId = document.getElementById("back-to-top");
        if (getId) {
            const topbutton = document.getElementById("back-to-top");
            topbutton.onclick = function (e) {
                window.scrollTo({ top: 0, behavior: "smooth" });
            };
            window.onscroll = function () {
                if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                    topbutton.style.opacity = "1";
                } else {
                    topbutton.style.opacity = "0";
                }
            };
        }

        // Preloader
        const getPreloaderId = document.getElementById('preloader');
        if (getPreloaderId) {
            getPreloaderId.style.display = 'none';
        }

        // Counter Js
        try {
            if ("IntersectionObserver" in window) {
                let counterObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                        let counter = entry.target;
                        let target = parseInt(counter.innerText);
                        let step = target / 200;
                        let current = 0;
                        let timer = setInterval(function () {
                            current += step;
                            counter.innerText = Math.floor(current);
                            if (parseInt(counter.innerText) >= target) {
                            clearInterval(timer);
                            }
                        }, 10);
                        counterObserver.unobserve(counter);
                        }
                    });
                });

                let counters = document.querySelectorAll(".counter");
                    counters.forEach(function (counter) {
                    counterObserver.observe(counter);
                });
            }
        } catch {}

        // Plus Minus JS
        try {
            var resultEl = document.querySelector(".resultSet"),
            plusMinusWidgets = document.querySelectorAll(".add-to-cart-counter");
                for (var i = 0; i < plusMinusWidgets.length; i++) {
                    plusMinusWidgets[i].querySelector(".minusBtn").addEventListener("click", clickHandler);
                    plusMinusWidgets[i].querySelector(".plusBtn").addEventListener("click", clickHandler);
                    plusMinusWidgets[i].querySelector(".count").addEventListener("change", changeHandler);
                }
                function clickHandler(event) {
                    var countEl = event.target.parentNode.querySelector(".count");
                    if (event.target.className.match(/\bminusBtn\b/)) {
                        countEl.value = Number(countEl.value) - 1;
                    } 
                    else if (event.target.className.match(/\bplusBtn\b/)) {
                        countEl.value = Number(countEl.value) + 1;
                    }
                    triggerEvent(countEl, "change");
                };
                function changeHandler(event) {
                resultEl.value = 0;
                for (var i = 0; i < plusMinusWidgets.length; i++) {
                    resultEl.value = Number(resultEl.value) + Number(plusMinusWidgets[i].querySelector('.count').value);
                }
            };
            function triggerEvent(el, type){
                if ('createEvent' in document) {
                    var e = document.createEvent('HTMLEvents');
                    e.initEvent(type, false, true);
                    el.dispatchEvent(e);
                } 
                else {
                    var e = document.createEventObject();
                    e.eventType = type;
                    el.fireEvent('on'+e.eventType, e);
                }
            }
        } catch {}

    };

    // Courses Swiper JS
    var SwiperTraveler = new Swiper(".courses-slide", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".courses-button-next",
            prevEl: ".courses-button-prev",
        },
    });
    var SwiperTraveler = new Swiper(".free-courses-slide", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".courses-button-next",
            prevEl: ".courses-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 4
            },
        }
    });

    // Categories Swiper JS
    var SwiperTraveler = new Swiper(".categories-slide", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".categories-button-next",
            prevEl: ".categories-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 5
            },
            1600: {
                slidesPerView: 6
            },
        }
    });

    // Community Swiper JS
    var SwiperTraveler = new Swiper(".community-slide", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".community-button-next",
            prevEl: ".community-button-prev",
        },
    });
    
    // Events Swiper JS
    var SwiperTraveler = new Swiper(".events-slide", {
        loop: true,
        spaceBetween: 25,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".events-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
        }
    });

    // Main Banner Slider JS
    var swiper = new Swiper(".main-banner-slider", {
        effect: "fade",
        loop: true,
        grabCursor: true,
        spaceBetween: 0,
        speed: 2500,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".banner-slider-pagination",
            type: "fraction",
        },
    });

    // Instructor Swiper JS
    var SwiperTraveler = new Swiper(".instructor-slide", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".instructor-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 4
            },
        }
    });

    // Companies Swiper JS
    var SwiperTraveler = new Swiper(".companies-slide", {
        loop: true,
        spaceBetween: 50,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 3
            },
            576: {
                slidesPerView: 4
            },
            768: {
                slidesPerView: 6
            },
            992: {
                slidesPerView: 7
            },
            1200: {
                slidesPerView: 10
            },
        }
    });

    // scrollCue
    scrollCue.init();


})();