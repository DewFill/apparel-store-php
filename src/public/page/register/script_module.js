import { formDataGrabber } from "../../static/js/FormDataGrabber.js";
import { HTTPmethod } from "../../static/js/HTTPMethod.js";
import { send } from "../../static/js/Sender.js";
$("#auth_btn").on("click", function () {
    event.preventDefault();
    $("#error").html(" ");
    const form = formDataGrabber();
    const sender = send(HTTPmethod.POST, "api/v1/register", form);
    if (sender.isSuccess) {
        window.location.href = "/";
    }
    else {
        $("#error").html(sender.error);
    }
});
//# sourceMappingURL=script_module.js.map