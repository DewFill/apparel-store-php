fetch('/api/v1/products/', {method: "GET"})
    .then(response => {
        console.log(response);
        return response.json()
    })
    .then(json => json["data"])
    .then(product_ids => {

        // получение каждого продукта
        for (let i = 0; i < product_ids.length; i++) {
            const product_id = product_ids[i];
            fetch(`/api/v1/product/?product_id=${product_id}/`, {method: "GET"})
                .then(response => {
                    return response.json()
                })
                .then(json => {
                    return json["data"]
                })
                .then(product => {
                    addProduct(product)
                })
        }
    })


function addProduct(product) {
    console.log(product)
    const isUserFavorite = product["is_user_favorite"];
    console.log(isUserFavorite)
    $(".flex_wrap").append(
        `<div class="wrap_card" data-product-id="${product['id']}">
            
                <div class="bl_image">
                    <div class="sale">
                        <p class="procent">20%sale</p>
                    </div>
                    <a href="/product?product_id=${product['id']}/">
                        <img src="/static/image/arts/img_1.jpg" alt="model_art">
                    </a>

              <span class="${isUserFavorite ? 'heart_active' : 'heart'}" > </span>
                </div>
            <div class="bl_text">
                <p class="brand">${product['brand_name']}</p>
                <a href="/product?product_id=${product['id']}/"><p class="name">${product['name']}</p></a>

                <div class="rating-area">
                <input ${product['user_rating'] === 5 ? 'checked' : ''} class="rating-star" type="radio" id="star-5_product_id${product['id']}" name="rating_product_id${product['id']}" value="5" data-product-id="${product['id']}">
                <label for="star-5_product_id${product['id']}" title="Оценка «5»"></label>\t
                <input ${product['user_rating'] === 4 ? 'checked' : ''} class="rating-star" type="radio" id="star-4_product_id${product['id']}" name="rating_product_id${product['id']}" value="4" data-product-id="${product['id']}">
                <label for="star-4_product_id${product['id']}" title="Оценка «4»"></label>    
                <input ${product['user_rating'] === 3 ? 'checked' : ''} class="rating-star" type="radio" id="star-3_product_id${product['id']}" name="rating_product_id${product['id']}" value="3" data-product-id="${product['id']}">
                <label for="star-3_product_id${product['id']}" title="Оценка «3»"></label>  
                <input ${product['user_rating'] === 2 ? 'checked' : ''} class="rating-star" type="radio" id="star-2_product_id${product['id']}" name="rating_product_id${product['id']}" value="2" data-product-id="${product['id']}">
                <label for="star-2_product_id${product['id']}" title="Оценка «2»"></label>    
                <input ${product['user_rating'] === 1 ? 'checked' : ''} class="rating-star" type="radio" id="star-1_product_id${product['id']}" name="rating_product_id${product['id']}" value="1" data-product-id="${product['id']}">
                <label for="star-1_product_id${product['id']}" title="Оценка «1»"></label>
            </div>
                <p class="price">
                    <span class="red_price">РУБ 11760.00</span>
                    <span class="old_price">РУБ ${product['price']}</span>
                </p>
            </div>
            <div class="bl_btn">
                    <button class="button_add_product_to_cart">Добавить в корзину</button>
            </div>
        </div>`
    )
}