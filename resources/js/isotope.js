import Isotope from 'isotope-layout';

export function initIsotope() {
    const container = document.querySelector('.quote-container');
    if (container) {
        const iso = new Isotope(container, {
            itemSelector: '.quote-item',
            layoutMode: 'fitRows',
        });

        const filters = document.querySelectorAll('#quote-flters li');
        filters.forEach((filter) => {
            filter.addEventListener('click', function (e) {
                e.preventDefault();
                filters.forEach((el) => el.classList.remove('filter-active'));
                this.classList.add('filter-active');
                iso.arrange({ filter: this.getAttribute('data-filter') });
            });
        });
    }
}
