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
        getAddresses(customerID.value);
    })
});
