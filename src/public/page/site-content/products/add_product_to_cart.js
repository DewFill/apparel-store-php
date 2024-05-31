$(document).on('click', function (e) {
    // console.log(e.target)
    if (e.target.classList.contains('button_add_product_to_cart')) {

        const productId = Number($(e.target).parent().parent().data("product-id"));

        const sizes = $(e.target).parent().parent().data("product-sizes");

        console.log(sizes)
        console.log(typeof sizes)


        //если нет размеров - добавляем в корзину без выбора размера
        if (sizes.length === 0) {
            console.debug("если нет размеров - добавляем в корзину без выбора размера")
            addProductToCart(productId, 1, null)
        }

        //если у товара 1 размер - добавляем в корзину без диалога выбора размера
        else if (sizes.length === 1) {
            console.debug("если у товара 1 размер - добавляем в корзину без диалога выбора размера")
            addProductToCart(productId, 1, sizes[0]["id"])

            //если больше одного размера для товара - показываем диалог выбора размера
        } else if (sizes.length > 1) {
            console.debug("если больше одного размера для товара - показываем диалог выбора размера")
            $(e.target).replaceWith(`<div class="size_buttons" data-product-id="${productId}"></div>`);
            const sizes_container = $(`.size_buttons[data-product-id=${productId}]`);
            for (let i = 0; i < sizes.length; i++) {
                sizes_container.append(`<button class="product_size" data-product-id="${productId}" data-size_id="${sizes[i]["id"]}">${sizes[i]["size_name"]}</button>`)
            }
        }

    }
})

//ивент на нажатие на кнопку выбора размера
$(document).on('click', function (e) {
    // console.log(e.target)
    if (e.target.classList.contains('product_size')) {

        const product_id = $(e.target).data("product-id");
        const size_id = $(e.target).data("size_id");
        addProductToCart(product_id, 1, size_id)

    }
})

//отправка запроса на добавление товара в корзину на сервер
function addProductToCart(productId, quantity, size_id = null) {
    console.log("отправленные данные:")
    console.log("productId: " + productId)
    console.log("quantity: " + quantity)
    console.log("size_id: " + size_id)
    onRequest(productId);
    $.ajax({
        method: "POST",
        url: `/api/v1/cart/`,
        data: {
            product_id: productId,
            quantity: quantity,
            size_id: size_id
        }
    })
        .then(function (data) {
            if ("instruction" in data) {
                window.location.href = data.instruction["goto"];
            }

            return data;
        })
        .then(response => response["status"])
        .then(status => {
            if (status === "success") {
                const add_to_cart_button = $(`div[data-product-id=${productId}] .button_add_product_to_cart`);

                add_to_cart_button.removeClass("skeleton-loader")
                onSuccess(productId)
            }
        })
        .catch(error => {
            console.log(error.responseText)
        })
}

function onRequest(product_id) {
    const add_to_cart_button = $(`div[data-product-id=${product_id}] .button_add_product_to_cart`);

    add_to_cart_button.text("Добавить в корзину");
    add_to_cart_button.addClass("skeleton-loader")
}

function onSuccess(product_id) {
    const container = $(`.wrap_card[data-product-id=${product_id}] .bl_btn`);

    container.html("<button class='button_add_product_to_cart'>Добавлено в корзину</button>");


    setTimeout(() => {
        container.html("<button class='button_add_product_to_cart'>Добавить в корзину</button>");
    }, 2000)
}