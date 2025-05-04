class Modal {
    constructor(button, text) {
        this.button = button;
        this.text = text;
    }

    showModal() {
        const modalParent = document.createElement('div');

        modalParent.className = "modal__container";
        modalParent.innerHTML = `
            <dialog class="modal">
                <div>
                    <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div>
                    <p>${this.text}</p>
                </div>
            </dialog>
        `;

        document.body.prepend(modalParent);

        const dialog = modalParent.querySelector('dialog');
        const closeModalBtn = dialog.querySelector('.close-modal');

        dialog.showModal();

        closeModalBtn.addEventListener('click', () => modalParent.remove());
        window.addEventListener('keydown', (event) => event.key === "Escape" ? modalParent.remove() : null);
    }
}

export { Modal };