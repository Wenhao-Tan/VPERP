"use strict";

/**
 * Order Grid View
 */
$(document).ready(function () {
    var btnDeleteAll = $('.order #btn-delete-orders');
    btnDeleteAll.on('click', function () {
        var keys = $('.grid-view').yiiGridView('getSelectedRows');

        $.post({
            url: 'delete',
            data: {keysList: keys},
            success: function () {
                $.pjax.reload({container: '.order-pjax-container'});
            }
        })
    });

    var btnUpdate = $('.a-update-order');
    btnUpdate.on('click', function (e) {
        $.colorbox({
            href: this.href + '&rnd=' + new Date().getTime(),
            width: 960
        });

        e.preventDefault();
    });
});

function updateShippingAddressOptions(address) {
    var selectShippingAddress = document.getElementById('order-shipping_address');

    selectShippingAddress.options.length = 1;

    if (address.length === 0) {
        alert('The Shipping Address of the customer does not exist! Please create!');
    } else {
        for (var i in address) {
            if (address.hasOwnProperty(i)) {
                var value = address[i].id;
                var text = address[i].name;
            }
            selectShippingAddress.options[selectShippingAddress.options.length] = new Option(text, value, false, false);
        }
    }
}

function getShippingAddress(customerID) {
    var inputShippingAddress = document.getElementById('order-shipping_address');
    var request = new XMLHttpRequest();
    var url = inputShippingAddress.dataset.url;
    var params = 'customerID=' + customerID + '&_csrf-frontend=' + yii.getCsrfToken();

    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            var address = JSON.parse(request.responseText);
            updateShippingAddressOptions(address);
        }
    };

    request.send(params);
}

window.addEventListener('load', function () {
    /**
     * Invoice Generator
     */

    /*
    var btnDisplayCustomers = document.getElementById('btn-display-customers');

    btnDisplayCustomers.addEventListener('click', function () {
        var customerSelection = document.getElementById('customers-selection');
        var display = customerSelection.style.display;

        display = (display === 'none') ? 'block' : 'none';

        customerSelection.style.display = display;
    });


    var btnLoadCustomer = document.getElementById('btn-load-customer');
    btnLoadCustomer.addEventListener('click', function () {
        var request = new XMLHttpRequest();

        var url = btnLoadCustomer.dataset.url;

        var customersList = document.getElementById('customers-list');
        var customerID = customersList.options[customersList.selectedIndex].value;
        var params = 'id=' + customerID + '&_csrf=' + yii.getCsrfToken();

        console.log(params);

        request.open('POST', url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        request.onreadystatechange = function () {
            if (request.readyState === XMLHttpRequest.DONE) {
                alert(request.responseText);
                if (request.status === 200) {
                    alert(request.responseText);
                } else {
                    alert('Problem ' + request.status);
                }
            }
        };

        request.send(params);
    });
    */


    /**
     * Generate Customer Shipping Address
     */
    var customerID = document.getElementById('order-customer_id');
    customerID.addEventListener('change', function () {
        getShippingAddress(customerID.value);
    })
});
