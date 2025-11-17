import { select, onscroll } from '../helpers/dom-utils.js';

export const backToTop = () => {
    let backToTop = select('.back-to-top');
    if (backToTop) {
        const toggleBacktotop = () => {
            window.scrollY > 100 ? backToTop.classList.add('active') : backToTop.classList.remove('active');
        };

        window.addEventListener('load', toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }
};
