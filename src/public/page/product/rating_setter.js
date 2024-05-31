$(document).on('click', function (e) {
    if (e.target.classList.contains('rating-star')) {
        $(e.target).parent().addClass("user_rated");

        const rating = e.target.value.toString();
        const product_id = $(e.target).data("product-id").toString();


        let answer = $.ajax({
            method: "PUT",
            url: `/api/v1/product/rating/`,
            data: {
                rating: rating,
                product_id: product_id
            },
            async: false
        })

        if (answer.responseJSON["instruction"]["goto"] !== undefined) {
            window.location.href = answer.responseJSON["instruction"]["goto"];
        }
    }
})