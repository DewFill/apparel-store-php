// @ts-ignore
import {Fetcher} from "/static/js/Fetcher/Fetcher.js";

$("form").on("submit", function (e) {
    e.preventDefault();
    placeOrder($("input[name=delivery_type]:checked").val(), $("#main_address option:selected").val());
})

function placeOrder(delivery_type, address_id) {
    Fetcher.init()
        .setMethod("POST")
        .setUrl("/api/v1/order/")
        .setBody({
            delivery_type: delivery_type,
            address_id: address_id
        })
        .fetch()
        .then(function (response) {
            if (response.isSuccess) {
                let order_id = response.data.order_id;
                goToCheckout(order_id);
            }
        })
}

function goToCheckout(order_id) {
    window.location.href = "/cart/checkout/?order_id=" + order_id;
}