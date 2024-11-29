import SimpleDialog from "./components/SimpleDialog/SimpleDialog.js";
import { Cache } from "./Cache.js";

export const AUTHORIZATION_COOKIE_KEY = "Authorization";
export const USER_CACHE = new Cache("user");
export const CART_CACHE = new Cache("cart");

export function GetBaseURL(path = "") {
    return `${location.protocol}//${location.hostname}/siboon/${path}`;
}

export const GetApiURL = (path = "") => `${location.protocol}//${location.hostname}/siboon/api/${path}`;

export function formatTotalPriceCart(cart = []) {
    const total = cart.reduce((sum, item) => sum + item.amount * item.price_brl, 0);
    return `R$ ${total.toFixed(2).replace(".", ",")}`;
}

export function appendLinkOnHead(href) {
    if (!href) return;

    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
}

export function showDataForm({ object, previousTitle = "", changeUnderscores = false }) {
    Object.keys(object).forEach(field => {
        let identifier = changeUnderscores ? field.replaceAll("_", "-") : field;
        if (previousTitle) {
            identifier = `${previousTitle}-${identifier}`;
        }

        try {
            const formField = document.querySelector(`#${identifier}`);
            if (formField) {
                formField.value = object[field];
            }
        } catch (e) {
            console.error(`Field not found: #${identifier}`, e);
        }
    });
}

export async function renderTable({tableSelector, service, optionalData, writeLine = (item) => "", onFinish = () => {}}) {
    const table = document.querySelector(tableSelector);
    const tableBody = table?.querySelector("tbody");

    if (!table || !tableBody) {
        console.error("Table or tbody not found");
        return;
    }

    try {
        let data, isError;
        if(service) {
            [data, isError] = await service.getData();
        } else {
            [data, isError] = [{data: optionalData}, false];
        }

        if (isError || !data) {
            SimpleDialog.ErrorDialog(data?.message || "Erro ao carregar dados");
            return;
        }

        const items = data.data || [];

        tableBody.innerHTML = items.map(item => writeLine(item)).join("");

        onFinish();
    } catch (error) {
        console.error("Erro ao renderizar a tabela:", error);
    }
}