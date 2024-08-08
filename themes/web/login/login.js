import {UserService} from "../../shared/services/UserService.js";
import {Validate, Validators} from "../../shared/Validate.js";

async function login(email, password) {
    let res = await UserService.login(
        email, password
    );

    if(!res.ok) {
        return res;
    }

    window.location.href = "app/perfil";
}

const loginEmail = document.getElementById("email-login");
const loginPassword = document.getElementById("password-login");
const loginSubmit = document.getElementById("submit-login");

loginSubmit.onclick = async () => {

    console.log(Validate.validate(loginEmail, [Validators.required]))
    if(
        !Validate.validate(loginEmail, [Validators.required]) ||
        !Validate.validate(loginPassword, [Validators.required])
    ) return;


    let errorBody = await login(
        loginEmail.value,
        loginPassword.value
    );

    if(errorBody) {
        document.getElementById("login-error-message").innerHTML = errorBody.message;
    } else {
        document.getElementById("login-error-message").innerHTML = "";
    }
}

const signupName = document.getElementById("name-signup");
const signupLastName = document.getElementById("lastname-signup");
const signupEmail = document.getElementById("email-signup");
const signupPassword = document.getElementById("password-signup");
const signupPasswordConfirm = document.getElementById("password-confirm-signup");

const signupSubmit = document.getElementById("submit-signup");

signupSubmit.onclick = async () => {
    if(
        !Validate.validate(signupName, [Validators.required]) ||
        !Validate.validate(signupLastName, [Validators.required]) ||
        !Validate.validate(signupEmail, [Validators.email, Validators.required]) ||
        !Validate.validateConfirmPassword(signupPassword, signupPasswordConfirm, [Validators.required, Validators.password])
    ) return;

    let res = await UserService.sendData(
        signupName.value,
        signupLastName.value,
        signupEmail.value,
        signupPassword.value
    );

    if(!res.ok) {
        alert(res.message);
        return;
    }

    await login(
        signupEmail.value,
        signupPassword.value
    )
}