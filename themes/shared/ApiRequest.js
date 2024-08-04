import {URL_BASE_API} from "./Constants.js";

export async function getProducts() {
    let res = await fetch(URL_BASE_API + "produtos");

    if (!res.ok) throw res;

    return await res.json();
}

export async function getProductById(id) {
    let res = await fetch(URL_BASE_API + "produtos/"+id);

    if (!res.ok) throw res;

    return await res.json();
}