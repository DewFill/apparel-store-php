import { Fetcher } from "../../../static/js/Fetcher/Fetcher.js";
export default class Category {
    id;
    name;
    getId() {
        return this.id;
    }
    getName() {
        return this.name;
    }
    static addCategory(category) {
        //Создание формы
        let formData = new FormData();
        formData.append("category_name", category.name);
        //Отправка данных на сервер
        return Fetcher.init()
            .setUrl("/api/v1/category/")
            .setMethod("POST")
            .setBody({
            category_name: $("#form_create input[name='category_name']").val().toString()
        })
            .fetch();
    }
    static deleteCategory(category) {
        //Создание формы
        let formData = new FormData();
        formData.append("category_id", category.id.toString());
        $.ajax({
            url: '/api/v1/category?category_id=' + category.id + '/',
            type: 'DELETE',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return true;
            },
            error: function (data) {
                throw new Error("Unable to delete category. Error: " + data);
            }
        });
    }
    static updateCategory(category) {
        let formData = new FormData();
        formData.append("category_id", category.id.toString());
        formData.append("category_name", category.name);
        Fetcher.init()
            .setUrl("/api/v1/category/")
            .setMethod("PUT");
        $.ajax({
            url: '/api/v1/category?category_id=' + category.id + '/',
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
                throw new Error("Unable to update category.");
            }
        });
    }
}
//# sourceMappingURL=Category.js.map