$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.materialboxed').materialbox();
    $('.parallax').parallax();
    $('.tabs').tabs();
  });
  $('.tooltipped').tooltip();
  $('.scrollspy').scrollSpy();


/* JavaScript for Toggling the Rating Form */

let toggleElement = document.querySelector('.form-header');
let chevronElement = document.querySelector('#chevron');
chevronElement.innerText = 'keyboard_arrow_down'

toggleElement.addEventListener('click', function() {
let form = document.querySelector('.toggler');
form.classList.toggle('hide');
if (form.classList.contains('hide')){
    chevronElement.innerText = 'keyboard_arrow_down'
} else {
    chevronElement.innerText = 'keyboard_arrow_up'
}
});


/* JavaScript for the Star Rating system */

let stars = document.querySelectorAll(".stars i");

// Loops through star NodeList
stars.forEach((star, index1) => {

// Function when click events triggers
star.addEventListener("click", () => {

    // Loop through stars NodeList again
    stars.forEach((star, index2) => {
        // Adding Color Stars
        if (index1 >= index2) {
            star.classList.add("color-star");
        } else {
            star.classList.remove("color-star")
        }
    })
})
})
