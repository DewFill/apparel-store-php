$(document).on("click", function (e) {
    const target = $(e.target);

    //удаление из избранного
    if (target.hasClass("heart_active")) {
        // console.log("---удаление из избранного");
        target.removeClass("heart_active");
        target.addClass("heart");
        const product_id = target.parent().parent().data("product-id");
        setProductFavorite(product_id, false);
    } else if (target.hasClass("heart")) {
        //добавление в избранное
        // console.log("+++добавление в избранное");
        target.removeClass("heart");
        target.addClass("heart_active");
        const product_id = target.parent().parent().data("product-id");
        setProductFavorite(product_id, true);
    }
})

function setProductFavorite(product_id, is_favorite) {
    let answer = $.ajax({
        method: "PUT",
        url: `/api/v1/product/favorite/`,
        data: {
            is_favorite: is_favorite,
            product_id: product_id
        },
        async: false
    })

    if (answer.responseJSON["instruction"]["goto"] !== undefined) {
        window.location.href = answer.responseJSON["instruction"]["goto"];
    }
}