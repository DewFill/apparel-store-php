// @ts-ignore
import { Fetcher } from "/static/js/Fetcher/Fetcher.js";
export class Product {
    id;
    article;
    brand_id;
    name;
    price;
    discount_price;
    discount;
    description;
    composition;
    main_image;
    static init() {
        return new Product();
    }
    getName() {
        return this.name;
    }
    getArticle() {
        return this.article;
    }
    getPrice() {
        return this.price;
    }
    getDescription() {
        return this.description;
    }
    getComposition() {
        return this.composition;
    }
    getMainImageLink() {
        return `/api/v1/product/image?product_id=${this.id}/`;
    }
    //
    //
    //
    setName(name) {
        this.name = name;
    }
    setArticle(article) {
        this.article = article;
    }
    setBrandId(brand_id) {
        this.brand_id = brand_id;
    }
    setPrice(price) {
        this.price = price;
    }
    setDiscountPrice(discount_price) {
        this.discount_price = discount_price;
    }
    setDiscount(discount) {
        this.discount = discount;
    }
    setDescription(description) {
        this.description = description;
    }
    setComposition(composition) {
        this.composition = composition;
    }
    setMainImage(main_image) {
        this.main_image = main_image;
    }
    static addProduct(product) {
        // console.log(product)
        return Fetcher.init()
            .setMethod("POST")
            .setUrl("/api/v1/product/")
            .setBody(product)
            .setContentType("multipart/form-data")
            .fetch();
    }
}
//# sourceMappingURL=Product.js.map