import { select } from '../helpers/dom-utils';

export const removePreloader = () => {
    const preloader = select('#preloader');
    window.addEventListener('load', () => preloader?.remove());
};
