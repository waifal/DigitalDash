import { Modal } from "./classes.js";

function initModal(button, text) {
    const modal = new Modal(button, text);
    modal.showModal();
}

window.initModal = initModal;