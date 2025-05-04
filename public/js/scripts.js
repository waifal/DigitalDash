import { Modal } from "./classes";

function initModal(targetId, text) {
    const modal = new Modal(targetId, text);
    modal.showModal();
}