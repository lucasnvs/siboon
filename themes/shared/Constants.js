export const getBaseURL = (path) => `${location.protocol}//${location.hostname}/siboon/${path ?? ""}`;
export const getApiURL = (path) => `${location.protocol}//${location.hostname}/siboon/api/${path ?? ""}`;

const cache = (key) => JSON.parse(localStorage.getItem(key)) || [];
const setCache = (key, value) => {
    const types = {
        string: () => localStorage.setItem(key, value),
        object: () => localStorage.setItem(key, JSON.stringify(value)),
    }

    types[typeof value]();
}

const USER_CACHE_KEY = "user";
export const USER_CACHE = {
    key: USER_CACHE_KEY,
    get: cache(USER_CACHE_KEY),
    set: (data) => setCache(USER_CACHE_KEY, data)
}

const CART_CACHE_KEY = "cart";
export const CART_CACHE = {
    key: CART_CACHE_KEY,
    get: () => cache(CART_CACHE_KEY),
    set: (data) => setCache(CART_CACHE_KEY, data),
    push: function (value) {
        let key = CART_CACHE_KEY;
        let newItem = cache(key);
        let incrementFlag = false;

        newItem = newItem.map(item => {
            if(item.id === value.id) {
                item.amount = item.amount ? item.amount + 1 : 1;
                incrementFlag = true;
            }

            return item
        })

        if(!incrementFlag) {
            value.amount = 1;
            newItem.push(value);
        }

        setCache(key, newItem);
    },
    minus: function (id) {
        let key = CART_CACHE_KEY;
        let data = cache(key);
        data = data.map(value => {
            if(value.id === id) {
                value.amount--;
                if(value.amount < 1) CART_CACHE.remove();
            }
            return value;
        })

        setCache(key, data);
    },
    remove: function (id) {
        let key = CART_CACHE_KEY;
        let data = cache(key);
        data = data.filter((value) => {
            return value.id !== id;
        });

        setCache(key, data);
    }
}

export function sumCartTotalFormat(cart) {
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

// Função para preencher os campos do formulário com os dados do objeto
export function showDataForm ({object, previousTitle, changeUnderscores = false})  {
    for(const field in object){
        var identifier = field;
        if(previousTitle) {
            if(changeUnderscores) {
                var changedField = field.replaceAll("_", "-")
                identifier = previousTitle+"-"+changedField;
            } else {
                identifier = previousTitle+"-"+field;
            }
        }
        console.group(field)
        console.log(identifier)
        console.log(document.querySelector("#"+identifier))
        console.log(object[field])
        console.groupEnd()

        if (document.querySelector("#"+identifier)){
            document.querySelector("#"+identifier).value = object[field];
        }
    }
}