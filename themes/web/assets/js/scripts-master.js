import {ItemCart} from "./Components/ItemCart.js";

console.log("%cSiboon SkateShop - Ecommerce By @lucasnvs on GitHub", 'color: #8A11A8; font-size: 15px; font-family: "Verdana", sans-serif; font-weight: bold;')

const TEST_PRODUCT = new CartProduct(23,
    "Tênis Tesla Shine Black Reflect",
    "Black Reflect",
    38,
    320.00,
    "R$ 320,00",
    1,
    "./themes/web/assets/imgs/black-tshirt.jpg");

// localStorage.pushToItem("cart", TEST_PRODUCT);

// const EXAMPLE_DATA_LOCALSTORAGE = [
//     {id: 23, resPath: "../imgs/tesla.jpg", name: "Tênis Tesla Shine Black Reflect", color: "Black Reflect", size: 38, price: 320.00, formated_price: "R$ 320,00", quantity: 1},
//     {id: 543, resPath: "../imgs/camisadiamond.jpg", name: "Camisa Diamond Long Island", color: "Cinza", size: "P", price: 109.90, formated_price: "R$ 190,90", quantity: 2},
// ]

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
}

CART_ELEMENTS.openCartButton.addEventListener("click", () => {
    CART_ELEMENTS.background_cart.style.display = "block";
})
CART_ELEMENTS.closeCartButton.addEventListener("click", () => {
    CART_ELEMENTS.background_cart.style.display = "none";
    console.log("event")
})

function updateCart() {
    const cart = localStorage.get("cart");
    CART_ELEMENTS.span_cart_quantity.innerHTML = `(${cart.length} itens)`;
    CART_ELEMENTS.catalog.innerHTML = "";
    if(cart.length > 0) {
        cart.forEach( product => {
            console.log("Running...")
            new ItemCart(CART_ELEMENTS.catalog.id, product.id, product.name, product.color, product.size, product.resPath, product.formated_price, product.quantity).inflate()
        })
        return;
    }
    CART_ELEMENTS.catalog.innerHTML = "<p>SEM ITENS NO CARRINHO</p>";
}

updateCart()