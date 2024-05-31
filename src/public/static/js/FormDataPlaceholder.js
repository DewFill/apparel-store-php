export function formDataPlaceholder(data) {
    $("form input").each(function (index, element) {
        const elem = $(element);
        if (elem.attr("id") in data) {
            // @ts-ignore
            elem.val(data[elem.attr("id")]);
            // @ts-ignore
            delete data[elem.attr("id")];
        }
    });
    if (Object.keys(data).length > 0)
        console.warn("FormDataPlaceholder(): Got unused data while filling the form: ", data);
}
//# sourceMappingURL=FormDataPlaceholder.js.map