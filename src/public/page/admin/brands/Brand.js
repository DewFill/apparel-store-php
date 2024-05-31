import { Fetcher } from "../../../static/js/Fetcher/Fetcher.js";
export default class Brand {
    id;
    name;
    getId() {
        return this.id;
    }
    getName() {
        return this.name;
    }
    static addBrand(brand) {
        //Создание формы
        let formData = new FormData();
        formData.append("brand_name", brand.name);
        //Отправка данных на сервер
        return Fetcher.init()
            .setUrl("/api/v1/brand/")
            .setMethod("POST")
            .setBody({
            brand_name: $("#form_create input[name='brand_name']").val().toString()
        })
            .fetch();
    }
    static deleteBrand(brand) {
        //Создание формы
        let formData = new FormData();
        formData.append("brand_id", brand.id.toString());
        $.ajax({
            url: '/api/v1/brand?brand_id=' + brand.id + '/',
            type: 'DELETE',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return true;
            },
            error: function (data) {
                throw new Error("Unable to delete brand. Error: " + data);
            }
        });
    }
    static updateBrand(brand) {
        let formData = new FormData();
        formData.append("brand_id", brand.id.toString());
        formData.append("brand_name", brand.name);
        Fetcher.init()
            .setUrl("/api/v1/brand/")
            .setMethod("PUT");
        $.ajax({
            url: '/api/v1/brand?brand_id=' + brand.id + '/',
            type: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return {
                    isSuccess: true,
                    data: data
                };
            },
            error: function (data) {
                console.log(data.responseText);
                throw new Error("Unable to update slide.");
            }
        });
    }
}
//# sourceMappingURL=Brand.js.map