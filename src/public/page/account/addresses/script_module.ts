// @ts-ignore
import {Fetcher} from "/static/js/Fetcher/Fetcher.js";

$(".delete_address_button").on("click", function(e) {
    e.preventDefault();
    const address_id = $(this).data("address-id");

    Fetcher.init()
        .setMethod("DELETE")
        .setUrl(`/api/v1/address?address_id=${address_id}/`)
        .fetch()
        .then(function (response) {
            if (response.isSuccess === true) {
                $(e.target).parent().parent().remove();
            }
        })
        .catch(function (error) {console.log(error)});
})