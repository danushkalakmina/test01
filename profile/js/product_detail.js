$('.buy-thur-call-header').on('click', function () {
    if ($(".buy-thur-call-body").is(":visible")) {
        $('.buy-thur-call-body').hide(500)
    } else {
        $('.buy-thur-call-body').show(500)
    }
});
$('.bidding-area-header').on('click', function () {
    if ($(".bidding-area-body").is(":visible")) {
        $('.bidding-area-body').hide(500)
    } else {
        $('.bidding-area-body').show(500)
    }
});
$('.buy-partially-header').on('click', function () {
    if ($(".buy-partially-body").is(":visible")) {
        $('.buy-partially-body').hide(500)
    } else {
        $('.buy-partially-body').show(500)
    }
});
$('.buy-online-header').on('click', function () {
    if ($(".buy-online-body").is(":visible")) {
        $('.buy-online-body').hide(500)
    } else {
        $('.buy-online-body').show(500)
    }
});
$('#buy-partially-qty-value').keyup(function (e) {
    let minQTY = $("#buy-partially-min-qty").val()
    let qtyValue = $("#buy-partially-qty-value").val()
    let uPrice = $("#buy-partially-unit-price").val()
    let deliveryPrice = $("#buy-partially-delivery_price").val()
    if (Number(qtyValue) >= Number(minQTY)) {
        $("#buy-partially-qty-text").html(qtyValue);
        $("#buy-partially-status").html("");
        $("#buy-partially-btn-pay-now").attr("disabled", false);
        let subTotalPrice = new Intl.NumberFormat().format(Number(uPrice)*Number(qtyValue));
        $("#buy-partially-sub-total").val(Number(uPrice)*Number(qtyValue));
        $("#buy-partially-sub-total-text").html(subTotalPrice);
        let totalPrice = new Intl.NumberFormat().format(((Number(uPrice)*Number(qtyValue))+Number(deliveryPrice)));
        $("#buy-partially-total").html(totalPrice);
    } else {
        $("#buy-partially-status").html("Min.Qty is " + minQTY);
        $("#buy-partially-btn-pay-now").attr("disabled", true);
        $("#buy-partially-sub-total-text").html("0.00");
        $("#buy-partially-total").html("0.00");
        $("#buy-partially-sub-total").val("0.00");
    }
    $("#buy-partially-discount-text").html("0%\n0.00");


    //

});

function checkDiscount(postID, idSubTotal,delivery_price, idDiscount, idDiscountText, idDiscountStatus, idTotalAmount) {
    let subTotal = $("#" + idSubTotal).val();
    let discountCode = $("#" + idDiscount).val();
    let deliveryPrice = $("#" + delivery_price).val();
    $.ajax({
        type: "POST",
        url: 'datacall/datacalljs.datacall.php',
        dataType: 'JSON',
        data: {
            functionname: 'checkDiscount',
            discountCode: discountCode,
            subTotal: subTotal,
            postID: postID,
            deliveryPrice: deliveryPrice
        },
        success: (status) => {
            let discountPercentage = status['discountPercentage'];
            let discountStatus = status['discountStatus'];
            let discountValue = new Intl.NumberFormat().format(status['discountValue']);
            let total = new Intl.NumberFormat().format(status['total']);
            $("#" + idDiscountText).html(discountPercentage + "%\n" + discountValue);
            $("#" + idTotalAmount).html(total);
            if (discountStatus === "1") {
                $("#" + idDiscountStatus).html('<small class="text-success">Discount Applied</small>');
            } else {
                $("#" + idDiscountStatus).html('<small class="text-danger">Discount Not Applied</small>');
            }

        }
    })

}