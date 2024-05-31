// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
$(".delete_product_button").on("click", function () {
    const product_id = $("#delete_product_select option:selected").val();
    Fetcher.init()
        .setMethod("DELETE")
        .setUrl(`/api/v1/product?product_id=${product_id}/`)
        .fetch()
        .then(function (res) {
        if (res.isSuccess) {
            $(`#delete_product_select option[value='${product_id}']`).remove();
        }
        else {
            console.log(res);
        }
    });
});
//# sourceMappingURL=product_deleter.js.map