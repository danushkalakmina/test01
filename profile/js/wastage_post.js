
$('#radeio-image-file').on('click', function () {
    $('#imageByFileView').show()
    $('#imageByURLView').hide()
    $("#imageFile").prop('required', true);
    $("#imageUrl").prop('required', false);
});

$('#radeio-image-url').on('click', function () {
    $('#imageByFileView').hide()
    $('#imageByURLView').show()
    $("#imageFile").prop('required', false);
    $("#imageUrl").prop('required', true);
});


$('#item-deliver-yes').on('click', function () {
    $('#item-deliver').show()
    $("#delivery_cost").prop('required', true);
});

$('#item-deliver-no').on('click', function () {
    $('#item-deliver').hide()
    $("#delivery_cost").prop('required', false);
});

$('#item-partially-yes').on('click', function () {
    $('#item-partially').show();
    $("#min_partial_qty").prop('required', true);
    $("#partial_unit_price").prop('required', true);
});

$('#item-partially-no').on('click', function () {
    $('#item-partially').hide();
    $("#min_partial_qty").prop('required', false);
    $("#partial_unit_price").prop('required', false);
});

function loadImageByURL() {
    $("#imageView").attr("src", $("#imageUrl").val());
    $('#imgViewArea').show();
}
function loadImageByFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);

        $('#imgViewArea').show();
    }
}

$("#imageFile").change(function () {
    loadImageByFile(this);
});


function validatePreferredBuyers(check, id) {
    $("#buyers_time_" + id).prop('required', check.checked);
    $("#buyers_discount_" + id).prop('required', check.checked);
}