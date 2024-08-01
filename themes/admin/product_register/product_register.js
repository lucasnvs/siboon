import {getAuthorization, URL_BASE_API} from "../../shared/Constants.js";

const ACTIONS = {
    clearForm: document.getElementById("clear-form"),
    createProduct: document.getElementById("create-product")
}

const inputsImages = [
    document.getElementById("product-image"),
    document.getElementById("product-image-additional-1"),
    document.getElementById("product-image-additional-2"),
    document.getElementById("product-image-additional-3"),
]

const FORM_ELEMENTS = {
    inputsImages,
    inputImage: document.getElementById("product-image"),
    inputName: document.getElementById("product-name"),
    inputDescription: document.getElementById("product-description"),
    inputPrice: document.getElementById("product-price"),
    inputColor: document.getElementById("product-color"),
    selectSizeType: document.getElementById("product-size-type"),
}

console.log(document.querySelector("#product-image .image-view"))
async function createProduct(headers, body) {
    let res = await fetch(URL_BASE_API+"produtos", {
        method: "POST",
        headers: headers,
        body: body,
    })
    if(!res.ok) throw await res.text();

    return await res.json();
}

ACTIONS.createProduct.addEventListener("click", async (e) => {
    const formData = new FormData();
    // formData.append("image", FORM_ELEMENTS.inputImage.files[0])
    formData.append("name", FORM_ELEMENTS.inputName.value)
    formData.append("description", FORM_ELEMENTS.inputDescription.value)
    formData.append("price_brl", FORM_ELEMENTS.inputPrice.value)
    formData.append("color", FORM_ELEMENTS.inputColor.value)
    formData.append("size_type", FORM_ELEMENTS.selectSizeType.value)

    const headers = {
        "Authorization": "Bearer" + getAuthorization(),
    }

    let res = await createProduct(headers, formData);
    console.log(res)
});

ACTIONS.clearForm.addEventListener("click", e => {
    FORM_ELEMENTS.inputsImages.forEach(i => i.value = "")
    document.querySelectorAll(".image-view").forEach( i => i.src = "../../themes/admin/assets/imgs/example.jpg");

    FORM_ELEMENTS.inputName.value = "";
    FORM_ELEMENTS.inputDescription.value = "";
    FORM_ELEMENTS.inputPrice.value = "";
    FORM_ELEMENTS.inputColor.value = "";
    FORM_ELEMENTS.selectSizeType.value = "";
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
})


FORM_ELEMENTS.inputImage.value = "";
FORM_ELEMENTS.inputsImages.forEach(input => {
    input.addEventListener("change", e => {
        if (!(e.target && e.target.files && e.target.files.length > 0)) {
            return;
        }
        const r = new FileReader();
        r.onload = function() {
            document.querySelector(`label[for="${e.target.id}"] .image-view`).src = r.result;
        }

        r.readAsDataURL(e.target.files[0]);
    })
})