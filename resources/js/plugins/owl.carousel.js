import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

$(document).ready(() => {
    if ($('.owl-carousel').length > 0) {
        $('.main-carousel').owlCarousel({
            autoplay: true,
            smartSpeed: 1500,
            items: 1,
            dots: true,
            loop: true,
            center: true,
        });

        $('.tranding-carousel').owlCarousel({
            autoplay: true,
            smartSpeed: 2000,
            items: 1,
            dots: false,
            loop: true,
            nav: true,
            navText: ['<i class="bi bi-chevron-compact-left"></i>', '<i class="bi bi-chevron-compact-right"></i>'],
        });

        $('.carousel-item-1, .carousel-item-2, .carousel-item-3, .carousel-item-4').each(function () {
            let itemsCount = $(this).hasClass('carousel-item-4')
                ? 4
                : $(this).hasClass('carousel-item-3')
                  ? 3
                  : $(this).hasClass('carousel-item-2')
                    ? 2
                    : 1;

            $(this).owlCarousel({
                autoplay: true,
                smartSpeed: 1000,
                margin: 30,
                dots: false,
                loop: true,
                nav: true,
                navText: [
                    '<i class="bi bi-chevron-compact-left" aria-hidden="true"></i>',
                    '<i class="bi bi-chevron-compact-right" aria-hidden="true"></i>',
                ],
                responsive: {
                    0: { items: 1 },
                    576: { items: 1 },
                    768: { items: itemsCount >= 2 ? 2 : 1 },
                    992: { items: itemsCount >= 3 ? 3 : 2 },
                    1200: { items: itemsCount >= 4 ? 4 : 3 },
                },
            });
        });
    }
});
