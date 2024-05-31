$("#addToCard").on("click", function () {
    const productId = $(this).data("product-id");
    const size_selector = $("#size_selector");
    //если есть выбор размеров - добавляем в запрос информацию о выбранном размере
    if (size_selector.length) {
        const size_id = $("#size_selector option:selected").val();
        addProductToCart(productId, 1, size_id);
    }
    else {
        addProductToCart(productId, 1, null);
    }
});
//отправка запроса на добавление товара в корзину на сервер
function addProductToCart(productId, quantity, size_id = null) {
    console.log("отправленные данные:");
    console.log("productId: " + productId);
    console.log("quantity: " + quantity);
    console.log("size_id: " + size_id);
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
            add_to_cart_button.removeClass("skeleton-loader");
            onSuccess(productId);
        }
    })
        .catch(error => {
        // @ts-ignore
        console.log(error.responseText);
    });
}
function onRequest(product_id) {
    const add_to_cart_button = $(`div[data-product-id=${product_id}] .button_add_product_to_cart`);
    add_to_cart_button.text("Добавить в корзину");
    add_to_cart_button.addClass("skeleton-loader");
}
function onSuccess(product_id) {
    const container = $(`.wrap_card[data-product-id=${product_id}] .bl_btn`);
    $("#addToCard").text("Добавлено в корзину");
    setTimeout(() => {
        $("#addToCard").text("Добавить в корзину");
    }, 2000);
}
//добавить в избранное
$(document).on("click", function (e) {
    const target = $(e.target);
    //удаление из избранного
    if (target.hasClass("heart_active")) {
        // console.log("---удаление из избранного");
        target.removeClass("heart_active");
        target.addClass("heart");
        const product_id = target.parent().parent().data("product-id");
        setProductFavorite(product_id, false);
    }
    else if (target.hasClass("heart")) {
        //добавление в избранное
        // console.log("+++добавление в избранное");
        target.removeClass("heart");
        target.addClass("heart_active");
        const product_id = target.parent().parent().data("product-id");
        setProductFavorite(product_id, true);
    }
});
function setProductFavorite(product_id, is_favorite) {
    let answer = $.ajax({
        method: "PUT",
        url: `/api/v1/product/favorite/`,
        data: {
            is_favorite: is_favorite,
            product_id: product_id
        },
        async: false
    });
    console.log(answer);
    if ("instruction" in answer) {
        window.location.href = answer.responseJSON["instruction"]["goto"];
    }
}
//# sourceMappingURL=script_module.js.map