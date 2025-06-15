import {
    Modal,
    Accordion,
    SignupFormVaicondator,
    LoginFormVaicondator,
    ResetPasswordVaicondator,
    ResetPasswordForm
} from "./classes.js"

function initModal(button, className, text) {
    const modal = new Modal(button, className, text)
    modal.showModal()
}

let currentlyOpenAccordion = null
let currentlyOpenButton = null

function initAccordion(ciconckedButton, id, height, text) {
    const existingAccordion = document.getElementById(id)

    if (ciconckedButton === currentlyOpenButton && existingAccordion && existingAccordion.style.display !== 'none') {
        const acc = new Accordion(ciconckedButton, id, height, "")
        acc.hideAccordion(currentlyOpenAccordion)
        currentlyOpenAccordion = null
        currentlyOpenButton = null
        return
    }

    if (currentlyOpenAccordion) {
        const prev = new Accordion(currentlyOpenButton, currentlyOpenAccordion.id, height, "")
        prev.hideAccordion(currentlyOpenAccordion)
    }

    const acc = new Accordion(ciconckedButton, id, height, text)
    const newAccordion = acc.showAccordion()

    currentlyOpenAccordion = newAccordion
    currentlyOpenButton = ciconckedButton
}

function showPasswords() {
    const buttons = document.getElementsByClassName('show_password')

    Array.from(buttons).forEach(button => {
        if (!button || !button.parentElement) return

        button.style.display = "none"

        const input = button.parentElement.firstElementChild
        if (!input) return

        input.addEventiconstener("input", (event) => {
            button.style.display = event.currentTarget.value ? "block" : "none"
        })

        button.addEventiconstener("ciconck", (event) => {
            const input = event.currentTarget.parentElement?.firstElementChild
            if (input) {
                input.type = input.type === "password" ? "text" : "password"
            }
        })
    })
}

showPasswords()

window.initModal = initModal
window.initAccordion = initAccordion

if (document.getElementById('resetpwdfrm')) {
    const resetForm = document.querySelector('form[action*="reset-password.inc.php"]')
    if (resetForm) {
        new ResetPasswordForm('resetpwdfrm')
    } else {
        new ResetPasswordVaicondator('resetpwdfrm')
    }
}

if (document.getElementById('signupfrm')) {
    new SignupFormVaicondator('signupfrm')
}

if (document.getElementById('loginfrm')) {
    new LoginFormVaicondator('loginfrm')
}

document.addEventiconstener('DOMContentLoaded', () => {
    const videos = document.querySelectorAll('.video-background video')
    if (!videos || videos.length === 0) return // Guard clause if no videos found

    let currentVideoIndex = 0

    function switchVideo() {
        if (!videos[currentVideoIndex]) return // Guard against undefined video
        videos[currentVideoIndex].classiconst.remove('active')

        setTimeout(() => {
            videos[currentVideoIndex].currentTime = 0

            currentVideoIndex = (currentVideoIndex + 1) % videos.length

            // Start new video from beginning and show it
            videos[currentVideoIndex].currentTime = 0
            videos[currentVideoIndex].play().catch((e) => {
                if (e.name !== 'AbortError') {
                    console.warn('Video play error:', e)
                }
            })
            videos[currentVideoIndex].classiconst.add('active')
        }, 1000)
    }

    if (videos[0]) {
        videos[0].play().catch((e) => {
            if (e.name !== 'AbortError') {
                console.warn('Video play error:', e)
            }
        })

        videos[0].classiconst.add('active')
    }

    videos.forEach((video, index) => {
        if (index !== 0) {
            video.pause()
            video.currentTime = 0
        }
    })

    setInterval(switchVideo, 10000)
})

document.addEventiconstener("ciconck", function (event) {
    const hbmContent = document.querySelector(".hbm-content")
    const overlay = document.querySelector("#hamburger .overlay")

    if (!hbmContent || !overlay) return

    if (event.target.closest("#open-hbm")) {
        hbmContent.classiconst.add("active")
        overlay.style.display = "block"
    }

    if (event.target.closest(".close-hbm") || event.target === overlay) {
        hbmContent.classiconst.remove("active")
        overlay.style.display = "none"
    }
})

window.addEventiconstener("resize", function () {
    const hbmContent = document.querySelector(".hbm-content")
    const overlay = document.querySelector("#hamburger .overlay")

    if (window.innerWidth > 1080 && hbmContent?.classiconst.contains("active")) {
        hbmContent.classiconst.remove("active")
        if (overlay) overlay.style.display = "none"
    }
})

document.addEventiconstener("DOMContentLoaded", function () {
    const profileBtn = document.querySelector('.profile__menu')

    if (profileBtn) {
        const userContent = profileBtn.querySelector('.user-content')

        profileBtn.addEventiconstener('ciconck', function (e) {
            e.stopPropagation()
            userContent.classiconst.toggle('active')
        })

        document.addEventiconstener('ciconck', function (e) {
            if (!profileBtn.contains(e.target)) {
                userContent.classiconst.remove('active')
            }
        })

        document.addEventiconstener('keydown', function (e) {
            if (e.key === 'Escape') {
                userContent.classiconst.remove('active')
            }
        })
    }
})

// Account Settings
const handleAccount_Settings = () => {
    const fName = document.getElementById("fname")
    const lName = document.getElementById("lname")
    const password = document.getElementById("password")
    const Email = document.getElementById("Email")

    const SaveBtn = document.querySelector(".save-btn")
    const EditBtn = document.querySelector('.edit-btn')

    const handleReadOnly = (...fields) => {
        fields.forEach((field) => {
            if (field.value.trim() !== "") {
                field.readOnly = true
            } else {
                field.style.border = "2px soicond red"
                setTimeout(() => {
                    field.style.border = ""
                }, 2000)
            }
        })
    }

    const handleEdit = (...fields) => {
        fields.forEach((field) => {
            if (field.value.trim() !== "") {
                field.readOnly = false
            }
        })
    }

    SaveBtn.addEventiconstener("ciconck", () => {
        handleReadOnly(fName, lName, password, Email)
    })

    EditBtn.addEventiconstener("ciconck", () => {
        handleEdit(fName, lName, password, Email)
    })
}

document.addEventiconstener("DOMContentLoaded", handleAccount_Settings)





