import { select } from '../helpers/dom-utils';

export const initCarousel = () => {
    let heroCarouselIndicators = select('#hero-carousel-indicators');
    let heroCarouselItems = select('#heroCarousel .carousel-item', true);

    heroCarouselItems.forEach((item, index) => {
        heroCarouselIndicators.innerHTML += `
            <li data-bs-target='#heroCarousel' data-bs-slide-to='${index}'
            class='${index === 0 ? 'active' : ''}'></li>`;
    });
};
