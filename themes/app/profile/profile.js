import {InfoSection} from "../../shared/components/InfoSection/InfoSection.js";
import {InputAmount} from "../../shared/components/InputAmount/InputAmount.js";
import {AUTHORIZATION_COOKIE_KEY, GetBaseURL, USER_CACHE} from "../../shared/Constants.js";
import {UserService} from "../../shared/services/UserService.js";

const btnLogout = document.getElementById("logout");
const colOne = document.getElementById("col-1");
const colBig = document.getElementById("col-big");

(async () => {
    const [data, isError] = await UserService.getDataById(USER_CACHE.get().id);
    console.log(data)
})()

colOne.appendChild(InfoSection({
    title: "Meu Perfil",
    child: `
          <div id="user-detail">
                <div class="user-label">
                    <img src=${GetBaseURL()}>
                    <div>
                        <p>John Doe</p>
                        <p>johndoe@email.com</p>
                    </div>
              </div>
                <button class="btn">Editar</button>
          </div>
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