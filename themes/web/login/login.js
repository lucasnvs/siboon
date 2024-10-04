import { UserService } from "../../shared/services/UserService.js";
import { Validate, Validators } from "../../shared/Validate.js";
import { USER_CACHE } from "../../shared/Constants.js";

async function login(email, password) {
    const [res, isError] = await UserService.login(email, password);

    if (isError) {
        return res;
    }

    USER_CACHE.set(res.data);
    window.location.href = "app/perfil";
}

const loginElements = {
    email: document.getElementById("email-login"),
    password: document.getElementById("password-login"),
    submit: document.getElementById("submit-login"),
    errorMessage: document.getElementById("login-error-message"),
};

loginElements.submit.onclick = async () => {
    const isValidLogin = Validate.validate(loginElements.email, [Validators.required]) &&
        Validate.validate(loginElements.password, [Validators.required]);

    if (!isValidLogin) return;

    const errorBody = await login(loginElements.email.value, loginElements.password.value);

    if (errorBody) {
        loginElements.errorMessage.hidden = false;
        loginElements.errorMessage.innerHTML = errorBody.message;
    } else {
        loginElements.errorMessage.hidden = true;
        loginElements.errorMessage.innerHTML = "";
    }
};

const signupElements = {
    name: document.getElementById("name-signup"),
    lastName: document.getElementById("lastname-signup"),
    email: document.getElementById("email-signup"),
    password: document.getElementById("password-signup"),
    passwordConfirm: document.getElementById("password-confirm-signup"),
    submit: document.getElementById("submit-signup"),
};

signupElements.submit.onclick = async () => {
    const isValidValues =
        Validate.validate(signupElements.name, [Validators.required]) &&
        Validate.validate(signupElements.lastName, [Validators.required]) &&
        Validate.validate(signupElements.email, [Validators.email, Validators.required]) &&
        Validate.validateConfirmPassword(signupElements.password, signupElements.passwordConfirm, [Validators.required, Validators.password]);

    if (!isValidValues) return;

    const [res, isError] = await UserService.sendData(
        signupElements.name.value,
        signupElements.lastName.value,
        signupElements.email.value,
        signupElements.password.value
    );

    if (isError) {
        alert(res.message);
        return;
    }

    await login(signupElements.email.value, signupElements.password.value);
};
