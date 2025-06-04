const loadComponents = (componentName, targetId) => {
    const xhr = new XMLHttpRequest();

    // Load the components
    xhr.onload = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById(targetId).innerHTML = xhr.responseText;
            addCurrentYearToFooter();
        }
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

loadComponents('footer', 'footer');