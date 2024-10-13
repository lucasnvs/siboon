import { ItemCart } from "../../../shared/components/ItemCart/ItemCart.js";
import { CART_CACHE, GetBaseURL, formatTotalPriceCart } from "../../../shared/Constants.js";
import { CompanyService } from "../../../shared/services/CompanyService.js";

console.log("%cSiboon SkateShop - Ecommerce By @lucasnvs on GitHub", 'color: #8A11A8; font-size: 15px; font-family: "Verdana", sans-serif; font-weight: bold;');

const CART_ELEMENTS = {
    openCartButton: document.getElementById("cart-button"),
    closeCartButton: document.getElementById("close-cart"),
    background_cart: document.getElementById("background-cart"),
    span_cart_quantity: document.getElementById("span-cart-quantity"),
    catalog: document.getElementById("cart-catalog"),
    info: document.getElementById("cart-info"),
};

CART_ELEMENTS.openCartButton.addEventListener("click", openCart);
CART_ELEMENTS.closeCartButton.addEventListener("click", () => {
    CART_ELEMENTS.background_cart.style.display = "none";
});

export function openCart() {
    CART_ELEMENTS.background_cart.style.display = "block";
    updateCart();
}

export function updateCart() {
    const cart = CART_CACHE.get();
    updateCartHeaderCatalog(cart);
    updateCartInfo(cart);
}

const updateCartHeaderCatalog = (cart) => {
    CART_ELEMENTS.catalog.innerHTML = "";

    if (!cart || cart.length === 0) {
        CART_ELEMENTS.span_cart_quantity.innerHTML = "(0 itens)";
        CART_ELEMENTS.catalog.innerHTML = "<p>SEM ITENS NO CARRINHO</p>";
        return;
    }

    CART_ELEMENTS.span_cart_quantity.innerHTML = `(${cart.length} itens)`;

    cart.forEach(product => {
        CART_ELEMENTS.catalog.appendChild(ItemCart(product));
    });
};

const updateCartInfo = (cart) => {
    const price_formated = cart && cart.length > 0 ? formatTotalPriceCart(cart) : "R$ 0,00";

    const btnCreateCheckout = CART_ELEMENTS.info.querySelector("#info-create-checkout");
    const spanSubtotal = CART_ELEMENTS.info.querySelector("#info-subtotal");

    spanSubtotal.innerHTML = price_formated;
    btnCreateCheckout.textContent = `FAZER PEDIDO ${price_formated}`;

    btnCreateCheckout.onclick = () => {
        if (cart.length < 1) {
            console.log("Não pode comprar, o carrinho está vazio");
            return;
        }

        window.location.href = GetBaseURL("app/checkout");
    };
};

async function writeInFooter() {
    try {
        const footerLogoInfoDiv = document.getElementById("footer-logo-info");
        const [{ data: info }] = await CompanyService.getData();

        footerLogoInfoDiv.innerHTML += `
            <p>${info.company_name} - CNPJ: ${info.company_cnpj}</p>
            <p>${info.company_street}, ${info.company_number}. CEP: ${info.company_cep}.</p>
            <p>${info.company_city}, ${info.company_state}.</p>
        `;
    } catch (error) {
        console.error("Erro ao carregar informações da empresa:", error);
    }
}

(async () => {
    await writeInFooter();
})();
