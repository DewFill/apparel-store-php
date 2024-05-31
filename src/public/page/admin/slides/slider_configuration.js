const number_of_slides = $(".slider__items").children().length;
const isOneSlide = number_of_slides === 1;

const slider = new ChiefSlider('.slider', {
    loop: !isOneSlide,
    // autoplay: !isOneSlide,
    interval: 5000
});

if (!isOneSlide) {
    console.log("Листание первого слада при загрузке включено")
    slider.next();
}