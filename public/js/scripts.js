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
function initModal(button, className, text) {
    const modal = new Modal(button, className, text);
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

/**
 * Handles background video switching for the hero section.
 *
 * - Cycles through all videos in the .video-background container every 10 seconds.
 * - Ensures only one video is active and playing at a time.
 * - Adds the 'active' class to the currently visible video.
 * - Handles initial play and resets other videos to the start.
 * - Catches play() promise rejections to avoid uncaught errors from browser power-saving features.
 */

document.addEventListener('DOMContentLoaded', () => {
    const videos = document.querySelectorAll('.video-background video');
    if (!videos || videos.length === 0) return; // Guard clause if no videos found

    let currentVideoIndex = 0;

    function switchVideo() {
        if (!videos[currentVideoIndex]) return; // Guard against undefined video
        videos[currentVideoIndex].classList.remove('active');

        setTimeout(() => {
            videos[currentVideoIndex].currentTime = 0;

            currentVideoIndex = (currentVideoIndex + 1) % videos.length;

            // Start new video from beginning and show it
            videos[currentVideoIndex].currentTime = 0;
            videos[currentVideoIndex].play().catch((e) => {
                if (e.name !== 'AbortError') {
                    console.warn('Video play error:', e);
                }
            });
            videos[currentVideoIndex].classList.add('active');
        }, 1000);
    }

    if (videos[0]) {
        videos[0].play().catch((e) => {
            if (e.name !== 'AbortError') {
                console.warn('Video play error:', e);
            }
        });

        videos[0].classList.add('active');
    }

    videos.forEach((video, index) => {
        if (index !== 0) {
            video.pause();
            video.currentTime = 0;
        }
    });

    setInterval(switchVideo, 10000);
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.video__section-content').forEach(section => {
        const cards = section.querySelector('.cards');
        const leftBtn = section.querySelector('.arrow__container:first-child button');
        const rightBtn = section.querySelector('.arrow__container:last-child button');
        if (!cards || !leftBtn || !rightBtn) return;

        const card = cards.querySelector('div');
        const cardWidth = card ? card.offsetWidth : 280;
        const gap = parseInt(getComputedStyle(cards).gap) || 16;
        const scrollAmount = cardWidth + gap;

        function updateButtons() {
            if (cards.scrollLeft <= 0) {
                leftBtn.style.visibility = 'hidden';
            } else {
                leftBtn.style.visibility = 'visible';
            }
            if (cards.scrollLeft + cards.clientWidth >= cards.scrollWidth - 1) {
                rightBtn.style.visibility = 'hidden';
            } else {
                rightBtn.style.visibility = 'visible';
            }
        }

        let isScrolling;
        cards.addEventListener('scroll', function () {
            updateButtons();
            window.clearTimeout(isScrolling);
            isScrolling = setTimeout(function () {
                const maxScroll = cards.scrollWidth - cards.clientWidth;
                if (cards.scrollLeft >= maxScroll - 1) {
                    cards.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    let index = Math.round(cards.scrollLeft / scrollAmount);
                    let target = index * scrollAmount;
                    cards.scrollTo({ left: target, behavior: 'smooth' });
                }
            }, 100);
        });

        leftBtn.addEventListener('click', () => {
            const index = Math.round(cards.scrollLeft / scrollAmount);
            cards.scrollTo({ left: (index - 1) * scrollAmount, behavior: 'smooth' });
        });
        rightBtn.addEventListener('click', () => {
            const maxScroll = cards.scrollWidth - cards.clientWidth;
            if (cards.scrollLeft >= maxScroll - 1) {
                cards.scrollTo({ left: maxScroll, behavior: 'smooth' });
                return;
            }
            const index = Math.round(cards.scrollLeft / scrollAmount);
            const nextScroll = (index + 1) * scrollAmount;
            if (nextScroll >= maxScroll - 1) {
                cards.scrollTo({ left: maxScroll, behavior: 'smooth' });
            } else {
                cards.scrollTo({ left: nextScroll, behavior: 'smooth' });
            }
        });

        let isDown = false;
        let startX;
        let scrollLeftStart;

        cards.addEventListener('mousedown', (e) => {
            isDown = true;
            cards.classList.add('dragging');
            startX = e.pageX - cards.getBoundingClientRect().left;
            scrollLeftStart = cards.scrollLeft;
            e.preventDefault();
        });
        cards.addEventListener('mouseleave', () => {
            isDown = false;
            cards.classList.remove('dragging');
        });
        cards.addEventListener('mouseup', () => {
            isDown = false;
            cards.classList.remove('dragging');
        });
        cards.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            const x = e.pageX - cards.getBoundingClientRect().left;
            const walk = (startX - x);
            cards.scrollLeft = scrollLeftStart + walk;
        });

        updateButtons();
        window.addEventListener('resize', updateButtons);
    });
});


/**
 * 
 * THEME SWITCHER SCRIPT
 * 
 

const button = document.getElementById("theme-switcher");

if(button) {
    button.addEventListener("click", (event) => {
    });
}
*/
function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}