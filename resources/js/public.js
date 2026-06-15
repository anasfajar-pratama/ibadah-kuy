import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

window.Alpine = Alpine;
Alpine.start();

// Hero Slider
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.hero-swiper')) {
        new Swiper('.hero-swiper', {
            modules: [Navigation, Pagination, Autoplay, EffectFade],
            effect: 'fade',
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    }

    if (document.querySelector('.testimoni-swiper')) {
        new Swiper('.testimoni-swiper', {
            modules: [Navigation, Pagination, Autoplay],
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: { delay: 4000 },
            pagination: { el: '.testimoni-pagination', clickable: true },
            breakpoints: {
                640:  { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }

    if (document.querySelector('.galeri-swiper')) {
        new Swiper('.galeri-swiper', {
            modules: [Navigation, Pagination],
            slidesPerView: 2,
            spaceBetween: 12,
            breakpoints: {
                640:  { slidesPerView: 3 },
                1024: { slidesPerView: 4 },
            },
        });
    }
});
