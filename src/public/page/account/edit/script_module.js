import { Fetcher } from "../../../static/js/Fetcher/Fetcher.js";
import { formDataGrabber } from "../../../static/js/FormDataGrabber.js";
$("form").on("submit", function (e) {
    e.preventDefault();
    let form_data = formDataGrabber();
    // @ts-ignore
    delete form_data.header_search;
    //если есть список адресов, то добавляем его в запрос
    if ($("#main_address").length) {
        // @ts-ignore
        form_data.main_address_id = $("#main_address option:selected").val();
    }
    Fetcher.init()
        .setMethod("POST")
        .setUrl("/api/v1/account/")
        .setBody(form_data)
        .fetch()
        .then(function (response) {
        console.log(response.data);
    })
        .then(function () {
        $("#save_data_button").text("Сохранено");
    });
    console.log(form_data);
});
//# sourceMappingURL=script_module.js.map