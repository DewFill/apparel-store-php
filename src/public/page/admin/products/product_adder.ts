$(".add_form").on("submit", function (e) {
    // console.log(document.forms[1])
    // @ts-ignore
    let form = new FormData($(this)[0]);

    //adding selected sizes
    $(".size_add_select option").filter(function () {
        return $(this).data("is-selected") === true
    }).each(function () {
        // @ts-ignore
        form.append("sizes[]", $(this).val())
    })

    //adding selected categories
    $(".categories_add_select option").filter(function () {
        return $(this).data("is-selected") === true
    }).each(function () {
        // @ts-ignore
        form.append("categories[]", $(this).val())
    })

    console.log(form.get("other_images"))
    if (form.get("other_images")) {

    }


    fetch("/api/v1/product/",
        {
            method: "POST",
            body: form
        }
    )
        .then(res => res.json())
        .then(function (data) {
            if (data.status === "success") {
                $(".create_product_button").val("Товар добавлен")

                setTimeout(function () {
                    $(".create_product_button").val("Добавить товар")
                }, 2000)
            }

            return data;
        })
        .then(function (data) {
            const product_id = data.data["product_id"];
            $(".product_link").attr("href", `/product?product_id=${product_id}/`)
            $(".product_link").text(`artemy.net/product?product_id=${product_id}/`)
        })
        .then(res => console.log(res))
    e.preventDefault();

    // let formData = new FormData(form);

})
