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

class Accordion {
    constructor(button, id, height = false, text) {
        this.button = button;
        this.id = id;
        this.height = height;
        this.text = text;
        this.div = null;
    }

    showAccordion() {
        const parent = this.button.parentNode;
        const existingDiv = document.getElementById(this.id);

        if (existingDiv) {
            existingDiv.style.display = "block";
            return existingDiv;
        }

        const div = document.createElement("div");
        div.id = this.id;
        div.className = "accordion__container";
        div.innerHTML = `<div class="accordion__content">${this.text}</div>`;
        div.style.overflow = "hidden";
        this.div = div;

        const sibling = this.button.nextSibling;
        sibling ? parent.insertBefore(div, sibling) : parent.appendChild(div);

        if (this.height) {
            div.style.height = "0px";
            requestAnimationFrame(() => {
                div.style.transition = "height 0.3s ease";
                div.style.height = div.scrollHeight + "px";
            });
        } else {
            div.style.display = "none";
            div.style.display = "block";
        }

        return div;
    }

    hideAccordion(div) {
        if (this.height) {
            div.style.height = div.scrollHeight + "px";
            requestAnimationFrame(() => {
                div.style.transition = "height 0.2s ease";
                div.style.height = "0px";
            });

            div.addEventListener("transitionend", () => {
                if (div.parentNode) div.parentNode.removeChild(div);
            }, { once: true });
        } else {
            div.style.display = "none";
        }
    }
}

export { Modal, Accordion };