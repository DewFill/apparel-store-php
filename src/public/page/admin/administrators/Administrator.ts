import {Fetcher} from "../../../static/js/Fetcher/Fetcher.js";

export default class Administrator {
    public  id: number;
    public name;

    getId() {
        return this.id;
    }

    getName() {
        return this.name;
    }

    static addAdministrator(administrator: Administrator) {
        //Создание формы
        let formData = new FormData();
        formData.append("user_name", administrator.name);


        //Отправка данных на сервер
        return Fetcher.init()
            .setUrl("/api/v1/admin/")
            .setMethod("POST")
            .setBody({
                user_email: $("#form_create input[name='user_name']").val()
            })
            .fetch()
    }

    static deleteAdministrator(administrator: Administrator) {
        //Создание формы
        let formData = new FormData();
        formData.append("user_id", administrator.id.toString());

        $.ajax({
            url: '/api/v1/admin?user_id=' + administrator.id + '/',
            type: 'DELETE',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return true;
            },

            error: function (data) {
                throw new Error("Unable to delete administrator. Error: " + data);
            }
        });
    }
}