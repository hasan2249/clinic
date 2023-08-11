function chooseUser(e, id, name, phone) {
    let client_name_input = document.getElementById("cleint_id_input");

    let client_id = document.getElementById("cleint_name");
    client_id.value = name;

    let client_phone = document.getElementById("phone-input");
    if (client_phone !== null) {
        phone != "null"
            ? (client_phone.value = phone)
            : (client_phone.value = "");
    }

    let all_buttons = document.getElementsByName("btn-choose");
    for (var i = 0; i < all_buttons.length; i++) {
        all_buttons[i].style.backgroundColor = "#4dbd74";
        all_buttons[i].innerHTML = "اختيار";
    }

    if (client_name_input.value == id) {
        e.style.backgroundColor = "#4dbd74";
        e.innerHTML = "اختيار";
        client_name_input.value = "";

        if (client_phone !== null) {
            client_phone.name = "client-phone";
        }
    } else {
        e.style.backgroundColor = "rgb(223 53 53)";
        e.innerHTML = "تم الاختيار";
        client_name_input.value = id;

        if (client_phone !== null) {
            client_phone.name = "phone";
        }
    }
    client_name_input.dispatchEvent(new Event("Keypress")); // to trigger event when change value programatically
}

function reciveTransfer(
    e,
    id,
    value,
    amount,
    company,
    note,
    mother_name,
    birthday
) {
    $("#transfer-id-input").val(id);
    $("#form-action").attr(
        "action",
        window.location.origin + "/admin/transfers/recive/" + id
    );
    $("#transfr-name").text(value);
    $("#transfr-amount").text(amount);
    $("#transfr-company").text(company);
    $("#transfr-note").text(note);
    $("#mother_name").val(mother_name);
    $("#birthday").val(birthday);
    e.preventDefault();
}

$("#spinner").hide();

function getMoney() {
    $("#spinner").show();
    let from_date = $("#from_date").val();
    let to_date = $("#to_date").val();
    var myObj = { from: from_date, to: to_date };
    postData("getdataDateRange", myObj)
        .then((response) => response.json())
        .then((data) => {
            $("#income").text(data.income);
            $("#cost").text(data.costs);
            console.log(data);
            $("#spinner").hide();
        });
}

// --------------------------------------------------------
async function postData(url = "", data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });
    return response;
}
// --------------------------------------------------------

// --------------------------------------------------------
async function getData(url = "") {
    // Default options are marked with *
    const response = await fetch(url, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer <token>",
        },
    });
    return response;
}
// --------------------------------------------------------

(function () {
    // --------------------------------------------------------
    async function postFile(url = "", data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: "POST", // *GET, POST, PUT, DELETE, etc.

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "multipart/form-data",
            },
            body: data, // body data type must match "Content-Type" header
        });
        return response;
    }
    // --------------------------------------------------------

    // --------------------------------------------------------
    $("#cleint_name").keypress(function () {
        $("#user-search-loader").removeClass("hidden");
        $("#user_search_box").hide();
        $("#cleint_id_input").val("");
        $("#cleint_id_input").trigger("Keypress"); // to trigger event when change value programatically

        let client_name = $("#cleint_name").val();
        console.log(client_name);
        $("#cost-text").addClass("loader");
        getData(
            window.location.origin + "/api/v1/search/clients/" + client_name
        )
            .then((response) => response.json())
            .then((data) => {
                console.log(data["data"]);
                let str = "<div>";
                $.each(data["data"], function (index, value) {
                    str +=
                        "\
			  <div class='row client_box'>\
			  <div class='col-11 row'>\
			  <div class='col-7'>\
				<label>الاسم: " +
                        value["name"] +
                        "</label>\
			</div>\
			<div class='col-5'>\
				<label>موبايل: " +
                        value["phone"] +
                        "</label>\
			</div>\
			<div class='col-7'>\
				<label>اسم الام : " +
                        value["mother_name"] +
                        "</label>\
			</div>\
			<div class='col-5'>\
				<label>تاريخ الميلاد : " +
                        value["birthday"] +
                        "</label>\
			</div>\
			</div>\
			<div class='col-1'>\
			<button id='choose_user" +
                        value["id"] +
                        "' name='btn-choose' onclick='chooseUser(this," +
                        value["id"] +
                        ',"' +
                        value["name"] +
                        '","' +
                        value["phone"] +
                        "\")' type='button' class='btn btn-success'>اختيار</button>\
			</div>\
			</div>";
                });
                str += "</div>";
                $("#user_search_box").html(str);
                $("#user-search-loader").addClass("hidden");
                $("#user_search_box").show();
            });
    }); // end Keypress
    // --------------------------------------------------------

    $("#cleint_id_input").on("Keypress", function () {
        if (!$("#cleint_id_input").val()) {
            $("#btn-search-transfer").addClass("hidden");
        } else {
            $("#btn-search-transfer").removeClass("hidden");
        }
    });
    // --------------------------------------------------------

    $("#btn-search-transfer").on("click", function () {
        $("#transfers-search-loader").removeClass("hidden");
        let id = $("#cleint_id_input").val();
        $("#transfers_search_box").html("");
        getData(
            window.location.origin + "/api/v1/search/transfers/clients/" + id
        )
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data["data"].length > 0) {
                    let str = "";

                    $.each(data["data"], function (index, value) {
                        str +=
                            "\
				<div class='row client_box'>\
			  <div class='col-11 row'>\
			  <div class='col-7'>\
				<label><b>معرف الحوالة:</b> " +
                            value["id"] +
                            " </label>\
			</div>\
			<div class='col-12'>\
				<label><b>تاريخ الحوالة:</b> " +
                            value["created_at"] +
                            " </label>\
			</div>\
			<div class='col-12'>\
				<label><b>اسم الزبون :</b> " +
                            value["client"] +
                            "  </label>\
			</div>\
			<div class='col-7'>\
				<label><b>قيمة الحوالة:</b> " +
                            value["amount"] +
                            " </label>\
			</div>\
			<div class='col-5'>\
				<label><b>الشركة:</b> " +
                            value["company"] +
                            " </label>\
			</div>\
			<div class='col-12'>\
				<label><b>ملاحظة:</b> " +
                            value["note"] +
                            " </label>\
			</div>\
			</div>\
			<div class='col-1'>\
			<form action='/transfers/" +
                            value["id"] +
                            "' method='PUT'>\
			<input name='status' type='text' value='T' hidden></input>\
			<button id='choose_user' name='btn-choose' data-toggle='modal' data-target='#confirm-popup' onclick='reciveTransfer(this,\"" +
                            value["id"] +
                            '","' +
                            value["client"] +
                            '","' +
                            value["amount"] +
                            '","' +
                            value["company"] +
                            '","' +
                            value["note"] +
                            '","' +
                            value["mother_name"] +
                            '","' +
                            value["birthday"] +
                            "\")' type='button' class='btn btn-success'>تسليم الحوالة</button>\
			</form>\
			</div>\
			</div>";
                    });

                    $("#transfers_search_box").html(str);
                }
                $("#transfers-search-loader").addClass("hidden");
            });
    });
    //--------------------------------------------------
    var myInput = document.getElementById("search");

    myInput.addEventListener("keypress", function () {
        if ($(this).val().length > 1) {
            $("#loading").removeClass("hidden");
            $.ajax({
                url: "/admin/patient/search/" + $(this).val(),
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Content-Type": "application/json",
                },
                success: function (data) {
                    console.log(data["data"]);
                    let str = "";
                    $.each(data["data"], function (index, value) {
                        str +=
                            '<div \
                            class="patient_name"\
                            name="patient_name"\
                            data-id="' +
                            value["id"] +
                            '"\
                            data-name="' +
                            value["name"] +
                            '"\
                            id="' +
                            value["id"] +
                            '"\
                            data-event=\'{ "id":"' +
                            value["id"] +
                            '", "title": "' +
                            value["name"] +
                            '", "duration": "00:15" }\'>' +
                            value["name"] +
                            "</div>";
                    });
                    $("#patient").html(str);

                    $("[name='patient_name']").on("click", function (e) {
                        $("#draggable-el").attr(
                            "data-event",
                            $(this).attr("data-event")
                        );
                        $("#draggable-el").text($(this).attr("data-name"));
                        $("#draggable-el").attr(
                            "data-id",
                            $(this).attr("data-id")
                        );
                        $("#draggable-el").attr(
                            "data-name",
                            $(this).attr("data-name")
                        );
                        console.log($(this).attr("data-name"));
                    });

                    $("#loading").addClass("hidden");
                },
            });
        }
    });
})(jQuery);

$("document").ready(function () {
    $(".buttons-collection ").text("اظهار - اخفاء ");
    $(".buttons-page-length ").text("عدد الاسطر");

    // ------
    // حذف بيانات السطور المختارة من الجدول
    $("#transfers-table").on("select.dt deselect.dt", function () {
        $("#span-trans-number").text("");
        $("#span-trans-amount").text("");
    });
    //-----
});
