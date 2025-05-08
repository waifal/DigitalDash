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
    if (document.getElementById('signupfrm')) {
        new SignupFormValidator('signupfrm');
    }
    if (document.getElementById('loginfrm')) {
        new LoginFormValidator('loginfrm');
    }
});