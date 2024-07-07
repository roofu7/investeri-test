import './bootstrap';
// import.meta.glob([
//     '../images/**',
// ]);
import $ from "jquery";
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
// import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
import 'lightbox2/dist/js/lightbox.js'
import 'lightbox2/dist/css/lightbox.css'
// import '../css/app.scss';
// import {cmp1} from './component1.js';

const initSection = (sectionSelector, func, isSet) => {
    try {
        if (isSet) {
            const sections = document.querySelectorAll(sectionSelector);
            if (sections.length) {
                sections.forEach(section => {
                    func(section);
                });
            }
        } else {
            const section = document.querySelector(sectionSelector);
            if (!section) return;
            func(section);
        }
    } catch (e) {
        console.error(e);
    }

};

function watchPageStartPosition() {
    const target = document.createElement('div');
    target.classList.add('home-mark');
    document.querySelector('body').prepend(target);

    const observeOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 1
    };

    const observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            const eventName = entry.isIntersecting ? 'page-position-home' : 'page-position-scroll';
            document.body.dispatchEvent(new CustomEvent(eventName));
        });

    }, observeOptions);

    observer.observe(target);
}

const customPopup = {
    init({openDuration = 0.3, baseClassName} = {}) {
        const elem = document.createElement('dialog');
        this._baseClassName = baseClassName;
        this._elem = elem;
        const closeElem = document.createElement('button');
        closeElem.className = 'close-btn close-btn_theme_transparent ' + baseClassName + '__close';
        closeElem.innerHTML = '<span class="close-btn__line"></span><span class="close-btn__line"></span>';
        elem.append(closeElem);
        document.body.append(elem);
        elem.addEventListener("close", e => {
            this._onClose(e);
        })

        elem.addEventListener('cancel', e => {
            elem.style.zIndex = 1000000;
        })

        elem.addEventListener('click', e => {
            if (e.target === elem) {
                elem.close();
            }
        })

        closeElem.addEventListener('click', e => {
            elem.close();
        })
        this._openDuration = openDuration;
    },
    open(options = {}) {
        const {content: contentElem, direction = 'left', typeAfterCloseAction, sessionClasses: classList = [], popupClassString = '', popupInnerHtml, onBeforeOpen, onClose} = options;
        if (!contentElem) return;
        this._elem.className = this._baseClassName + ' ' + popupClassString;
        this._elem.classList.add('custom-popup_open-direction_' + direction);
        this._contentElem = contentElem;
        this._elem.prepend(contentElem);
        contentElem.hidden = false;
        document.body.style.overflow = 'hidden';
        this._open();
        requestAnimationFrame(() => {
            this._elem.classList.add('_process');
            requestAnimationFrame(() => {
                this._elem.classList.add('_show-popup');
            })
        });
    },
    _open() {
        this._elem.showModal();
    },
    _onClose() {
        setTimeout(() => {
            this._elem.classList.remove('_process');
            document.body.style.overflow = '';
            document.body.dispatchEvent(new CustomEvent('show-scroll', {
                detail: {}
            }));
            this._elem.className = '';
            this._elem.style.zIndex = '';
            this._contentElem.hidden = true;
            document.body.append(this._contentElem);
        }, this._openDuration * 1000);
        requestAnimationFrame(() => {
            this._elem.classList.remove('_show-popup');
        })
    }
};

document.addEventListener("DOMContentLoaded", () => {
    customPopup.init({
        baseClassName: 'custom-popup'
    });
    watchPageStartPosition();

    const header = document.querySelector('.page-header');

    document.body.addEventListener('page-position-home', e => {
        header.classList.remove('_fix');
    })

    document.body.addEventListener('page-position-scroll', e => {
        header.classList.add('_fix');
    })

    const openNavControl = document.querySelector('.show-main-nav');
    if (openNavControl) {
        openNavControl.addEventListener('click', e => {
            customPopup.open({
                content: document.getElementById('nav-panel'),
                popupClassString: 'nav-popup-theme'
            });
        })
    }

    const projectsFilterCategorySelect = document.querySelector('.projects-filter-category-select');
    if (projectsFilterCategorySelect) {
        $(projectsFilterCategorySelect).select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
            // placeholder: 'Выберите категорию',
            closeOnSelect: true,
        });

        $(projectsFilterCategorySelect).next('.select2').find('.select2-selection__arrow').addClass('dropdown-arrow-block').html(`<svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M23.9819 7.84917C24.5412 8.37029 24.5412 9.21046 23.9819 9.73158L14.4967 18.5694C14.0515 18.9841 13.3324 18.9841 12.8872 18.5694L3.402 9.73158C2.8427 9.21046 2.8427 8.37029 3.402 7.84917C3.9613 7.32805 4.86302 7.32805 5.42232 7.84917L13.6977 15.549L21.973 7.83854C22.5209 7.32805 23.434 7.32805 23.9819 7.84917Z" fill="white"/>
</svg>`);
    }

    document.querySelectorAll('.intro-banner-slider').forEach(sliderElem => {
        const swiper = new Swiper(sliderElem, {
            // Optional parameters
            loop: true,
            autoplay: {
                delay: 4000,
            },
            // Navigation arrows
            navigation: {
                nextEl: '.intro-banner-slider .swiper-button-next',
                prevEl: '.intro-banner-slider .swiper-button-prev',
            },
            on: {
                slideChangeTransitionEnd: function () {

                    sliderElem.querySelectorAll('.swiper-slide').forEach(slide => {
                        if(slide.classList.contains('swiper-slide-active')) {
                            slide.classList.add('_content-animate');
                        } else {
                            slide.classList.remove('_content-animate');
                        }
                    })
                }
            }
        });
    })

    initSection('.reviews-section', function (section) {
        const sliderElem = section.querySelector('.reviews-slider');
        if (sliderElem) {
            const swiper = new Swiper(sliderElem, {
                modules: [Navigation, Pagination, Autoplay],
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 4000,
                },
                // Navigation arrows
                navigation: {
                    nextEl: section.querySelector('.reviews-section__slider-nav_next'),
                    prevEl: section.querySelector('.reviews-section__slider-nav_prev'),
                },
            });
        }
    })

    initSection('.faq-section', function (section) {
        document.querySelectorAll('.c-details').forEach(elem => {
            elem.querySelector('.c-details__control').onclick = e => {
                document.querySelectorAll('.c-details').forEach(innerElem => {
                    const controlElem = innerElem.querySelector('.c-details__control');
                    const contentElem = innerElem.querySelector('.c-details__content');
                    if (innerElem.classList.contains('active')) {
                        $(innerElem).find('.c-details__content').slideUp();
                        innerElem.classList.remove('active');
                        controlElem.classList.remove('active');
                        contentElem.classList.remove('_open');
                    } else if (innerElem === elem) {
                        $(innerElem).find('.c-details__content').slideDown();
                        innerElem.classList.add('active');
                        controlElem.classList.add('active');
                        contentElem.classList.add('_open');
                    }
                })
            }
        })
    })

    initSection('.base-promises-section', function (section) {
        const callback = (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    section.classList.add('_show-items');
                    entry.target.src = entry.target.dataset.src
                    observer.unobserve(entry.target)
                }
            })
        }

        const options = {
            rootMargin: '0px 0px 75px 0px',
            threshold: 0,
        }

        const observer = new IntersectionObserver(callback, options)

        observer.observe(section)

    })

});

