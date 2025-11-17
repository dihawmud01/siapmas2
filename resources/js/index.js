import { removePreloader } from './components/preloader';
import { navbarScrollHandler } from './helpers/scroll-utils';
import { handleNavbar } from './components/navbar';
import { initCarousel } from './components/carousel';
import { previewFile, removeImage } from './components/file-preview';
import { backToTop } from './components/back-to-top.js';

document.addEventListener('DOMContentLoaded', () => {
    removePreloader();
    initCarousel();
    navbarScrollHandler();
    handleNavbar();
    backToTop();
});

window.previewFile = previewFile;
window.removeImage = removeImage;