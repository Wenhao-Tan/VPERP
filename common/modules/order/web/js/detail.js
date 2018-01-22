window.onload = function () {
    var btnCreatePayment = document.getElementById('btn-create-payment');
    if (btnCreatePayment) {
        btnCreatePayment.addEventListener('click', function () {
            var paymentForm = document.getElementById('payment-form');
            var display = paymentForm.style.display;

            display = (display === 'block') ? 'none' : 'block';

            paymentForm.style.display = display;
        });
    }

    var btnCreateShipping = document.getElementById('btn-create-shipping');
    if (btnCreateShipping) {
        btnCreateShipping.addEventListener('click', function () {
            var shippingForm = document.getElementById('shipping-form');
            var display = shippingForm.style.display;

            display = (display === 'block') ? 'none' : 'block';

            shippingForm.style.display = display;
        });
    }

};