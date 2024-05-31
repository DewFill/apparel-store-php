import { Fetcher } from "../../static/js/Fetcher/Fetcher.js";
$("#form_sub_to_edited").on("submit", function (e) {
    e.preventDefault();
    Fetcher.init()
        .setUrl("/api/v1/sub_to_edited/")
        .setMethod("POST")
        .setBody({
        email: $("#email_edited").val()
    })
        .fetch().then(function (r) {
        if (r.isSuccess) {
            $("#sub_edited_button").attr("disabled");
            $("#sub_edited_button").css("background-color", "#d4d4d4");
            $("#sub_edited_button").text("Вы подписаны!");
        }
    });
});
//# sourceMappingURL=script_module.js.map