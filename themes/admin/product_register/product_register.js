import {URL_BASE_API} from "../../shared/Constants.js";

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
    inputName: document.getElementById("product-name"),
    inputDescription: document.getElementById("product-description"),
    inputPrice: document.getElementById("product-price"),
    inputColor: document.getElementById("product-color"),
    selectSizeType: document.getElementById("product-size-type"),
    selectMaxInstallment: document.getElementById("product-installments"),
    inputDiscount: document.getElementById("product-discount"),
}

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

async function createProduct(body) {
    let res = await fetch(URL_BASE_API+"produtos", {
        method: "POST",
        body: body,
    })
    if(!res.ok) throw await res.text();

    return await res.json();
}

ACTIONS.createProduct.addEventListener("click", async (e) => {
    const formData = new FormData();
    formData.append("name", FORM_ELEMENTS.inputName.value)
    formData.append("description", FORM_ELEMENTS.inputDescription.value)
    formData.append("price_brl", FORM_ELEMENTS.inputPrice.value)
    formData.append("color", FORM_ELEMENTS.inputColor.value)
    formData.append("size_type", FORM_ELEMENTS.selectSizeType.value)
    formData.append("max_installments", FORM_ELEMENTS.selectMaxInstallment.value)
    formData.append("discount_brl_percentage", FORM_ELEMENTS.inputDiscount.value)

    formData.append("principal-image", FORM_ELEMENTS.inputsImages[0].files[0])

    if(FORM_ELEMENTS.inputsImages[1].files[0]) formData.append("additional-image-1", FORM_ELEMENTS.inputsImages[1].files[0])
    if(FORM_ELEMENTS.inputsImages[2].files[0]) formData.append("additional-image-2", FORM_ELEMENTS.inputsImages[2].files[0])
    if(FORM_ELEMENTS.inputsImages[3].files[0]) formData.append("additional-image-3", FORM_ELEMENTS.inputsImages[3].files[0])

    let res = await createProduct(formData);
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

// FORM_ELEMENTS.selectSizeType.addEventListener("change", (e) => {
//
//     const allowedValues = {
//         cloth: ["PP", "P", "M", "G", "GG", "GGG", "X", "XX", "XL", "XXL"],
//         shoes: ["31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45"],
//         unique: ["Unique"],
//     }
//
//     let value = e.target.value;
//     let type = allowedValues[value];
//     if (type === undefined) throw new Error(`Not Allowed Value: The value for the option "${value}", it is not allowed in the "allowedValues" variable.`)
// })