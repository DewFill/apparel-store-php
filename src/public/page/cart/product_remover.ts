// @ts-ignore
import {Fetcher} from "/static/js/Fetcher/Fetcher.js";

$(".button_remove_product").on("click", function () {
    const button = $(this);
    let product_id = button.data("product-id");
    Fetcher.init()
        .setMethod("DELETE")
        .setUrl(`/api/v1/cart?product_id=${product_id}/`)
        .fetch()
        .then(r => {
            $(this).parent().parent().parent().parent().remove();
        })
        .then(r => {
            const buttons = $(".button_remove_product");
            if (buttons.length === 0) {
                window.location.reload();
            }
        })
});