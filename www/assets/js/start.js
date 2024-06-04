function ready() {
    const theme = localStorage.getItem('theme') || 'dark';
    document.querySelector('html')?.setAttribute('data-theme', theme);

    document.querySelectorAll('#themeSwitcher>li>input').forEach(function (input) {
        input.addEventListener('click', function () {
            localStorage.setItem('theme', input.value);
        });
    });
}

document.addEventListener("DOMContentLoaded", ready);
