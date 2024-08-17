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

const cardInfo = document.getElementById("card-info");

cardInfo.append(
    InfoSection({
        title: "Email",
        child: ContainerInput({
            label:"Seu email"
        })
    })
)

cardInfo.append(
    InfoSection({
        title: "Dados Pessoais",
        child: [
            ContainerInput({
                label: "Nome"
            }),
            ContainerInput({
                label: "Sobrenome"
            }),
            ContainerInput({
                label: "CPF"
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