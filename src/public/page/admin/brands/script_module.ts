//======================================================================================================================
//FORM CREATE
// @ts-ignore
import {Fetcher} from "/static/js/Fetcher/Fetcher.js";
// @ts-ignore
import Brand from "/admin/brands/Brand.js";

//CREATING SLIDE
$("#form_create").on("submit", async function (event) {
    event.preventDefault();

    // let slide = new Slides();
    // // @ts-ignore
    // slide.setImage($("#form_create input[name='slide_image']")[0].files[0]);
    // slide.setUrl($("#form_create input[name='slide_url']").val().toString());
    // slide.setIsActive($("#form_create input[name='slide_active']").val().toString());
let brand = new Brand();
brand.name = $("#form_create input[name='brand_name']").val().toString();

    Brand.addBrand(brand)
        .then(function (add) {
            console.log(add)
        if (add.isSuccess) {
            add = add.data
            $(`#form_delete select`).append(`<option value="${add["brand_id"]}">ID: ${add["brand_id"]} | name: ${add["brand_name"]}</option>`);
            $(`#form_update select`).append(`<option value="${add["brand_id"]}">ID: ${add["brand_id"]} | name: ${add["brand_name"]}</option>`);
            $("#form_create input[name='brand_name']").val("");
            $(".brand_link").attr("href", `/brand?brand_id=${add["brand_id"]}/`);
            $(".brand_link").text(`artemy.net/brand?brand_id=${add["brand_id"]}/`);
        }
    })
})


//======================================================================================================================
//FORM DELETE
$("#form_delete").on("submit", function (event) {
    event.preventDefault();

    let brand = new Brand();
    brand.id = ($("#form_delete select").val());

    try {
        Brand.deleteBrand(brand);
        $(`#form_delete option[value='${brand.getId()}']`).replaceWith("");
        $(`#form_update option[value='${brand.getId()}']`).replaceWith("");
    } catch (e) {
        console.log(e);
    }
})


//======================================================================================================================
//FORM UPDATE
$("#form_update").on("submit", function (event) {
    event.preventDefault();

    let brand = new Brand();
    brand.id = $("#form_update select").val();
    brand.name = $("#form_update input[name='brand_name']").val().toString();

    try {
        Brand.updateBrand(brand);
        $(`#form_delete option[value='${brand.getId()}'`).replaceWith(`<option value="${brand.getId()}">ID: ${brand.getId()} | name: ${brand.getName()}</option>`);
        $(`#form_update option[value='${brand.getId()}'`).replaceWith(`<option value="${brand.getId()}">ID: ${brand.getId()} | name: ${brand.getName()}</option>`);
    } catch (e) {
        console.log(e);
    }
})
