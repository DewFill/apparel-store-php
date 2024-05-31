//======================================================================================================================
// @ts-ignore
import Category from "/admin/categories/Category.js";
//CREATING SLIDE
$("#form_create").on("submit", async function (event) {
    event.preventDefault();
    // let slide = new Slides();
    // // @ts-ignore
    // slide.setImage($("#form_create input[name='slide_image']")[0].files[0]);
    // slide.setUrl($("#form_create input[name='slide_url']").val().toString());
    // slide.setIsActive($("#form_create input[name='slide_active']").val().toString());
    let category = new Category();
    category.name = $("#form_create input[name='category_name']").val().toString();
    Category.addCategory(category)
        .then(function (add) {
        console.log(add);
        if (add.isSuccess) {
            add = add.data;
            $(`#form_delete select`).append(`<option value="${add["category_id"]}">ID: ${add["category_id"]} | name: ${add["category_name"]}</option>`);
            $(`#form_update select`).append(`<option value="${add["category_id"]}">ID: ${add["category_id"]} | name: ${add["category_name"]}</option>`);
            $("#form_create input[name='category_name']").val("");
            $(".category_link").attr("href", `/category?category_id=${add["category_id"]}/`);
            $(".category_link").text(`artemy.net/category?category_id=${add["category_id"]}/`);
        }
    });
});
//======================================================================================================================
//FORM DELETE
$("#form_delete").on("submit", function (event) {
    event.preventDefault();
    let category = new Category();
    category.id = ($("#form_delete select").val());
    if (![1, 2, 3, 4].includes(category.id)) {
        try {
            Category.deleteCategory(category);
            $(`#form_delete option[value='${category.getId()}']`).replaceWith("");
            $(`#form_update option[value='${category.getId()}']`).replaceWith("");
        }
        catch (e) {
            console.log(e);
        }
    }
});
//======================================================================================================================
//FORM UPDATE
$("#form_update").on("submit", function (event) {
    event.preventDefault();
    let category = new Category();
    category.id = $("#form_update select").val();
    category.name = $("#form_update input[name='category_name']").val().toString();
    try {
        Category.updateCategory(category);
        $(`#form_delete option[value='${category.getId()}'`).replaceWith(`<option value="${category.getId()}">ID: ${category.getId()} | name: ${category.getName()}</option>`);
        $(`#form_update option[value='${category.getId()}'`).replaceWith(`<option value="${category.getId()}">ID: ${category.getId()} | name: ${category.getName()}</option>`);
    }
    catch (e) {
        console.log(e);
    }
});
//# sourceMappingURL=script_module.js.map