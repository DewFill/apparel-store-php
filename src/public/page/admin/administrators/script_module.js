//======================================================================================================================
// @ts-ignore
import Administrator from "/admin/administrators/Administrator.js";
//CREATING SLIDE
$("#form_create").on("submit", async function (event) {
    event.preventDefault();
    let administrator = new Administrator();
    administrator.name = $("#form_create input[name='user_name']").val().toString();
    Administrator.addAdministrator(administrator)
        .then(function (add) {
        console.log(add);
        if (add.isSuccess) {
            add = add.data;
            $(`#form_delete select`).append(`<option value="${add["user_id"]}">ID: ${add["user_id"]} | name: ${add["user_name"]}</option>`);
            $(`#form_update select`).append(`<option value="${add["user_id"]}">ID: ${add["user_id"]} | name: ${add["user_name"]}</option>`);
            $("#form_create input[name='user_name']").val("");
        }
    })
        .then(function (add) {
        location.reload();
    });
});
//======================================================================================================================
//FORM DELETE
$("#form_delete").on("submit", function (event) {
    event.preventDefault();
    let administrator = new Administrator();
    administrator.id = ($("#form_delete select").val());
    try {
        Administrator.deleteAdministrator(administrator);
        $(`#form_delete option[value='${administrator.getId()}']`).replaceWith("");
        $(`#form_update option[value='${administrator.getId()}']`).replaceWith("");
        setTimeout(function () {
            location.reload();
        }, 100);
    }
    catch (e) {
        console.log(e);
    }
});
//# sourceMappingURL=script_module.js.map