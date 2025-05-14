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
function initModal(button, text) {
    const modal = new Modal(button, text);
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

// Initialize form validators based on form presence
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


// Initialize walk preview functionality
document.addEventListener('DOMContentLoaded', () => {
    const previewButtons = document.querySelectorAll('.previews__container .preview');
    const descriptionDiv = document.querySelector('.recommended__section .description');
    const contentDiv = document.querySelector('.recommended__section .content');

    // Load default walk (walk_one)
    loadWalkContent('walk_one');

    previewButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const walkNumber = index + 1;
            const walkFile = `walk_${getNumberWord(walkNumber)}`;
            loadWalkContent(walkFile);
        });
    });
});

function getNumberWord(num) {
    const numbers = ['one', 'two', 'three'];
    return numbers[num - 1];
}

function loadWalkContent(walkFile) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `components/recommended_walks/${walkFile}.html`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(xhr.responseText, 'text/html');
            
            const description = document.querySelector('.recommended__section .description');
            const content = document.querySelector('.recommended__section .content');
            const recommendedSection = document.querySelector('.recommended__section');

            if (description && content) {
                description.innerHTML = doc.querySelector('.description').innerHTML;
                content.innerHTML = doc.querySelector('.content').innerHTML;
                
                // Remove any existing walk classes
                recommendedSection.classList.remove('walk-one', 'walk-two', 'walk-three');
                // Add the new walk class
                recommendedSection.classList.add(walkFile.replace('_', '-'));
            }
        }
    };

    xhr.send();
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
    
    // Pause all other videos initially
    videos.forEach((video, index) => {
        if (index !== 0) {
            video.pause();
            video.currentTime = 0;
        }
    });

    // Switch video every 10 seconds
    setInterval(switchVideo, 10000);
});


// 5 Second Video Preview