function changeForm(number) {
    var divs = document.getElementsByClassName('form');
    if (number == 0) {

        divs[0].classList.add('form-style');
        divs[0].classList.remove('hidden');

        divs[1].classList.add('hidden');
        divs[1].classList.remove('form-style');
    } else if (number == 1) {

        divs[1].classList.add('form-style');
        divs[1].classList.remove('hidden');

        divs[0].classList.add('hidden');
        divs[0].classList.remove('form-style');
    }
}

const loginSubmit = document.getElementById('login-submit');

if (loginSubmit) {
    loginSubmit.addEventListener('click', (e) => {
        const email = document.getElementById('loginEmail');
        const pass = document.getElementById('loginPass');
        const error = document.getElementById('log-error');
        let message = "";

        message = validateLoginForm(email, pass);

        if (message.length > 0) {
            e.preventDefault();
            document.getElementById('msg').textContent = message;
            error.classList.remove('hidden');
        }
    });
}

function validateLoginForm(email, pass) {
    if (email.value === "" && pass.value === "")
        return "Please fill in all the data";
    else if (email.value === "" || email == null)
        return "Email is required";
    else if (!validateEmail(email))
        return "Email-i is not vaild";
    else if (pass.value === "" || pass == null)
        return "Password is required";
}


function onlyLetters(string) {
    const regex = /^[A-Za-z]{2,}$/;
    return string.value.match(regex);
}

function validateEmail(email) {
    const regex = /^[\w-\.]+@([\w-]+)+.[\w-]{2,4}$/;
    return email.value.match(regex);
}

function validatePassword(pass) {
    const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    return pw.value.match(regex);
}


const sendMessageBtn = document.getElementById('sendIt');

if (sendMessageBtn) {
    sendMessageBtn.addEventListener('click', (e) => {
        const emri = document.getElementById('nameC');
        const mbiemri = document.getElementById('lastnameC');
        const email = document.getElementById('emailC');
        const msg = document.getElementById('messageC');
        const error = document.getElementById('log-error');
        let message = "";

        message = validateContactForm(emri, mbiemri, email, msg);

        if (message.length > 0) {
            e.preventDefault();
            document.getElementById('msg').textContent = message;
            error.classList.remove('hidden');
        }
    });
}

function validateContactForm(emri, mbiemri, email, msg) {
    if (emri.value === "" && mbiemri.value === "" && email.value === "" && msg.value === "")
        return "Please fill in all the data";
    else if (emri.value === "" || emri == null)
        return "Name is required";
    else if (!onlyLetters(emri))
        return "Name should only contain letters";
    else if (mbiemri.value === "" || mbiemri == null)
        return "Lastname is required";
    else if (!onlyLetters(mbiemri))
        return "Lastname should only contain letters";
    else if (email.value === "" || email == null)
        return "Email is required";
    else if (!validateEmail(email))
        return "Email is not vaild";
    else if (msg.value === "" || msg == null)
        return "PLease type in your message";
}

function validate(number) {
    var inputList = document.getElementsByClassName("input");
    if (number == 0) {
        if (inputList[0].value == "" || inputList[1].value == "") {
            alert("Please fill in all the data!")
        }
    }
}

const submitbtn = document.getElementById('submit-btn');

if (submitbtn) {
    submitbtn.addEventListener('click', (e) => {
        const name = document.getElementById('username');
        const lname = document.getElementById('userlastname');
        const email = document.getElementById('reg-email');
        const pw = document.getElementById('reg-pw');
        const confpw = document.getElementById('conf-pw');
        const error = document.getElementById('log-error');
        let message = "";

        message = validateRegForm(name, lname, email, pw, confpw);

        if (message.length > 0) {
            e.preventDefault();
            document.getElementById('msg').textContent = message;
            error.classList.remove('hidden');
        }
    });
}

function validateRegForm(name, lname, email, pw, confpw) {
    if (name.value === "" && lname.value === "" && email.value === "" && pw.value === "" &&
        confpw.value === "")
        return "Please fill in all the data";
    else if (name.value === "" || name.value == null) {
        return "Name is required";
    } else if (!onlyLetters(name)) {
        return "Name should only contain letters (min 2)";
    } else if (lname.value === "" || lname == null) {
        return "Lastname is required";
    } else if (!onlyLetters(lname)) {
        return "Lastname should only contain letters (min 2)";
    } else if (email.value === "" || email == null) {
        return 'Email is required';
    } else if (!validateEmail(email)) {
        return 'Email is not valid';
    } else if (pw.value === "" || pw == null) {
        return 'Password is required';
    } else if (!validatePassword(pw)) {
        return 'Password should have minimum eight characters, at least one letter and one number';
    } else if (confpw.value === "" || pw.value !== confpw.value) {
        return 'Make sure that they are the same';
    }
}

var navLinks = document.getElementById("links")

function showMenu() {
    navLinks.style.right = "0";
}

function hideMenu() {
    navLinks.style.right = "-200px";
}