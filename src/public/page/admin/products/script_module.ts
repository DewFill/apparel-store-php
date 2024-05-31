//отображение названия
$("input[name='product_name']").on('keyup', function () {
    const product_name = $(this).val().toString().trim();
    if (product_name === "") {
        $(".bl_text .name").text("НАЗВАНИЕ ТОВАРА");
    } else {
        $(".bl_text .name").text(product_name);
    }
})

//отображение бренда
$("select[name='product_brand_id']").on('change', function () {
    const brand_name = $("select[name='product_brand_id'] option:selected").text().toString().trim();
    $(".bl_text .brand").text(brand_name);
})

//отображение цены
$("input[name='product_price']").on('keyup', function () {
    const price = $(this).val().toString().trim();
    $(".price .old_price").text("₽ " + price);

    if ($("input[name='product_discount_price']").val().toString().trim() === "") {
        $(".price .old_price")
            .css("color", "black")
            .css("opaicty", "1")
            .css("font-size", "1rem");
    }
})

//отображение цены со скидкой
$("input[name='product_discount_price']").on('keyup', function () {
    const price = $(this).val().toString().trim();

    const red_price = $(".price .red_price");
    const old_price = $(".price .old_price");
    if (price === "") {
        old_price.css("margin-left", "0px");
        old_price.css("text-decoration", "none");
        old_price.css("color", "black")
            .css("opaicty", "1")
            .css("font-size", "1rem");
        red_price.hide()
    } else {
        red_price.show()
        old_price.css("margin-left", "20px");
        old_price.css("text-decoration", "line-through");
        old_price.css("color", "#8f8f8f")
            .css("opaicty", "0.8")
            .css("font-size", ".8em");
        red_price.text("₽ " + price);
    }
})

//отображение фото
function readURL(input) {
    var fileTypes = ['jpg', 'jpeg', 'png'];

    if (input.files && input.files[0]) {
        let reader = new FileReader();
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
        if (isSuccess) {
            $("#error").text("")

            reader.onload = function(e) {
                $('.bl_image img').attr('src', e.target.result.toString());
            }
        } else {
            $("#error").text("Неверное расширение файла")
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("input[name='product_main_image']").on("change", function() {
    readURL(this);
});