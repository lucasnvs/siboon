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

    let action = formSignup.attributes.getNamedItem("data-action").value;
    let options = {
        method: "post",
        body: formDataSignup
    }

    let response = await fetch(action, options).then(res => res.json());
    console.log(response);
})

formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formDataLogin = new FormData(formLogin);
    let action = formLogin.attributes.getNamedItem("data-action").value;
    let options = {
        method: "post",
        body: formDataLogin
    }

    let response = await fetch(action, options).then(res => res.json());
    console.log(response);
})