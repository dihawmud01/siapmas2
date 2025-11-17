import { select, on, onscroll } from '../helpers/dom-utils';

export const handleNavbar = () => {
    let selectHeader = select('#header');
    if (selectHeader) {
        const headerScrolled = () => {
            window.scrollY > 100
                ? selectHeader.classList.add('header-scrolled')
                : selectHeader.classList.remove('header-scrolled');
        };
        window.addEventListener('load', headerScrolled);
        onscroll(document, headerScrolled);
    }

    on('click', '.mobile-nav-toggle', function () {
        console.log('Ikon hamburger diklik!'); // Tambahkan baris ini
        select('#navbar').classList.toggle('navbar-mobile');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
    });

    on(
        'click',
        '.navbar .dropdown > a',
        function (e) {
            if (select('#navbar').classList.contains('navbar-mobile')) {
                e.preventDefault();
                this.parentNode.classList.toggle('dropdown-active'); // Tambahkan/hapus class 'dropdown-active' pada li parent
            }
        },
        true,
    );

    on(
        'click',
        '.scrollto',
        function (e) {
            if (select(this.hash)) {
                e.preventDefault();
                let navbar = select('#navbar');
                if (navbar.classList.contains('navbar-mobile')) {
                    navbar.classList.remove('navbar-mobile');
                    const navbarToggle = select('.mobile-nav-toggle');
                    navbarToggle.classList.toggle('bi-list');
                    navbarToggle.classList.toggle('bi-x');
                }
                const header = select('#header');
                const offset = header.offsetHeight;
                const elementPos = select(this.hash).offsetTop;
                window.scrollTo({
                    top: elementPos - offset,
                    behavior: 'smooth',
                });
            }
        },
        true,
    );
};
