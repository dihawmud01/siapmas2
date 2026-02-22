(function() {
    'use strict';

    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener);
    };

    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function(e) {
            select('body').classList.toggle('toggle-sidebar');
        });
    }

    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function(e) {
            select('.search-bar').classList.toggle('search-bar-show');
        });
    }

    let navbarlinks = select('#navbar .scrollto', true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active');
            } else {
                navbarlink.classList.remove('active');
            }
        });
    };
    window.addEventListener('load', navbarlinksActive);
    onscroll(document, navbarlinksActive);

    let selectHeader = select('#header');
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled');
            } else {
                selectHeader.classList.remove('header-scrolled');
            }
        };
        window.addEventListener('load', headerScrolled);
        onscroll(document, headerScrolled);
    }

    let backtotop = select('.back-to-top');
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active');
            } else {
                backtotop.classList.remove('active');
            }
        };
        window.addEventListener('load', toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    var needsValidation = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(needsValidation)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });

    const datatables = select('.datatable', true);
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    });
})();

// Sort table
function sortTable(colIdx) {
    const table = document.getElementById('table');
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    let isAsc = table.getAttribute('data-sort-dir') !== 'asc';

    const sortedRows = rows.sort((a, b) => {
        const x = a.cells[colIdx].textContent.trim().toLowerCase() || '';
        const y = b.cells[colIdx].textContent.trim().toLowerCase() || '';

        return isAsc ? x.localeCompare(y) : y.localeCompare(x);
    });

    const fragment = document.createDocumentFragment();
    sortedRows.forEach((row) => fragment.appendChild(row));
    tbody.appendChild(fragment);

    table.setAttribute('data-sort-dir', isAsc ? 'asc' : 'desc');
    updateRowNumbers();
}


// Collapse nav
document.addEventListener('DOMContentLoaded', function() {
    // Collapse sidebar nav
    var toggles = document.querySelectorAll('.nav-link[data-toggle="nav-collapse"]');

    toggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();

            var target = document.querySelector(this.getAttribute('data-target'));

            if (target.classList.contains('show')) {
                target.classList.remove('show');
                this.classList.add('collapsed');
                this.setAttribute('aria-expanded', 'false');
            } else {
                target.classList.add('show');
                this.classList.remove('collapsed');
                this.classList.remove('active');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    document.querySelectorAll('.dropdown-toggle').forEach((dropdown) => {
        dropdown.addEventListener('click', function (event) {
            event.preventDefault();
            let dropdownInstance = bootstrap.Dropdown.getOrCreateInstance(dropdown);
            dropdownInstance.toggle();
        });
    });

    const removeBtn = document.getElementById('remove-file-btn');
    const cancelRemoveBtn = document.getElementById('cancel-remove-btn');
    const fileLink = document.getElementById('file-link');
    const flagInput = document.getElementById('delete-file-flag');

    if (removeBtn && cancelRemoveBtn && fileLink && flagInput) {
        removeBtn.addEventListener('click', function () {
            flagInput.value = '1';

            removeBtn.style.display = 'none';
            cancelRemoveBtn.style.display = 'inline-block';

            fileLink.style.display = 'none';
        });

        cancelRemoveBtn.addEventListener('click', function () {
            flagInput.value = '0';

            cancelRemoveBtn.style.display = 'none';
            fileLink.style.display = 'inline-block';
            removeBtn.style.display = 'inline-block';
        });
    }
});