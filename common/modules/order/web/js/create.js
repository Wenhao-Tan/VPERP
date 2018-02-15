'use strict';

function updateAddresses(addresses) {
    var selectAddresses = document.getElementsByClassName('address');

    for (var i in selectAddresses) {
        if (selectAddresses.hasOwnProperty(i)) {
            selectAddresses[i].options.length = 1;

            for (var j in addresses) {
                if (addresses.hasOwnProperty(j)) {
                    var text = addresses[j].name;
                    var value = addresses[j].id;

                    selectAddresses[i].options[selectAddresses[i].options.length] = new Option(text, value);
                }
            }
        }
    }
}

function getAddresses(customerID) {
    var selectBillingAddress = document.getElementById('order-billing_address');

    var request = new XMLHttpRequest();
    var url = selectBillingAddress.dataset.url;
    var params = 'customerID=' + customerID + '&_csrf-frontend=' + yii.getCsrfToken();

    request.open('POST', url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(params);
    request.addEventListener('load', function () {
        if (request.readyState === 4 && request.status === 200) {
            updateAddresses(JSON.parse(request.responseText));
        }
    })
}

window.addEventListener('load', function () {
    /**
     * Get Customer Address
     */
    var customerID = document.getElementById('order-customer_id');
    customerID.addEventListener('change', function () {
        getAddresses(customerID.value);
    });

    var paymentMethod = document.getElementById('order-payment_method');
    var referenceID = document.getElementsByClassName('field-order-reference_id');
    if (paymentMethod && referenceID) {
        paymentMethod.addEventListener('change', function () {
            if (paymentMethod.value === 'Alibaba' || paymentMethod.value === 'Official Website') {
                referenceID[0].style.display = 'block';
            } else {
                referenceID[0].style.display = 'none';
            }
        })
    }
});