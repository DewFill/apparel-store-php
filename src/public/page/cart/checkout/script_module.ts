import {Fetcher} from "../../../static/js/Fetcher/Fetcher";

const pay_button = $("#pay_button");

pay_button.one("click", function () {
    const order_id = $("#pay_button").data("order-id");
    payReal();
    pay(order_id);
});

function payReal() {
    Fetcher.init()
        .setMethod("POST")
        .setUrl("api/v1/cart/checkout/")
        .setBody({})
}

function pay(order_id) {
    console.log("pay button clicked");
    let form = $(".checkout");
    //disable css click events
    form.css("pointer-events", "none");
    pay_button.attr("disabled", "true");
    form.css("opacity", "0.5");
    form.first().wrap(`<div id='wrapper'>`);

    let wrapper = $("#wrapper");
    wrapper.append(`<div id="spinner"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>`)

    setTimeout(function () {
        $("#spinner").append(`<div id="spinner_text">Пожалуйста подождите...</div>`);


        setTimeout(function () {
            $(".lds-spinner").remove();
            // @ts-ignore
            $("#spinner").children($("#spinner_text")).first().remove();


            setTimeout(function () {
                wrapper.append(`<div id="spinner"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>`)
                $("#spinner").append(`<div id="spinner_text">Пожалуйста подождите...</div>`);

                setTimeout(function () {
                    $(".lds-spinner").remove();
                    wrapper.append(`<div id="spinner"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>`)

                    setTimeout(function () {
                        // @ts-ignore
                        $("#spinner").children($(".lds-spinner")).first().remove();
                        setTimeout(function () {
                            $(".lds-spinner").remove();
                            // @ts-ignore
                            $("#spinner").children($("#spinner_text")).first().remove();
                            $("#spinner").append(`<div id="spinner_text">Для этой покупки не нужна оплата<br/>Code: 1002 (Test Purchase)<br/>Переадресация...</div>`);

                            setTimeout(function () {
                                window.location.href = "/cart/checkout/complete?order_id=" + order_id;
                            }, se())
                        }, se())
                    }, se())
                }, se())
            }, se())
        }, se())
    }, se())


}

function se() {
    let min = Math.ceil(100);
    let max = Math.floor(2000);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}