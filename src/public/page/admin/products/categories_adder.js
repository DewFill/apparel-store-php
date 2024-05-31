//select handler
$("#categories_add_select").on("change", function () {
    const selected_categories = $("#categories_add_select option:selected");
    const is_selected = selected_categories.data("is-selected") === undefined ? false : selected_categories.data("is-selected");
    if (is_selected) {
        $(".categories_add_button").text("Удалить");
        $(this).css("font-weight", "bolder");
    }
    else {
        $(".categories_add_button").text("Добавить");
        $(this).css("font-weight", "normal");
    }
});
//button handler
$(".categories_add_button").on("click", function () {
    const selected_categories = $("#categories_add_select option:selected");
    const is_selected = selected_categories.data("is-selected") === undefined ? false : selected_categories.data("is-selected");
    if (is_selected) {
        //при удалении выбранного размера
        selected_categories.data("is-selected", false);
        selected_categories.css("font-weight", "normal");
        $("#categories_add_select").css("font-weight", "normal");
        $(".categories_add_button").text("Добавить");
    }
    else {
        //при добавлении выбранного размера
        selected_categories.data("is-selected", true);
        selected_categories.css("font-weight", "bolder");
        $("#categories_add_select").css("font-weight", "bolder");
        $(".categories_add_button").text("Удалить");
    }
});
//# sourceMappingURL=categories_adder.js.map