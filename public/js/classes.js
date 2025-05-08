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

class SignupFormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.errorMessages = {
            fname: {
                valueMissing: 'First name is required',
                patternMismatch: 'First name should only contain letters'
            },
            lname: {
                valueMissing: 'Last name is required',
                patternMismatch: 'Last name should only contain letters'
            },
            email: {
                valueMissing: 'Email address is required',
                typeMismatch: 'Please enter a valid email address',
                patternMismatch: 'Please enter a valid email address'
            },
            password: {
                valueMissing: 'Password is required',
                patternMismatch: 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character',
                tooShort: 'Password must be at least 8 characters long'
            },
            pwd_confirm: {
                valueMissing: 'Please confirm your password',
                customError: 'Passwords do not match'
            },
            terms_and_conditions: {
                valueMissing: 'You must accept the Terms & Conditions'
            },
            privacy_policy: {
                valueMissing: 'You must accept the Privacy Policy'
            }
        };

        this.setupValidation();
    }

    setupValidation() {
        if (!this.form) return;

        const namePattern = '^[A-Za-z]+$';
        const emailPattern = '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$';
        const passwordPattern = '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$';

        this.form.querySelector('#fname').pattern = namePattern;
        this.form.querySelector('#lname').pattern = namePattern;
        this.form.querySelector('#email').pattern = emailPattern;
        this.form.querySelector('#password').pattern = passwordPattern;
        this.form.querySelector('#password').minLength = 8;

        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => this.validateField(input));
            input.addEventListener('blur', () => this.validateField(input));
        });

        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        const passwordConfirm = this.form.querySelector('#pwd_confirm');
        passwordConfirm.addEventListener('input', () => this.validatePasswordMatch());
    }

    validateField(input) {
        const errorContainer = this.getErrorContainer(input);
        
        if (input.validity.valid) {
            this.setValid(input, errorContainer);
        } else {
            this.setInvalid(input, errorContainer);
        }
    }

    validatePasswordMatch() {
        const password = this.form.querySelector('#password');
        const confirmPassword = this.form.querySelector('#pwd_confirm');
        const errorContainer = this.getErrorContainer(confirmPassword);

        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
            this.setInvalid(confirmPassword, errorContainer);
        } else {
            confirmPassword.setCustomValidity('');
            this.setValid(confirmPassword, errorContainer);
        }
    }

    getErrorContainer(input) {
        let errorContainer;
        if (input.closest('.password__container')) {
            const parentContainer = input.closest('.password__container');
            errorContainer = parentContainer.nextElementSibling;
            if (!errorContainer || !errorContainer.classList.contains('error-message')) {
                errorContainer = document.createElement('div');
                errorContainer.className = 'error-message';
                errorContainer.setAttribute('aria-live', 'polite');
                parentContainer.parentNode.insertBefore(errorContainer, parentContainer.nextSibling);
            }
        } else if (input.type === 'checkbox') {
            const checkboxWrapper = input.closest('.checkbox-wrapper');
            errorContainer = checkboxWrapper.nextElementSibling;
            if (!errorContainer || !errorContainer.classList.contains('error-message')) {
                errorContainer = document.createElement('div');
                errorContainer.className = 'error-message';
                errorContainer.setAttribute('aria-live', 'polite');
                checkboxWrapper.parentNode.insertBefore(errorContainer, checkboxWrapper.nextSibling);
            }
        } else {
            errorContainer = input.nextElementSibling;
            if (!errorContainer || !errorContainer.classList.contains('error-message')) {
                errorContainer = document.createElement('div');
                errorContainer.className = 'error-message';
                errorContainer.setAttribute('aria-live', 'polite');
                input.parentNode.insertBefore(errorContainer, input.nextSibling);
            }
        }
        return errorContainer;
    }

    setValid(input, errorContainer) {
        input.setAttribute('aria-invalid', 'false');
        errorContainer.textContent = '';
        errorContainer.style.display = 'none';
    }

    setInvalid(input, errorContainer) {
        input.setAttribute('aria-invalid', 'true');
        const errorMessage = this.getErrorMessage(input);
        errorContainer.textContent = errorMessage;
        errorContainer.style.display = 'block';
    }

    getErrorMessage(input) {
        const messages = this.errorMessages[input.name];
        for (const [key, message] of Object.entries(messages)) {
            if (input.validity[key]) {
                return message;
            }
        }
        return 'Please check this field';
    }

    handleSubmit(e) {
        e.preventDefault();
        const inputs = this.form.querySelectorAll('input');
        let isValid = true;

        inputs.forEach(input => {
            this.validateField(input);
            if (!input.validity.valid) {
                isValid = false;
            }
        });

        this.validatePasswordMatch();
        const confirmPassword = this.form.querySelector('#pwd_confirm');
        if (!confirmPassword.validity.valid) {
            isValid = false;
        }

        if (isValid) {
            this.form.submit();
        }
    }
}

export { Modal, Accordion, SignupFormValidator };