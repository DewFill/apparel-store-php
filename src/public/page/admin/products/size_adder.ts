//select handler
$("#size_add_select").on("change", function () {
    const selected_size = $("#size_add_select option:selected");
    const is_selected = selected_size.data("is-selected") === undefined ? false : selected_size.data("is-selected");

    if (is_selected) {
        $(".size_add_button").text("Удалить")
        $(this).css("font-weight", "bolder")
    } else {
        $(".size_add_button").text("Добавить")
        $(this).css("font-weight", "normal")
    }
})

//button handler
$(".size_add_button").on("click", function () {
    const selected_size = $("#size_add_select option:selected");
    const is_selected = selected_size.data("is-selected") === undefined ? false : selected_size.data("is-selected");

    if (is_selected) {
        //при удалении выбранного размера
        selected_size.data("is-selected", false)
        selected_size.css("font-weight", "normal")
        $("#size_add_select").css("font-weight", "normal")
        $(".size_add_button").text("Добавить")
    } else {
        //при добавлении выбранного размера
        selected_size.data("is-selected", true)
        selected_size.css("font-weight", "bolder")
        $("#size_add_select").css("font-weight", "bolder")
        $(".size_add_button").text("Удалить")
    }
})