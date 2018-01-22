"use strict";

window.addEventListener('load', function () {
    var page = document.getElementById('customer-index-view');
    if (page) {
        var fullName = document.getElementById('full-name');
        var inputRceiversName = document.getElementById('address-name');
        inputRceiversName.addEventListener('focus', function () {
            if (inputRceiversName.value === '') {
                inputRceiversName.value = fullName.innerText;
            }
        })
    }

    /**
     * Split the full name and Fill the family name automatically
     */
    var inputGivenName = document.getElementById('customer-given_name');
    var inputFamilyName = document.getElementById('customer-family_name');

    inputGivenName.addEventListener('blur', function () {
        var name = inputGivenName.value.split(' ');

        if (name.length > 1) {
            var familyName = name.pop();
            var givenName = name.join(' ');

            if (inputFamilyName.value === '') {
                inputGivenName.value = givenName;
                inputFamilyName.value = familyName;
            }
        }
    });
});