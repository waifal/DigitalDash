import { 
    Modal, 
    Accordion, 
    SignupFormValidator, 
    LoginFormValidator,
    ResetPasswordValidator,
    ResetPasswordForm
} from "./classes.js";

/**
 * Creates and displays a modal dialog
 * @param {HTMLElement} button - Trigger button
 * @param {string} text - Modal content
 */
function initModal(button, className, appendEl, text) {
    const modal = new Modal(button, className, appendEl, text);
    modal.showModal();
}

let currentlyOpenAccordion = null;
let currentlyOpenButton = null;

/**
 * Handles accordion functionality with single open state
 * @param {HTMLElement} clickedButton - Button that triggered the accordion
 * @param {string} id - Unique accordion identifier
 * @param {boolean} height - Enable height animation
 * @param {string} text - Accordion content
 */
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

/**
 * Initializes password visibility toggle functionality
 * Adds event listeners to show/hide password buttons
 */
function showPasswords() {
    const buttons = document.getElementsByClassName('show_password');

    Array.from(buttons).forEach(button => {
        if (!button || !button.parentElement) return;
        
        button.style.display = "none";

        const input = button.parentElement.firstElementChild;
        if (!input) return;

        input.addEventListener("input", (event) => {
            button.style.display = event.currentTarget.value ? "block" : "none";
        });

        button.addEventListener("click", (event) => {
            const input = event.currentTarget.parentElement?.firstElementChild;
            if (input) {
                input.type = input.type === "password" ? "text" : "password";
            }
        });
    });
}

showPasswords();

window.initModal = initModal;
window.initAccordion = initAccordion;

if (document.getElementById('resetpwdfrm')) {
    const resetForm = document.querySelector('form[action*="reset-password.inc.php"]');
    if (resetForm) {
        new ResetPasswordForm('resetpwdfrm');
    } else {
        new ResetPasswordValidator('resetpwdfrm');
    }
}

if (document.getElementById('signupfrm')) {
    new SignupFormValidator('signupfrm');
}

if (document.getElementById('loginfrm')) {
    new LoginFormValidator('loginfrm');
}

document.addEventListener('DOMContentLoaded', () => {
    const videos = document.querySelectorAll('.video-background video');
    let currentVideoIndex = 0;

    function switchVideo() {
        // videos[currentVideoIndex].pause();
        videos[currentVideoIndex].classList.remove('active');
        
        setTimeout(() => {
            videos[currentVideoIndex].currentTime = 0;
            
            currentVideoIndex = (currentVideoIndex + 1) % videos.length;
            
            // Start new video from beginning and show it
            videos[currentVideoIndex].currentTime = 0;
            videos[currentVideoIndex].play();
            videos[currentVideoIndex].classList.add('active');
        }, 1000);
    }

    videos[0].play();
    videos[0].classList.add('active');
    
    videos.forEach((video, index) => {
        if (index !== 0) {
            video.pause();
            video.currentTime = 0;
        }
    });

    setInterval(switchVideo, 10000);
});


// 5 Second Video Preview