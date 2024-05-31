// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
$(".complete_button").on("click", function () {
    const button = $(this);
    Fetcher.init()
        .setUrl("/api/v1/order/complete/")
        .setMethod("POST")
        .setBody({
        order_id: $(this).data("order-id")
    })
        .fetch()
        .then(function (response) {
        console.log(response);
        if (response.isSuccess) {
            button.text("Завершено");
            button.addClass("completed");
        }
    });
});
$("#orders_selector").on("change", function () {
    console.log($("#orders_selector option:selected").val());
    location.href = "/admin/orders?status=" + $(this).val();
});
//# sourceMappingURL=script_module.js.map