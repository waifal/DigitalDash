import { 
    Modal, 
    Accordion, 
    SignupFormValidator, 
    LoginFormValidator 
} from "./classes.js";

function initModal(button, text) {
    const modal = new Modal(button, text);
    modal.showModal();
}

let currentlyOpenAccordion = null;
let currentlyOpenButton = null;

function initAccordion(clickedButton, id, height, text) {
    const existingAccordion = document.getElementById(id);

    if (clickedButton === currentlyOpenButton && existingAccordion && existingAccordion.style.display !== 'none') {
        const acc = new Accordion(clickedButton, id, height, "");
        acc.hideAccordion(currentlyOpenAccordion);
        currentlyOpenAccordion = null;
        currentlyOpenButton = null;
        return;
    }

    if (currentlyOpenAccordion) {
        const prev = new Accordion(currentlyOpenButton, currentlyOpenAccordion.id, height, "");
        prev.hideAccordion(currentlyOpenAccordion);
    }

    const acc = new Accordion(clickedButton, id, height, text);
    const newAccordion = acc.showAccordion();

    currentlyOpenAccordion = newAccordion;
    currentlyOpenButton = clickedButton;
}

function showPasswords() {
    const buttons = document.getElementsByClassName('show_password');

    Array.from(buttons).forEach(button => {
        button.style.display = "none";

        button.parentElement.firstElementChild.addEventListener("input", (event) => {
            button.style.display = event.currentTarget.value ? "block" : "none";
        });

        button.addEventListener("click", (event) => {
            const input = event.currentTarget.parentElement.firstElementChild;
            input.type = input.type === "password" ? "text" : "password";
        });
    });
}

showPasswords();

window.initModal = initModal;
window.initAccordion = initAccordion;

document.addEventListener('DOMContentLoaded', () => {
    const resetForm = document.getElementById('resetpwdfrm');
    if (resetForm) {
        const emailInput = resetForm.querySelector('#email');
        const errorMessage = resetForm.querySelector('.error');

        if (emailInput && errorMessage) {
            emailInput.addEventListener('input', () => {
                errorMessage.style.display = 'none';
            });
        }

        resetForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const confirmButton = resetForm.querySelector('button[type="submit"]');
            const backButton = resetForm.querySelector('a[href="login.php"]');
            
            if (!emailInput || !emailInput.value.trim()) {
                return;
            }
            
            if (emailInput && confirmButton) {
                const formData = new FormData(resetForm);
                
                try {
                    confirmButton.textContent = 'Sending Email...';
                    confirmButton.disabled = true;
                    emailInput.readOnly = true;
                    if (backButton) backButton.style.display = 'none';
                    
                    const response = await fetch('../../../php/check-email.inc.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    resetForm.submit();
                } catch (error) {
                    confirmButton.textContent = 'Confirm';
                    confirmButton.disabled = false;
                    emailInput.readOnly = false;
                    if (backButton) backButton.style.display = 'block';
                }
            }
        });
    }
});

if (document.getElementById('signupfrm')) {
    new SignupFormValidator('signupfrm');
}
if (document.getElementById('loginfrm')) {
    new LoginFormValidator('loginfrm');
}