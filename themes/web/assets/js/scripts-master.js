import {ItemCart} from "../../../shared/components/ItemCart/ItemCart.js";

console.log("%cSiboon SkateShop - Ecommerce By @lucasnvs on GitHub", 'color: #8A11A8; font-size: 15px; font-family: "Verdana", sans-serif; font-weight: bold;')

const CART_KEY = "cart";

const HEADER_OPTIONS = {
    search: "",
    user: "",
}

const CART_ELEMENTS = {
    openCartButton: document.getElementById("cart-button"),
    closeCartButton: document.getElementById("close-cart"),
    background_cart: document.getElementById("background-cart"),
    span_cart_quantity: document.getElementById("span-cart-quantity"),
    catalog: document.getElementById("cart-catalog"),
    info: document.getElementById("cart-info")
}

CART_ELEMENTS.openCartButton.addEventListener("click", () => {
    CART_ELEMENTS.background_cart.style.display = "block";
    updateCart()
})
CART_ELEMENTS.closeCartButton.addEventListener("click", () => {
    CART_ELEMENTS.background_cart.style.display = "none";
})

function updateCart() {
    const cart = localStorage.get(CART_KEY);

    updateCartHeaderCatalog(cart);
    updateCartInfo(cart)
}

const updateCartHeaderCatalog = (cart) => {
    if(!cart) return;

    CART_ELEMENTS.span_cart_quantity.innerHTML = `(${cart.length} itens)`;
    CART_ELEMENTS.catalog.innerHTML = "";
    if(cart.length > 0) {
        cart.forEach( product => {
            CART_ELEMENTS.catalog.appendChild(ItemCart(product, () => {
                localStorage.removeFromItemById(CART_KEY, product.id);
                updateCart()
            }))
        })
        return;
    }
    CART_ELEMENTS.catalog.innerHTML = "<p>SEM ITENS NO CARRINHO</p>";
}

const updateCartInfo = (cart) => {
    var price_formated = "R$ 0,00";

    if(!cart) return;

    let total = 0;
    cart.forEach( item => total += item.price_brl)
    price_formated = "R$ " + total.toFixed(2).toString().replace(".", ",");

    const btnCreateCheckout = CART_ELEMENTS.info.querySelector("#info-create-checkout");
    btnCreateCheckout.textContent = `FAZER PEDIDO ${price_formated}`;
    const spanSubtotal = CART_ELEMENTS.info.querySelector("#info-subtotal");
    spanSubtotal.innerHTML = price_formated;

    btnCreateCheckout.onclick = () => {
        if(cart.length < 0) {
            console.log("Não pode comprar, não tem nada ai no carrinho")
            return;
        }

        console.log("Indo para o checkout");
    }
}