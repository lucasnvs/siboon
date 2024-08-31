import {UserService} from "../../shared/services/UserService.js";
import {Validate, Validators} from "../../shared/Validate.js";
import {USER_CACHE_KEY} from "../../shared/Constants.js";

async function login(email, password) {
    let [res, isError] = await UserService.login(
        email, password
    );

    if(isError) {
        return res;
    }

    localStorage.set(USER_CACHE_KEY, res.data);

    window.location.href = "app/perfil";
}

const loginEmail = document.getElementById("email-login");
const loginPassword = document.getElementById("password-login");
const loginSubmit = document.getElementById("submit-login");

loginSubmit.onclick = async () => {

    const isValidLogin = Validate.validate(loginEmail, [Validators.required]) && Validate.validate(loginPassword, [Validators.required])
    if(!isValidLogin) return;

    let errorBody = await login(
        loginEmail.value,
        loginPassword.value
    );

    const loginErrorMessage = document.getElementById("login-error-message");
    if(errorBody) {
        loginErrorMessage.hidden = false;
        loginErrorMessage.innerHTML = errorBody.message;
    } else {
        loginErrorMessage.hidden = true;
        loginErrorMessage.innerHTML = "";
    }
}

const signupName = document.getElementById("name-signup");
const signupLastName = document.getElementById("lastname-signup");
const signupEmail = document.getElementById("email-signup");
const signupPassword = document.getElementById("password-signup");
const signupPasswordConfirm = document.getElementById("password-confirm-signup");

const signupSubmit = document.getElementById("submit-signup");

signupSubmit.onclick = async () => {

    const isValidValues =
        Validate.validate(signupName, [Validators.required]) &&
        Validate.validate(signupLastName, [Validators.required]) &&
        Validate.validate(signupEmail, [Validators.email, Validators.required]) &&
        Validate.validateConfirmPassword(signupPassword, signupPasswordConfirm, [Validators.required, Validators.password])

    if(!isValidValues) return;

    let [res, isError] = await UserService.sendData(
        signupName.value,
        signupLastName.value,
        signupEmail.value,
        signupPassword.value
    );

    if(isError) {
        alert(res.message);
        return;
    }

    await login(
        signupEmail.value,
        signupPassword.value
    )
}