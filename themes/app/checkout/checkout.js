// import {sumCartTotalFormat} from "../../shared/Constants.js";
//
// let carrinho = localStorage.get("cart");
//
// document.body.innerHTML +=`<h1>${sumCartTotalFormat(carrinho)}</h1><br>`;
// carrinho.forEach(item => {
//     document.body.innerHTML += item.name+" - Quantidade: "+item.amount + "<br>"
// })

import {InfoSection} from "../../shared/components/InfoSection/InfoSection.js";
import {ContainerInput} from "../../shared/components/ContainerInput/ContainerInput.js";
import {UserService} from "../../shared/services/UserService.js";
import {USER_CACHE} from "../../shared/Constants.js";

(async () => {
    let [{data: userData}, isError] = await UserService.getDataById(USER_CACHE.get().id);

    const [name, last_name] = userData.name.split(" ");
    console.log(userData)

    const cardInfo = document.getElementById("card-info");

    cardInfo.append(
        InfoSection({
            title: "Email",
            child: ContainerInput({
                label:"Seu email",
                value: userData.email ?? "",
                isDisabled: true
            })
        })
    )

    cardInfo.append(
        InfoSection({
            title: "Dados Pessoais",
            child: [
                ContainerInput({
                    label: "Nome",
                    value: name ?? "John",
                    isDisabled: true,
                }),
                ContainerInput({
                    label: "Sobrenome",
                    value: last_name ?? "Doe",
                    isDisabled: true
                }),
                ContainerInput({
                    label: "CPF",
                    value: userData.cpf ?? "23435454533",
                    isDisabled: true
                })
            ]
        })
    )

    cardInfo.append(
        InfoSection({
            title: "Entrega",
            child: [
                ContainerInput({
                    label: "CEP"
                }),
                ContainerInput({
                    label: "Rua/Avenida"
                }),
                ContainerInput({
                    label: "Número"
                }),
                ContainerInput({
                    label: "Bairro"
                }),
                ContainerInput({
                    label: "Complemento"
                }),
                ContainerInput({
                    label: "Cidade"
                }),
                ContainerInput({
                    label: "Estado"
                }),
                `<p>Tipo de Entrega:</p><br>
                <button class="btn">PAC</button>
                <button class="btn">SEDEX</button>`
            ]
        })
    )

    cardInfo.append(
        InfoSection({
            title: "Pagamento",
            child: `
            <button class="btn">PIX</button>
            <button class="btn">Boleto</button>
            <button class="btn">Cartão</button>
        `
        })
    )

    cardInfo.insertAdjacentHTML("beforeend", `
            <button class="btn">Finalizar Compra</button>
    `)
})()