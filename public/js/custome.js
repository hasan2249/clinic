/*jslint browser: true*/
/*global $, jQuery, alert*/
(function ($) {
    "use strict";
    function makeCounter() {
        var count = 0;
        return function () {
            count++;
            return count;
        };
    }

    var counter = makeCounter();

    $("#demo").steps({
        onChange: function (currentIndex, newIndex, stepDirection) {
            alert("sss");
            // step2
            if (currentIndex === 1) {
                if (stepDirection === "forward") {
                    return frmInfo.valid();
                }
                if (stepDirection === "backward") {
                    frmInfoValidator.resetForm();
                }
            }
            // step4
            if (currentIndex === 3) {
                if (stepDirection === "forward") {
                    return frmLogin.valid();
                }
                if (stepDirection === "backward") {
                    frmLoginValidator.resetForm();
                }
            }
            // step5
            if (currentIndex === 4) {
                if (stepDirection === "forward") {
                    return frmMobile.valid();
                }
                if (stepDirection === "backward") {
                    frmMobileValidator.resetForm();
                }
            }
            return true;
        },
        onFinish: function () {
            alert("Wizard Completed");
        },
    });

    $("#add-person").on("click", function (event) {
        event.preventDefault();
        var x = counter();
        // $("#passport_div").clone().insertAfter("#add:last");
        $("#add").append(
            '\
            First name:<br>\
                    <input type="text" name="firstName[]" required>\
                    <br> Last name:<br>\
                    <input type="text" name="lastName[]" required>\
                    <br> Birthday:<br>\
                    <input type="date" name="birthday[]" id="birthday-date" required>\
                    <br> Gender:<br>\
                    <label for="male' +
                x +
                '">Male</label>\
                    <input type="radio" name="gender[' +
                x +
                ']" value="male" id="male' +
                x +
                '" checked>\
                    <label for="female' +
                x +
                '">Female</label>\
                    <input type="radio" name="gender[' +
                x +
                ']" value="female" id="female' +
                x +
                '">\
                    <br> Place of birth:<br>\
                    <div class="form-item">\
                        <input id="country_selector' +
                x +
                '" class="country" name="country[]" type="text">\
                        <label for="country_selector' +
                x +
                '" style="display:none;">Select a country here...</label>\
                    </div>\
                    <br> Passport number:<br>\
                    <input type="text" name="passport_number[]" min="6" pattern="[a-zA-Z0-9]" required>\
                    <br> Issue date:<br>\
                    <input type="date" name="issue_date[]" id="issue-date' +
                x +
                '" >\
                    <br> Expire date:<br>\
                    <input type="date" name="expire_date[]" id="expire-date' +
                x +
                '">\
                    <br> Place of issue:<br>\
                    <div class="form-item">\
                        <input id="country_selector_' +
                x +
                '" class="country" name="place_of_issue[]" type="text">\
                        <label for="country_selector_' +
                x +
                '" style="display:none;">Select a country here...</label>\
                    </div>\
                    <br> Arrival date:<br>\
                    <input type="date" name="arrival_date[]" id="arrival-date' +
                x +
                '">\
                    <br> Profession:<br>\
                    <input type="text" name="profession[]" required>\
                    <br>Organisation:<br>\
                    <input type="text" name="organisation[]" required>\
                    <br>Visa Duration:<br>\
                    <input type="number" name="organisation[]" min="1" max="90" required>\
                    <br>Organisation:<br>\
                    <input type="text" name="organisation[]" required>\
                    <br> Visa Status:<br>\
                    <label for="single' +
                x +
                '">Single</label>\
                    <input type="radio" name="visa_status[' +
                x +
                ']" value="single" id="single' +
                x +
                '" checked>\
                    <label for="multiple' +
                x +
                '">Multiple</label>\
                    <input type="radio" name="visa_status[' +
                x +
                ']" value="multiple" id="multiple' +
                x +
                '">\
                    <br>Upload required files:<br>\
                    <label>passport picture</label>\
                    <input type="file" name="pa_pic[]" required>\
                    <label>personal picture</label>\
                    <input type="file" name="pers_pic[]" required></input>\
                    <hr />\
            '
        );
        $("#country_selector" + x).countrySelect({
            defaultCountry: "sy",
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // responsiveDropdown: true,
            preferredCountries: ["ca", "gb", "us"],
        });

        $("#country_selector_" + x).countrySelect({
            defaultCountry: "sy",
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // responsiveDropdown: true,
            preferredCountries: ["ca", "gb", "us"],
        });

        // no futuer date
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if (month < 10) month = "0" + month.toString();
        if (day < 10) day = "0" + day.toString();

        var maxDate = year + "-" + month + "-" + day;
        $("#issue-date" + x).attr("max", maxDate);
        $("#expire-date" + x).attr("min", maxDate);
        $("#arrival-date" + x).attr("min", maxDate);
        $("#birthday-date" + x).attr("max", maxDate);
    });
})(jQuery, this);
