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

/**
 * 
 * Hamburger Menu
 * 
 */
document.addEventListener("click", function (event) {
    const hbmContent = document.querySelector(".hbm-content");
    const overlay = document.querySelector("#hamburger .overlay");

    if (!hbmContent || !overlay) return;

    if (event.target.closest("#open-hbm")) {
        hbmContent.classList.add("active");
        overlay.style.display = "block";
    }

    if (event.target.closest(".close-hbm") || event.target === overlay) {
        hbmContent.classList.remove("active");
        overlay.style.display = "none";
    }
});

window.addEventListener("resize", function () {
    const hbmContent = document.querySelector(".hbm-content");
    const overlay = document.querySelector("#hamburger .overlay");

    if (window.innerWidth > 1080 && hbmContent?.classList.contains("active")) {
        hbmContent.classList.remove("active");
        if (overlay) overlay.style.display = "none";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const profileBtn = document.querySelector('.profile__menu');
    const userContent = profileBtn.querySelector('.user-content');

    profileBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        userContent.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        if (!profileBtn.contains(e.target)) {
            userContent.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            userContent.classList.remove('active');
        }
    });
});

/**
 * 
 * THEME SWITCHER SCRIPT
 * 
*/

document.addEventListener("DOMContentLoaded", () => {

    const button = document.getElementById("theme-switcher");
    let Li = document.querySelector(".bi")
    let logo = document.querySelector(".logo-img");
     let root = document.querySelector(":root");

    button.addEventListener("click", (event) => {
        console.log("Theme switcher has been clicked!");
                root.classList.toggle("light")
        if (Li.classList.contains("bi-brightness-low-fill")) {
            Li.classList.remove("bi-brightness-low-fill")
            Li.classList.add( "bi-moon-stars-fill")
         
             logo.src = " assets/images/logo/logo_black_white.webp";
             
        } 
        else {
              Li.classList.remove("bi-moon-stars-fill")
            Li.classList.add( "bi-brightness-low-fill")
              logo.src = " assets/images/logo/logo_color_transparent_png.png";
    
             
        }
    })
});

    function changeTheme() {
        const switchThemeBtn = document.getElementById("theme-switcher");

        switchThemeBtn.addEventListener("click", () => {
            console.log("Theme switcher has been clicked!");
        });
    }

    changeTheme();
