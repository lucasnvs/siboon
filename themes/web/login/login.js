import {URL_BASE_API} from "../../shared/Constants.js";

const formSignup = document.getElementById("signup");
const formLogin = document.getElementById("login");

formSignup.addEventListener("submit",async (e) => {
    e.preventDefault();

    let formDataSignup= new FormData(formSignup);
    let confirmPassword = formDataSignup.get("confirm_password");
    formDataSignup.delete("confirm_password");

    if(formDataSignup.get("password") !== confirmPassword) {
        console.error("Senhas não batem.");
        return
    }

    await signup(formDataSignup);

    e.target.reset();
})

formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formDataLogin = new FormData(formLogin);
    let res = await login(formDataLogin);

    let types = {
        error: false,
        success: true,
    }
    if(types[res.type]) {
        document.getElementById("login-error-message").innerHTML = res.message;
    } else {
        console.log(res.message);
    }

    e.target.reset();
})

async function login(body) {
    let res = await fetch(URL_BASE_API+"/usuarios/login", {
        method: "POST",
        body: body
    });
    return await res.json();
}

async function signup(body) {
    let res = await fetch(URL_BASE_API+"/usuarios", {
        method: "POST",
        body: body
    });
    if(!res.ok) throw await res.text();
}