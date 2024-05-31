// @ts-ignore
import {Fetcher} from "/static/js/Fetcher/Fetcher.js";

export class Product {
    private id: number;
    private article: string;
    private brand_id: number;
    private name: string;
    private price: string;
    private discount_price: string;
    private discount: number;
    private description: string;
    private composition: string;
    private main_image: object;

    static init() {
        return new Product();
    }


    getName(): string {
        return this.name;
    }

    getArticle(): string {
        return this.article;
    }

    getPrice(): string {
        return this.price;
    }

    getDescription(): string {
        return this.description;
    }

    getComposition(): string {
        return this.composition;
    }

    getMainImageLink(): string {
        return `/api/v1/product/image?product_id=${this.id}/`;
    }

    //
    //
    //


    setName(name: string) {
        this.name = name;
    }

    setArticle(article: string) {
        this.article = article;
    }

    setBrandId(brand_id: number) {
        this.brand_id = brand_id;
    }


    setPrice(price: string) {
        this.price = price;
    }

    setDiscountPrice(discount_price: string) {
        this.discount_price = discount_price;
    }

    setDiscount(discount: number) {
        this.discount = discount;
    }

    setDescription(description: string) {
        this.description = description;
    }

    setComposition(composition: string) {
        this.composition = composition;
    }

    setMainImage(main_image: object) {
        this.main_image = main_image;
    }




    static addProduct(product) {
        // console.log(product)

        return Fetcher.init()
            .setMethod("POST")
            .setUrl("/api/v1/product/")
            .setBody(product)
            .setContentType("multipart/form-data")
            .fetch()
    }
}