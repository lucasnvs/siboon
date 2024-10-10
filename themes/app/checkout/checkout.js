import { UserService } from "../../shared/services/UserService.js";
import { CART_CACHE, formatTotalPriceCart, GetBaseURL, USER_CACHE } from "../../shared/Constants.js";
import {ErrorDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";

(async () => {
    try {
        let [{ data: userData }, isError] = await UserService.getDataById(USER_CACHE.get().id);

        if (isError) {
            ErrorDialog("Erro ao carregar dados do usuário");
            return;
        }

        const summary = document.getElementById("summary");
        let cart = CART_CACHE.get();

        if (!cart || cart.length === 0) {
            summary.innerHTML = "<p>O carrinho está vazio</p>";
            return;
        }

        let summaryItems = cart.map(item => `
            <div class="summary-item">
                <img src="${GetBaseURL(item.principal_img)}" alt="${item.name}">
                <div class="item-details">
                    <div class="item-title">${item.name}</div>
                    <div class="item-info">Quantidade: ${item.amount} | Tamanho: ${item.size}</div>
                </div>
                <div class="item-price">${item.formated_price_brl}</div>
            </div>
        `).join('');

        let summaryValues = `
            <div class="summary-item">
                <span>Frete</span>
                <span id="frete-value">R$10,00</span>
            </div>
            <div class="total">
                Total: ${formatTotalPriceCart(cart)}
            </div>
        `;

        summary.innerHTML = summaryItems + summaryValues;
    } catch (error) {
        console.error("Erro ao carregar o resumo do carrinho", error);
    }
})();

document.getElementById("payment-method").addEventListener("change", () => {
    const paymentMethod = document.getElementById("payment-method").value;
    document.getElementById("credit-card-info").style.display = (paymentMethod === "credit-card") ? "block" : "none";
    document.getElementById("pix-info").style.display = (paymentMethod === "pix") ? "block" : "none";
    document.getElementById("boleto-info").style.display = (paymentMethod === "boleto") ? "block" : "none";
});

document.getElementById("btn-cep-frete").addEventListener("click", async () => {
    const cep = document.getElementById("cep-frete").value;

    if (cep) {
        try {
            document.getElementById("frete-value").textContent = "R$ 12,43"; // Valor fictício
        } catch (error) {
            console.error("Erro ao calcular frete", error);
        }
    } else {
        alert("Por favor, insira um CEP válido.");
    }
});

document.querySelectorAll('.unlock-button').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.previousElementSibling;
        input.disabled = !input.disabled;
        button.innerHTML = input.disabled ? "🔒" : "🔓";
    });
});
