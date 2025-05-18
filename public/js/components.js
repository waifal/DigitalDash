const loadComponents = (componentName, targetId) => {
    const xhr = new XMLHttpRequest();

    // Load the components
    xhr.onload = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById(targetId).innerHTML = xhr.responseText;
            addCurrentYearToFooter();
        }
    }

    /**
     * If any changes have been made to the components 
     * files ensure that you copy and paste the code 
     * into the relative 'fallback' code.
     */

    xhr.onerror = function () {
        function fallbackNavigation() {
            const fallbackHTML = `
                <div>
                    <a href="#"><img src="assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
                </div>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="digital-walks.html">Digital Walks</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <div>
                    <a href="php/pages/signup.php" class="primary-btn">Sign up</a>
                    <button type="button"><i class="fa-solid fa-moon"></i></button>
                </div>
            `;

            document.getElementById('nav').innerHTML = fallbackHTML;
        }

        function fallbackFooter() {
            const fallbackHTML = `
                <div class="footer-content">
                    <!-- Logo -->
                    <div class="flex-1">
                        <a href="index.html">
                            <img src="assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo">
                        </a>
                    </div>
                    <!-- Links -->
                    <div class="footer-grid">
                        <div>
                            <strong>Explore</strong>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="digital-walks.html">Digital Walks</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="about.html">About</a></li>
                            </ul>
                        </div>
                        <div>
                            <strong>Trails</strong>
                            <ul>
                                <li><a href="#">Bush Walks</a></li>
                                <li><a href="#">Lake Walks</a></li>
                                <li><a href="#">Mountain Trails</a></li>
                            </ul>
                        </div>
                        <div>
                            <strong>Account</strong>
                            <ul>
                                <li><a href="php/pages/signup.php">Sign Up</a></li>
                                <li><a href="php/pages/login.php">Login</a></li>
                            </ul>
                        </div>
                        <div>
                            <strong>Follow Us</strong>
                            <div class="social-links">
                                <a href="https://www.youtube.com/@DigitalDashNZ" target="_blank"><i class="bi bi-youtube"></i></a>
                                <a href="https://www.instagram.com/digitaldashnz/" target="_blank"><i class="bi bi-instagram"></i></a>
                                <a href="https://x.com/DigitalDashNZ" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="footer-bottom">
                    <div class="copyright">
                        <small>
                            &copy; <time datetime="2025">2025</time> DigitalDash. All Rights Reserved.
                        </small>
                    </div>
                    <div class="footer-links">
                        <a href="php/pages/privacy-policy.php"><small>Privacy Policy</small></a>
                        <span></span>
                        <a href="php/pages/terms-and-conditions.php"><small>Terms &amp; Conditions</small></a>
                    </div>
                </div>
            `;

            document.getElementById('footer').innerHTML = fallbackHTML;
        }

        fallbackNavigation();
        fallbackFooter();
    }

    // Dynamically add the current year to the footer
    function addCurrentYearToFooter() {
        const footer = document.getElementById('footer');
        const time = footer.querySelector('time');

        if (footer && time) {
            const currentYear = new Date().getFullYear();

            time.textContent = currentYear;
            time.setAttribute('datetime', currentYear);
        }
    }

    xhr.open('GET', `components/${componentName}.html`, true);
    xhr.send(null);
}

loadComponents('nav', 'nav');
loadComponents('footer', 'footer');






const handleAccount_Settings = () => {

    const fName = document.getElementById("fname");
    const lName = document.getElementById("lname");
    const password = document.getElementById("password");
    const Email = document.getElementById("Email");

    const SaveBtn = document.querySelector(".save-btn");
    const EditBtn = document.querySelector('.edit-btn');

    const handleReadOnly = (...fields) => {
        fields.forEach((field) => {

            if (field.value.trim() !== "") {
                field.readOnly = true
            }
            else {
                field.style.border = "2px solid red";
                setTimeout(() => {
                    field.style.border = ""
                }, 2000)
            }
        })
    }

    const handleEdit = (...fields) => {
        fields.forEach((field) => {

            if (field.value.trim() !== "") {
                field.readOnly = false;
            }

        })
    }

    SaveBtn.addEventListener("click", () => {
        handleReadOnly(fName, lName, password, Email)
    })

    EditBtn.addEventListener("click", () => {
        handleEdit(fName, lName, password, Email)
    })
}

document.addEventListener("DOMContentLoaded", handleAccount_Settings)


const updatecopyrightYearly = () => {
    const d = new Date();
    let year = d.getFullYear();
    const text = document.querySelector(".flex-1 p");
    text.textContent = `© ${year} DigitalDash`
}


updatecopyrightYearly()
