//выборка GET
// @ts-ignore
let params = (new URL(document.location)).searchParams;
let query = params.get("q");
if (query.endsWith("/")) {
    query = query.slice(0, -1);
}


// запись GET запроса в форму поиска
$("#header_search").val(query);


//подсвечивание результатов поиска
let product_names = $(".wrap_card .name");

product_names.each(function (index, element) {
    // @ts-ignore
    let instance = new Mark(element);
    instance.mark(query, {"ignorePunctuation": ":;.,-–—‒_(){}[]!'\"+=".split("")});
})