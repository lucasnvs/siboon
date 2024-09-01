export const URL_BASE_API = "http://localhost/siboon/api/";
export const URL_BASE_SITE = "http://localhost/siboon/";

export const USER_CACHE_KEY = "user";

export function sumCartTotalFormat(cart) {
    let total = 0;
    cart.forEach( item => total += item.amount * item.price_brl)
    return "R$ " + total.toFixed(2).toString().replace(".", ",");
}

export function appendLinkOnHead({href}) {
    if(!href) return;

    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
}