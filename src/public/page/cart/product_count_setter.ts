import {Fetcher} from "../../static/js/Fetcher/Fetcher.js";

$(".items_count").on("change", function () {
    console.log($(this).data("cart-product-id"))
    console.log($(this).val())
    Fetcher.init()
        .setMethod("POST")
        .setUrl("/api/v1/cart_product_quantity/")
        .setBody({
            cart_product_id: $(this).data("cart-product-id"),
            quantity: $(this).val()
        })
        .fetch()
        .then(function (response) {
            console.log(response.raw_data);
            document.location.reload();
        })
})