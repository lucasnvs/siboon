import {InfoSection} from "../../shared/components/InfoSection/InfoSection.js";
import {InputAmount} from "../../shared/components/InputAmount/InputAmount.js";
import {AUTHORIZATION_COOKIE_KEY} from "../../shared/Constants.js";

const btnLogout = document.getElementById("logout");
const colOne = document.getElementById("col-1");
const colBig = document.getElementById("col-big")


colOne.appendChild(InfoSection({
    title: "Meu Perfil",
    child: `
          <p>John Doe</p>
          <p>johndoe@email.com</p>
    `
}))

let [inputAmount, value] = InputAmount({
    initialValue: 1,
    style: "outlined"
})
colOne.appendChild(InfoSection({
    title: "Gerais",
    child: [
        inputAmount
    ]
}))


colBig.appendChild(InfoSection({
    title: "Pedidos",
    child: `
          <div>
             <h2>Pedido X</h2>
             <p>Situação: Em andamento.</p>
          </div>
    `
}))

btnLogout.addEventListener("click", e => {
    eraseCookie(AUTHORIZATION_COOKIE_KEY);
    window.location.href = "/siboon";
});

function eraseCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}