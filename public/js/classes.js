/**
 * Modal component for displaying popup messages
 * @class
 * @param {HTMLElement} button - The button that triggers the modal
 * @param {string} text - The content text to display in the modal
 */
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

/**
 * Accordion component for expandable/collapsible content sections
 * @class
 * @param {HTMLElement} button - The button that triggers the accordion
 * @param {string} id - Unique identifier for the accordion
 * @param {boolean} [height=false] - Whether to animate height transitions
 * @param {string} text - The content text to display in the accordion
 */
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

/**
 * Form validator for signup forms with real-time validation
 * @class
 * @param {string} formId - The ID of the signup form element
 * @property {HTMLFormElement} form - The form element being validated
 * @property {Object} errorMessages - Validation error messages for each field
 */
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
        this.setupPasswordConfirmVisibility();
    }

    setupPasswordConfirmVisibility() {
        const password = this.form.querySelector('#password');
        const confirmPasswordGroup = this.form.querySelector('#pwd_confirm').closest('.form-group');
        const confirmPassword = this.form.querySelector('#pwd_confirm');
        
        // Set initial state
        confirmPasswordGroup.style.display = password.value ? 'block' : 'none';
        
        // Update on password change
        password.addEventListener('input', (e) => {
            confirmPasswordGroup.style.display = e.target.value ? 'block' : 'none';
            if (!e.target.value) {
                confirmPassword.value = '';
                const errorContainer = this.getErrorContainer(confirmPassword);
                this.setValid(confirmPassword, errorContainer);
            }
        });
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

/** Form validator for login forms with real-time validation */
class LoginFormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (this.form) {
            this.emailInput = this.form.querySelector('#email');
            this.passwordInput = this.form.querySelector('#password');
            this.errorMessages = {
                email: {
                    valueMissing: 'Email address is required',
                    typeMismatch: 'Please enter a valid email address',
                    patternMismatch: 'Please enter a valid email address'
                },
                password: {
                    valueMissing: 'Password is required',
                    invalid: 'Invalid password'
                }
            };
            this.initializeValidation();
        }
    }

    initializeValidation() {
        if (!this.emailInput) return;
        
        const emailPattern = '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}';
        this.emailInput.pattern = emailPattern;

        this.emailInput.setCustomValidity('');

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (this.validateForm()) {
                this.form.submit();
            }
        });

        this.emailInput.addEventListener('input', () => {
            this.validateField(this.emailInput);
            this.clearServerErrors();
        });

        this.passwordInput.addEventListener('input', () => {
            this.validateField(this.passwordInput);
            this.clearServerErrors();
        });

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (this.validateForm()) {
                this.form.submit();
            }
        });
    }

    clearServerErrors() {
        const serverErrors = this.form.querySelectorAll('.error[role="alert"]');
        serverErrors.forEach(error => error.remove());
    }

    validateForm() {
        let isValid = true;
        this.clearErrors();

        this.validateField(this.emailInput);
        this.validateField(this.passwordInput);

        if (!this.emailInput.validity.valid || !this.passwordInput.validity.valid) {
            isValid = false;
        }

        return isValid;
    }

    validateField(input) {
        const errorContainer = this.getErrorContainer(input);
        
        if (input.validity.valid) {
            this.setValid(input, errorContainer);
        } else {
            this.setInvalid(input, errorContainer);
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

    clearErrors() {
        const errors = this.form.querySelectorAll('.error-message');
        errors.forEach(error => {
            error.textContent = '';
            error.style.display = 'none';
        });
    }
}

/** Form validator for password reset request forms */
class ResetPasswordValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (this.form) {
            this.emailInput = this.form.querySelector('#email');
            this.submitButton = this.form.querySelector('button[type="submit"]');
            this.errorMessages = {
                email: {
                    valueMissing: 'Email address is required',
                    typeMismatch: 'Please enter a valid email address',
                    patternMismatch: 'Please enter a valid email address'
                }
            };
            this.initializeValidation();
        }
    }

    initializeValidation() {
        const emailPattern = '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}';
        this.emailInput.pattern = emailPattern;  // Error occurs here

        this.emailInput.setCustomValidity('');

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            if (this.validateForm()) {
                this.submitButton.disabled = true;
                this.submitButton.style.cursor = 'wait';
                this.submitButton.textContent = 'Sending...';
                this.emailInput.readOnly = true;

                const buttonContainer = this.submitButton.parentElement;
                Array.from(buttonContainer.children).forEach(child => {
                    if (child !== this.submitButton) {
                        child.hidden = true;
                    }
                });

                this.form.submit();
            }
        });

        this.emailInput.addEventListener('input', () => {
            const errorContainer = this.form.querySelector('.error-message');
            const phpError = this.form.querySelector('.error');
            
            if (errorContainer) {
                errorContainer.style.display = 'none';
            }
            if (phpError) {
                phpError.remove();
            }
            
            this.submitButton.disabled = false;
            this.submitButton.style.cursor = 'pointer';
            this.submitButton.textContent = 'Confirm';
            this.emailInput.readOnly = false;
        });
    }

    validateForm() {
        let isValid = true;
        const existingErrors = this.form.querySelectorAll('.error-message');
        existingErrors.forEach(error => error.remove());

        if (!this.emailInput.value.trim()) {
            const errorContainer = document.createElement('div');
            errorContainer.className = 'error-message';
            errorContainer.textContent = 'Email address is required';
            errorContainer.style.display = 'block';
            this.emailInput.parentNode.insertBefore(errorContainer, this.emailInput.nextSibling);
            isValid = false;
        }
        return isValid;
    }
}

/** Form validator for password reset forms with confirmation */
class ResetPasswordForm {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (this.form) {
            this.newPassword = this.form.querySelector('#new_password');
            this.confirmPassword = this.form.querySelector('#pwd_confirm');
            this.submitButton = this.form.querySelector('button[type="submit"]');
            this.errorMessages = {
                new_password: {
                    valueMissing: 'Password is required',
                    patternMismatch: 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character',
                    tooShort: 'Password must be at least 8 characters long'
                },
                pwd_confirm: {
                    valueMissing: 'Please confirm your password',
                    customError: 'Passwords do not match'
                }
            };
            this.initializeValidation();
        }
    }

    initializeValidation() {
        if (!this.newPassword || !this.confirmPassword) return;
        
        const passwordPattern = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]{8,}$';
        this.newPassword.pattern = passwordPattern;
        this.newPassword.minLength = 8;

        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        this.newPassword.addEventListener('input', () => this.validateField(this.newPassword));
        this.confirmPassword.addEventListener('input', () => this.validatePasswordMatch());
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
        const errorContainer = this.getErrorContainer(this.confirmPassword);

        if (!this.confirmPassword.value) {
            this.confirmPassword.setCustomValidity('');
            this.setValid(this.confirmPassword, errorContainer);
        } else if (this.newPassword.value !== this.confirmPassword.value) {
            this.confirmPassword.setCustomValidity('Passwords do not match');
            this.setInvalid(this.confirmPassword, errorContainer);
        } else {
            this.confirmPassword.setCustomValidity('');
            this.setValid(this.confirmPassword, errorContainer);
        }
    }

    getErrorContainer(input) {
        const parentContainer = input.closest('.password__container');
        let errorContainer = parentContainer.nextElementSibling;

        if (!errorContainer || !errorContainer.classList.contains('error-message')) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'error-message';
            errorContainer.setAttribute('aria-live', 'polite');
            parentContainer.parentNode.insertBefore(errorContainer, parentContainer.nextSibling);
        }

        return errorContainer;
    }

    setValid(input, errorContainer) {
        input.setAttribute('aria-invalid', 'false');
        errorContainer.textContent = '';
        errorContainer.style.display = 'none';
        this.submitButton.disabled = false;
    }

    setInvalid(input, errorContainer) {
        input.setAttribute('aria-invalid', 'true');
        const errorMessage = this.getErrorMessage(input);
        errorContainer.textContent = errorMessage;
        errorContainer.style.display = 'block';
        this.submitButton.disabled = true;
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
        let isValid = true;

        this.validateField(this.newPassword);
        this.validatePasswordMatch();

        if (!this.newPassword.validity.valid || !this.confirmPassword.validity.valid) {
            isValid = false;
        }

        if (isValid) {
            this.form.submit();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('resetpwdfrm')) {
        new ResetPasswordForm('resetpwdfrm');
    }
});

export { Modal, Accordion, SignupFormValidator, LoginFormValidator, ResetPasswordValidator, ResetPasswordForm };