import {getAuthorization, URL_BASE_API} from "../../shared/Constants.js";

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
})

formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formDataLogin = new FormData(formLogin);
    await login(formDataLogin);

    console.log(getAuthorization())
})

async function login(body) {
    let res = await fetch(URL_BASE_API+"/usuarios/login", {
        method: "POST",
        body: body
    });
    if(!res.ok) throw res;
    let responseBody = await res.json();

    localStorage.setItem("authorization", responseBody.data.token);
}

async function signup() {
    let res = await fetch(URL_BASE_API+"/usuarios", {
        method: "POST",
        body: body
    });
    if(!res.ok) throw res;
}