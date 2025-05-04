import { Modal, Accordion } from "./classes.js";

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


window.initModal = initModal;
window.initAccordion = initAccordion;