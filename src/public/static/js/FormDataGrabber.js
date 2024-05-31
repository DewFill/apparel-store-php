export function formDataGrabber() {
    let values = {};
    $("form input").filter(function (index, domElement) {
        const value = $(domElement).val();
        if (domElement.getAttribute("type") === "submit") {
            return false;
        }
        // if (typeof (value) === "string" && value.length === 0) {
        //     return false;
        // }
        return true;
    }).each(function (index, element) {
        const elem = $(element);
        const elem_id = elem.attr("id");
        // @ts-ignore
        values[elem_id] = elem.val();
    });
    const textarea = $("form textarea");
    if (textarea.length > 0) {
        // @ts-ignore
        values[textarea.attr("id")] = textarea.val();
    }
    return values;
}
//# sourceMappingURL=FormDataGrabber.js.map