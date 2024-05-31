// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
$("#delete_form").on("submit", function (e) {
    e.preventDefault();
    Fetcher.init()
        .setUrl("/api/v1/account/")
        .setMethod("DELETE")
        .fetch()
        .then(function (response) {
        if (response.isSuccess) {
            window.location.href = "/register/";
        }
    });
});
//# sourceMappingURL=script_module.js.map