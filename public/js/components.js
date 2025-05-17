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
            const fallbackHTML = ``;

            document.getElementById('nav').innerHTML = fallbackHTML;
        }

        function fallbackFooter() {
            const fallbackHTML = ``;

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





const handleAccount_Settings = ()=> {
    const fName = document.getElementById("fname");
    const lName = document.getElementById("lname");
    const password = document.getElementById("password");
    const Email  = document.getElementById("Email");

    const SaveBtn  = document.querySelector(".save-btn");
    const EditBtn = document.querySelector('.edit-btn')
    const handleReadOnly = (...fields)=> {
        fields.forEach((field)=> {
          
            if(field.value.trim() !== "") {
                    field.readOnly = true
            }
            else{
                    field.style.border = "2px solid red";
                    setTimeout(()=> {
                         field.style.border = ""
                    },2000)
            }
        })
    }
    const handleEdit = (...fields)=> {
        fields.forEach((field)=> {
          
            if(field.value.trim() !== "") {
                    field.readOnly = false;
            }
            
        })
    }


   


    SaveBtn.addEventListener("click", ()=> {
                 handleReadOnly(fName,lName, password, Email)
    })

   EditBtn.addEventListener("click", ()=> {
    handleEdit(fName,lName, password, Email)
   })
}




document.addEventListener("DOMContentLoaded", handleAccount_Settings)


const updatecopyrightYearly = ()=> {
    const d = new Date();
    let year = d.getFullYear();
    const text = document.querySelector(".flex-1 p");
    text.textContent = `© ${year} DigitalDash`
}


updatecopyrightYearly()
