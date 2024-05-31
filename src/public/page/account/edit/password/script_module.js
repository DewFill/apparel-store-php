// @ts-ignore
import { formDataGrabber } from "/static/js/FormDataGrabber.js";
// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
$("#change_password_form").on("submit", function (e) {
    e.preventDefault();
    let form = formDataGrabber();
    delete form.header_search;
    console.log(form);
    if (form["new_password"] !== form["new_password_repeat"]) {
        $("#error_text").text("Пароли не совпадают");
        return;
    }
    delete form.new_password_repeat;
    Fetcher.init()
        .setUrl("/api/v1/password/")
        .setMethod("POST")
        .setBody(form)
        .fetch()
        .then(function (r) {
        if (r.isSuccess) {
            document.location = "/account/edit/";
        }
        else {
            $("#error_text").text(r.raw_data["error_message"]);
        }
    });
});
//# sourceMappingURL=script_module.js.map