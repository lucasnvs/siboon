import {ErrorDialog} from "./components/SimpleDialog/SimpleDialog.js";
import {Cache} from "./Cache.js";

export const AUTHORIZATION_COOKIE_KEY = "Authorization";
export const USER_CACHE = new Cache("user")
export const CART_CACHE = new Cache("cart")

export function GetBaseURL(path) {return `${location.protocol}//${location.hostname}/siboon/${path ?? ""}`}
export const GetApiURL = (path) => `${location.protocol}//${location.hostname}/siboon/api/${path ?? ""}`;


export function formatTotalPriceCart(cart) {
    let total = 0;
    if(cart.length > 0) {
        cart.forEach( item => total += item.amount * item.price_brl)
    }
    return "R$ " + total.toFixed(2).toString().replace(".", ",");
}

export function appendLinkOnHead(href) {
    if(!href) return;

    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
}

export function showDataForm ({object, previousTitle, changeUnderscores = false})  {
    for(const field in object){
        var identifier = field;

        if(changeUnderscores) {
            identifier = field.replaceAll("_", "-");
        }

        if(previousTitle) {
            identifier = previousTitle+"-"+identifier;
        }

        let formFindedField = document.querySelector("#"+identifier);
        if (formFindedField){
            formFindedField.value = object[field];
        }
    }
}

export async function renderTable(tableSelector, service, writeLine = (item) => {}, onFinish = () => {}) {
    const table = document.querySelector(tableSelector);
    const tableBody = table.querySelector("tbody");

    let [data, isError] = await service.getData();
    if(isError) {
        ErrorDialog(data.message);
        return
    }
    let items = data.data;
    if(!items) return;
    tableBody.innerHTML = "";

    items.forEach(item => {
        tableBody.innerHTML += writeLine(item);
    })

    onFinish()
}