// public/js/struktur.js

document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll('.card-struktur');

    cards.forEach((card) => {

        card.addEventListener('mouseenter', () => {
            card.classList.add('active-card');
        });

        card.addEventListener('mouseleave', () => {
            card.classList.remove('active-card');
        });

    });

});