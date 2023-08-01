// quick-view.js
document.addEventListener('DOMContentLoaded', function () {
    const quickViewButtons = document.querySelectorAll('.addonify-qvm-button');

    quickViewButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const productId = button.dataset.product_id;
            
        });
    });
});
