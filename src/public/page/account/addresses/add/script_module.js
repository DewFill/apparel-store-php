// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
// @ts-ignore
import { formDataGrabber } from "/static/js/FormDataGrabber.js";
$("form").on("submit", function (e) {
    e.preventDefault();
    let form_data = formDataGrabber();
    Fetcher.init()
        .setMethod("POST")
        .setUrl("/api/v1/address/")
        .setBody(form_data)
        .fetch().then(function (response) {
        if (response.isSuccess) {
            window.location.href = "/account/addresses/";
        }
    });
});
//# sourceMappingURL=script_module.js.map