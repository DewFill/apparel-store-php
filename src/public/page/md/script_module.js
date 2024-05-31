const textarea = $(".original textarea");

textarea.on("keyup",function () {
    generateMarkdown($(this).val());
})
textarea.on("keydown",function () {
    generateMarkdown($(this).val());
})

function generateMarkdown(text) {
    $(".markdown .output").html(marked.parse(text));
}