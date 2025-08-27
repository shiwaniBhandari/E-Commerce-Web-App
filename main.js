const prevb = document.querySelector('.prevb')
const nextb = document.querySelector('.nextb')
const sliderb = document.querySelector('.sliderb')

prevb.addEventListener('click', () =>{
    sliderb.scrollLeft -= 300
})
nextb.addEventListener('click', () =>{
    sliderb.scrollLeft += 300
})
const prev = document.querySelector('.prev')
const next = document.querySelector('.next')
const slider = document.querySelector('.slider')

prev.addEventListener('click', () =>{
    slider.scrollLeft -= 300
})
next.addEventListener('click', () =>{
    slider.scrollLeft += 300
})
function validateEmail(event) {
    var emailInput = document.getElementById('email');
    var email = emailInput.value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailPattern.test(email)) {
        // Email is valid, remove the custom validity and allow the form to be submitted
        emailInput.setCustomValidity('');
    } else {
        // Email is invalid, display an error message
        emailInput.setCustomValidity('Please enter a valid email address.');
        event.preventDefault(); // Prevent form submission if the email is invalid
    }
}


//

