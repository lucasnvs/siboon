export const getBaseURL = (path) => {
    return `${location.protocol}//${location.hostname}/siboon/${path ?? ""}`;
}

export const getApiURL = (path) => {
    return `${location.protocol}//${location.hostname}/siboon/api/${path ?? ""}`;
}

export let USER_CACHE = {
    key: "user",
    get: localStorage.get(this.key),
    set: (data) => localStorage.set(this.key, data)
}

export function sumCartTotalFormat(cart) {
    let total = 0;
    cart.forEach( item => total += item.amount * item.price_brl)
    return "R$ " + total.toFixed(2).toString().replace(".", ",");
}

export function appendLinkOnHead(href) {
    if(!href) return;

    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
}