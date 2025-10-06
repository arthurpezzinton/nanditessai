function checkUrl() {
    actual_url = window.location.href;
    if (actual_url.search('index.php') != -1) {
        url = actual_url.replace('index.php', '');
        location.href = url;
    }
}

function manage_error_response(error) {
    if (!error.responseJSON.action) {
        setWrongResponse(error.responseJSON.message);
        if (error.responseJSON.id) $("#" + error.responseJSON.id).addClass("is-invalid");
    }
}

function removeAllWrongInput() {
    $(".is-invalid").each(function (index) {
        $(this).removeClass("is-invalid")
    });
}

function remove_wrong_validation(id){
    $('#' + id).removeClass('is-invalid')
}

function setWrongInput(id, message = "Este campo deve ser preenchido.") {
    notification("bi bi-x-circle", null, message, "danger");
    $("#" + id).addClass("is-invalid");
}

function setWrongResponse(message = "Erro ao executar.") {
    notification("bi bi-exclamation-circle", null, message, "danger");
}

function check_empty_value(value) {
    if (value == null || value == undefined || value == "" || value == "null") return ""
    return value
}

var tooltipTriggerList;
var tooltipList;
var tooltips = document.querySelectorAll('.tooltip');

function reset_tooltips() {
    tooltips.forEach(tooltip => {
        tooltip.remove();
    });

    tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl).hide();
    });

    tooltips = document.querySelectorAll('.tooltip');
}

var popovers = document.querySelectorAll('.popover');
var popoverTriggerList;
var popoverList;

function reset_popovers() {
    popovers.forEach(popover => {
        popover.remove();
    });

    popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    popovers = document.querySelectorAll('.popover');
}

function counter_characters(id){
    $('#counter_' + id).html(Number($('#' + id).attr('maxlength')) - Number($('#' + id).val().length))
}

function notification(icon = null, title = null, message = null, type = null) {
    $.notify(
        {
            icon: icon,
            title: title,
            message: message,
        },
        {
            showProgressbar: false,
            type: type,
            allow_dismiss: false,
            placement: {
                from: "top",
                align: "right"
            },
            animate: {
                enter: 'animate__animated animate__bounceInDown',
                exit: 'animate__animated animate__bounceOutUp'
            },
        }
    );
}s

$(document).ready(function () {
    checkUrl()
    reset_tooltips()
    reset_popovers()
})