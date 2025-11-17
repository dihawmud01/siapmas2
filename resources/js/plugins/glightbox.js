import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.css';

document.addEventListener('DOMContentLoaded', function () {
    const lightbox = GLightbox({
        selector: '.quote-lightbox',
        openEffect: 'fade',
        closeEffect: 'fade',
        loop: true,
        preload: true,
        zoomable: true,
    });
});
