export default class Slides {
    private id: number;
    private url;
    private isActive: boolean;
    private image: Blob | null = null;

    getId() {
        return this.id;
    }

    getUrl() {
        return this.url;
    }

    getIsActive() {
        return this.isActive;
    }

    getImageUrl() {
        return `/api/v1/slide/image?slide_url=${this.id}`;
    }

    setImage(image: Blob) {
        this.image = image;
    }

    setUrl(url: string) {
        this.url = url;
    }

    setIsActive(isActive: boolean) {
        this.isActive = isActive;
    }

    getImage() {
        return this.image;
    }

    setId(id: number) {
        this.id = id;
    }

    static addSlide(slide: Slides) {
        //Создание формы
        let formData = new FormData();
        formData.append("slide_image", slide.image);
        // formData.append("slide_url", slide.url);


        //Отправка данных на сервер
        return fetch('/api/v1/slide/', {method: "POST", body: formData})
            .then(response => response.json())
            .then(json => slide.id = json["data"]["slide_id"])
            .then(id => {
                console.log("Slider №" + id + " was added")
                return slide
            })

            .catch(function (error) {
                throw new Error("Unable to add slide. Error: " + error);
            });
    }

    static deleteSlide(slide: Slides) {
        //Создание формы
        let formData = new FormData();
        formData.append("slide_id", slide.id.toString());

        $.ajax({
            url: '/api/v1/slide?slide_id=' + slide.id + '/',
            type: 'DELETE',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return true;
            },

            error: function (data) {
                throw new Error("Unable to delete slide. Error: " + data);
            }
        });
    }

    static updateSlide(slide: Slides) {
        let formData = new FormData();
        formData.append("slide_id", slide.id.toString());
        formData.append("slide_image", slide.image);
        formData.append("slide_url", slide.url);
        formData.append("slide_active", slide.isActive.toString());

        $.ajax({
            url: '/api/v1/slide?slide_id=' + slide.id + '/',
            type: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                return slide;
            },
            error: function (data) {
                console.log(data.responseText)
                throw new Error("Unable to update slide.");
            }
        });
    }
}