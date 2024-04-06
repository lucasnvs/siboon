console.log("HOME - Olá, Mundo!");

const background_cart = document.getElementById("background-cart");
const closeCartButton = document.getElementById("close-cart");

const HEADER_OPTIONS = {
        search: "",
        user: "",
        cart: document.getElementById("cart-button"),
}
HEADER_OPTIONS.cart.addEventListener("click", () => {
    background_cart.style.display = "block";
})
closeCartButton.addEventListener("click", () => {
    background_cart.style.display = "none";
    console.log("event")
})