import { UserService } from "../../shared/services/UserService.js";
import { CART_CACHE, formatTotalPriceCart, GetBaseURL, USER_CACHE } from "../../shared/Constants.js";
import { ErrorDialog, SuccessDialog } from "../../shared/components/SimpleDialog/SimpleDialog.js";
import { Modal } from "../../shared/components/Modal/Modal.js";
import { OrderService } from "../../shared/services/OrderService.js";

(async () => {
    await Promise.all([loadSummary(), loadUserData(), loadUserSelectAddress()]);
})();

document.getElementById('add-address-button').addEventListener('click', () => {
    const closeModal = Modal({
        title: "Cadastrar novo endereço",
        children: generateAddressForm()
    });
});

document.getElementById("payment-method").addEventListener("change", () => {
    const paymentMethod = document.getElementById("payment-method").value;
    togglePaymentInfo(paymentMethod);
});

// document.getElementById("btn-cep-frete").addEventListener("click", async () => {
//     const cep = document.getElementById("cep-frete").value;
//
//     if (cep) {
//         try {
//             document.getElementById("frete-value").textContent = "R$ 12,43";
//         } catch (error) {
//             console.error("Erro ao calcular frete", error);
//         }
//     } else {
//         alert("Por favor, insira um CEP válido.");
//     }
// });

document.querySelectorAll('.unlock-button').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.previousElementSibling;
        input.disabled = !input.disabled;
        button.innerHTML = input.disabled ? "🔒" : "🔓";
    });
});

document.getElementById("checkout-button").addEventListener("click", finishOrder);

async function loadSummary() {
    try {
        const summary = document.getElementById("summary");
        const cart = CART_CACHE.get();

        if (!cart || cart.length === 0) {
            summary.innerHTML = "<p>O carrinho está vazio</p>";
            return;
        }

        const summaryItems = cart.map(item => `
            <div class="summary-item">
                <img src="${GetBaseURL(item.principal_img)}" alt="${item.name}">
                <div class="item-details">
                    <div class="item-title">${item.name}</div>
                    <div class="item-info">Quantidade: ${item.amount} | Tamanho: ${item.size}</div>
                </div>
                <div class="item-price">${item.formated_price_brl}</div>
            </div>
        `).join('');

        summary.innerHTML = `
            ${summaryItems}
            <div class="summary-item">
                <span>Frete</span>
                <span id="frete-value">R$10,00</span>
            </div>
            <div class="total">
                Total: ${formatTotalPriceCart(cart)}
            </div>
        `;
    } catch (error) {
        console.error("Erro ao carregar o resumo do carrinho", error);
    }
}

async function loadUserData() {
    const [{ data: userData }, isError] = await UserService.getDataById(USER_CACHE.get().id);

    if (isError) {
        ErrorDialog("Erro ao carregar dados do usuário");
        return;
    }

    document.getElementById("user-info").innerHTML = `
        <p style="margin-bottom: 5px;">Nome: ${userData.name}</p>
        <p>Email: ${userData.email}</p>
    `;
}

async function loadUserSelectAddress() {
    const [{ data: addresses }, isError] = await UserService.getUserAddresses(USER_CACHE.get().id);
    const addressSelect = document.getElementById('address-select');
    const addButton = document.getElementById('add-address-button');

    addressSelect.innerHTML = '';

    if (isError) return;

    if (addresses.length > 0) {
        addressSelect.innerHTML = '<option value="" disabled selected>Selecione um endereço</option>';
        addresses.forEach(address => {
            const option = document.createElement('option');
            option.value = address.id;
            option.textContent = `${address.street_avenue}, ${address.number}. ${address.city} - ${address.cep}`;
            addressSelect.appendChild(option);
        });
    } else {
        addButton.style.display = 'block';
        addressSelect.innerHTML = '<option value="" disabled selected>Nenhum endereço cadastrado</option>';
    }
}

function generateAddressForm() {
    return `
        ${generateFormGroup('address', 'Endereço')}
        ${generateFormGroup('number', 'Número')}
        ${generateFormGroup('complement', 'Complemento', true)}
        ${generateFormGroup('neighborhood', 'Bairro')}
        ${generateFormGroup('city', 'Cidade')}
        ${generateFormGroup('state', 'Estado')}
        ${generateFormGroup('zip', 'CEP')}
        <button class="btn">Cadastrar Endereço</button>
    `;
}

function generateFormGroup(id, label, optional = false) {
    const placeholder = optional ? 'Digite seu complemento (opcional)' : `Digite seu ${label.toLowerCase()}`;
    return `
        <div class="form-group">
            <label for="${id}">${label}</label>
            <div class="input-container">
                <input type="text" id="${id}" name="${id}" placeholder="${placeholder}">
                <button class="unlock-button">🔒</button>
            </div>
        </div>
    `;
}
function togglePaymentInfo(paymentMethod) {
    document.getElementById("credit-card-info").style.display = (paymentMethod === "credit-card") ? "block" : "none";
    document.getElementById("pix-info").style.display = (paymentMethod === "pix") ? "block" : "none";
    document.getElementById("boleto-info").style.display = (paymentMethod === "boleto") ? "block" : "none";
}

async function finishOrder() {
    const addressSelect = document.getElementById("address-select");
    const orderData = CART_CACHE.get().map(item => ({ amount: item.amount, id: item.id }));
    console.log(addressSelect.value, orderData)
    const [responseOrder, isError] = await OrderService.sendData(addressSelect.value, orderData);

    if (isError) {
        ErrorDialog(responseOrder.message);
        return;
    }

    SuccessDialog(responseOrder.message);
}