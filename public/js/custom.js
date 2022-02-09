/**
 * JS File for all forms
 */
var BASE_URL = $('meta[name="base-url"]').attr("content");
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

// Auto hide success message
var tId3;
clearTimeout(tId3);
tId3 = setTimeout(function () {
	$(".auto-hide3").fadeOut("slow");
}, 3000);

// Auto hide success message
var tId5;
clearTimeout(tId5);
tId5 = setTimeout(function () {
	$(".auto-hide5").fadeOut("slow");
}, 5000);

$("body").on("click", ".no-link", function () {
    return false;
});

// Numeric Key Validation
$('body').on('keypress', '.isNumberKey', function (evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
});

// Date Key Validation
$('body').on('keypress', '.isDateKey', function (evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45) {
        return false;
    }
    return true;
});

// Max Key Validation
$('body').on('keypress', '.isMaxKey', function (evt) {
    var len = $(this).val().length;
    var MAX_LENGTH = $(this).data('max-len');
    if (len >= MAX_LENGTH) {
        return false;
    }
    return true;
});

// Uppercase Validation
$('body').on('keyup', '.toUpperCase', function () {
    this.value = this.value.toUpperCase();
})

$('body').on('click', '.link-button', function () {
    var url = $(this).data('url');
    if (url != '') {
        //alert(url);
        location.href = url;
    }
});

function ajax_stop() {
    return false;
}

function generateUUIDV4() {
    var d = new Date().getTime(); //Timestamp
    var d2 = (performance && performance.now && performance.now() * 1000) || 0; //Time in microseconds since page-load or 0 if unsupported
    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
        /[xy]/g,
        function (c) {
            var r = Math.random() * 16; //random number between 0 and 16
            if (d > 0) {
                //Use timestamp until depleted
                r = (d + r) % 16 | 0;
                d = Math.floor(d / 16);
            } else {
                //Use microseconds since page-load if supported
                r = (d2 + r) % 16 | 0;
                d2 = Math.floor(d2 / 16);
            }
            return (c === "x" ? r : (r & 0x3) | 0x8).toString(16);
        }
    );
}

function generateFacilityAppId(inputId) {
    let generateUuid = generateUUIDV4();
    document.getElementById(inputId).value = generateUuid;
}
