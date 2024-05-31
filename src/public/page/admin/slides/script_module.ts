//======================================================================================================================
//FORM CREATE
// @ts-ignore
import Slides from "/static/js/Slides.js";

//CREATING SLIDE
$("#form_create").on("submit", async function (event) {
    event.preventDefault();

    let slide = new Slides();
    // @ts-ignore
    slide.setImage($("#form_create input[name='slide_image']")[0].files[0]);

    let add = Slides.addSlide(slide).then(function (add) {
        console.log(add);
        $(`#form_delete select`).append(`<option value="${add.getId()}">ID: ${add.getId()} | URL: ${add.getUrl()} | Active: ${add.getIsActive()}</option>`);
        $(`#form_update select`).append(`<option value="${add.getId()}">ID: ${add.getId()} | URL: ${add.getUrl()} | Active: ${add.getIsActive()}</option>`);
    })
})


//======================================================================================================================
//FORM DELETE
$("#form_delete").on("submit", function (event) {
    event.preventDefault();

    let slide = new Slides();
    slide.setId($("#form_delete select").val());

    try {
        Slides.deleteSlide(slide);
        $(`#form_delete option[value='${slide.getId()}']`).replaceWith("");
        $(`#form_update option[value='${slide.getId()}']`).replaceWith("");
    } catch (e) {
        console.log(e);
    }
})


//======================================================================================================================
//FORM UPDATE
$("#form_update").on("submit", function (event) {
    event.preventDefault();

    let slide = new Slides();
    slide.setId($("#form_update select").val())
    // @ts-ignore
    slide.setImage($("#form_update input[name='slide_image']")[0].files[0]);
    slide.setUrl($("#form_update input[name='slide_url']").val());
    slide.setIsActive($("#form_update input[name='slide_active']").prop('checked'))

    try {
        Slides.updateSlide(slide);
        $(`#form_delete option[value='${slide.getId()}'`).replaceWith(`<option value="${slide.getId()}">ID: ${slide.getId()} | URL: ${slide.getUrl()} | Active: ${slide.getIsActive()}</option>`);
        $(`#form_update option[value='${slide.getId()}'`).replaceWith(`<option value="${slide.getId()}">ID: ${slide.getId()} | URL: ${slide.getUrl()} | Active: ${slide.getIsActive()}</option>`);
    } catch (e) {
        console.log(e);
    }
})



//отображение фото
function readURL(input) {
    var fileTypes = ['jpg', 'jpeg', 'png'];

    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.readAsDataURL(input.files[0]);

        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

        if (isSuccess) { //yes
            $("#error").text("")

            reader.onload = function (e) {
                $('#slide_image').attr('src', e.target.result.toString());
                $("#add_slider").css("height", "auto");
                $("#add_slider").css("width", "100%");
                $("#add_slider").css("opacity", "1");

            }
        } else {
            $("#error").text("Неверное расширение файла")
        }

        // @ts-ignore
        slider.moveTo(number_of_slides - 1);
    }
}

$("input[name='slide_image']").on("change", function() {
    readURL(this);
});