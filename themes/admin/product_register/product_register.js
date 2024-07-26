import {InputQuantity} from "../../shared/components/InputQuantity/InputQuantity.js";
import {getAuthorization, URL_BASE_API} from "../../shared/Constants.js";

var staticCheckedsList = [];
function updateQuantityBySize() {
    let checkboxes = FORM_ELEMENTS.divAvailableSizes.querySelectorAll("input[type=checkbox]");
    let checkeds = Array.prototype.filter.call(checkboxes, item => item.checked === true)

    FORM_ELEMENTS.divQuantityBySize.innerHTML = "";
    checkeds.forEach(check => {
        FORM_ELEMENTS.divQuantityBySize.insertAdjacentHTML("beforeend", `
                <div id="${check.value}" class="row-quantity-size">
                    <label>${check.value}</label>
                </div>
           `)

        let exist = staticCheckedsList.find(value => value.id === `quantity-${check.value}`)
        if (exist === undefined) {
            let newInputQuantity = new InputQuantity(check.value, `quantity-${check.value}`)
            staticCheckedsList.push(newInputQuantity)
            newInputQuantity.inflate();
            return
        }
        exist.inflate()
    })
}

async function createProduct(authorization, body) {
    let res = await fetch(URL_BASE_API+"produtos", {
        method: "POST",
        headers: {
            "Authorization": "Bearer" + authorization
        },
        body: body,
    })
    if(!res.ok) throw await res.text();
}


const ACTIONS = {
    clearForm: document.getElementById("clear-form"),
    createProduct: document.getElementById("create-product")
}

const FORM_ELEMENTS = {
    selectSizeType: document.getElementById("product-size-type"),
    divAvailableSizes: document.getElementById("available-sizes"),
    divQuantityBySize: document.getElementById("product-quantity-by-size"),
    inputImage: document.getElementById("product-image")
}

ACTIONS.createProduct.addEventListener("click", async (e) => {


    await createProduct(getAuthorization(), JSON.stringify({case: "values"}));
});

FORM_ELEMENTS.selectSizeType.addEventListener("change", (e) => {
    const allowedValues = {
        cloth: ["PP", "P", "M", "G", "GG", "GGG", "X", "XX", "XL", "XXL"],
        shoes: ["31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45"],
        unique: ["Unique"],
    }

    let value = e.target.value;
    let type = allowedValues[value];
    if (type === undefined) throw new Error(`Not Allowed Value: The value for the option "${value}", it is not allowed in the "allowedValues" variable.`)

    FORM_ELEMENTS.divAvailableSizes.innerHTML = "";
    type.forEach(type => { // escreve as checkboxes
        FORM_ELEMENTS.divAvailableSizes.innerHTML += `
                <div>
                    <input id="size-${type}" name="size" value="${type}" type="checkbox">
                    <label for="size-${type}">${type}</label>
                </div>
        `
    })
    FORM_ELEMENTS.divAvailableSizes.querySelectorAll("input[type=checkbox]").forEach(checkbox => {
        checkbox.addEventListener("change", () => { // add evento de change em todas checkboxes
            updateQuantityBySize();
        })
    })
})

FORM_ELEMENTS.inputImage.addEventListener("change", e => {
    console.log(e)
    if (!(e.target && e.target.files && e.target.files.length > 0)) {
        return;
    }
    const r = new FileReader();
    r.onload = function() {
        document.getElementById("image-view").src = r.result;
    }

    r.readAsDataURL(e.target.files[0]);
})