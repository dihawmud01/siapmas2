document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.dropdown-btn').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            let dropdownMenu = button.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });

    document.addEventListener('click', (event) => {
        document.querySelectorAll('.dropdown-menu').forEach((menu) => {
            if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                menu.classList.remove('show');
            }
        });
    });

    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    window.addEventListener('scroll', () => {
        const buttonRect = dropdownButton.getBoundingClientRect();
        if (buttonRect.bottom + dropdownMenu.offsetHeight > window.innerHeight) {
            dropdownMenu.classList.add('dropup');
        } else {
            dropdownMenu.classList.remove('dropup');
        }
    });
});

function updateRowNumbers() {
    let rows = document.querySelectorAll('#table tbody tr');
    let counter = 1;

    rows.forEach(row => {
        if (row.style.display !== 'none') {
            row.cells[0].textContent = counter++;
        }
    });
}

updateRowNumbers();
