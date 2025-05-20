const contactForm = document.getElementById('contactfrm');

contactForm.addEventListener('submit', function (event) {
    


fetch("https://formsubmit.co/ajax/digitaldashmedianz@gmail.com", {
    method: "POST",
    headers: { 
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({
        name: contactForm.name.value,
        email: contactForm.email.value,
        message: contactForm.message.value,
    })
})
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.log(error));
    
    event.preventDefault();
    const formData = new FormData(contactForm);


    contactForm.addEventListener('submit', function (event) {
    contactForm.querySelectorAll("input, textarea").forEach(input => {

        input.value = ""
    });
});
});

