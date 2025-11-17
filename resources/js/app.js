import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import AOS from 'aos';
import 'aos/dist/aos.css';
import './index.js'
// import 'animate.css';
// import 'jquery.easing';
// import 'summernote/dist/summernote-bs4.js';
// import { Glightbox } from './glightbox';
// import { initIsotope } from './isotope';
// import { DataTable } from 'simple-datatables';
// import 'simple-datatables/dist/style.css'
// import tinymce from 'tinymce/tinymce';
// import 'tinymce/themes/silver';
// import 'tinymce/icons/default';
// import 'tinymce/plugins/link';
// import 'tinymce/plugins/image';
// import 'tinymce/plugins/code';
// import 'tinymce/plugins/table';

AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
});

// (async () => {
//     const Waypoint = (await import('waypoints/lib/noframework.waypoints')).default;
//
//     let skillsContent = document.querySelector('.skills-content');
//     if (skillsContent) {
//         const progressBars = document.querySelectorAll('.progress .progress-bar');
//
//         new Waypoint({
//             element: skillsContent,
//             offset: '80%',
//             handler: function () {
//                 progressBars.forEach((el) => {
//                     el.style.width = el.getAttribute('aria-valuenow') + '%';
//                 });
//                 this.destroy();
//             }
//         });
//     }
// })();

window.bootstrap = bootstrap;

// document.addEventListener('DOMContentLoaded', () => {
//     Glightbox();
//     initIsotope();
//
//     const table = document.querySelector('#myTable');
//     if (table) {
//         new DataTable(table)
//     }
//
//     tinymce.init({
//         selector: '#editor',
//         plugins: 'link image code table',
//         toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | code | link image table',
//         height: 400,
//         branding: false,
//     })
// });
