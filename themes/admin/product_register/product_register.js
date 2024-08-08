import {ProductService} from "../../shared/services/ProductService.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {URL_BASE_SITE} from "../../shared/Constants.js";

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

ACTIONS.createProduct.addEventListener("click", async (e) => {

    const principal_image = FORM_ELEMENTS.inputsImages[0].files[0];
    var additional_images = {
        additional_image_1: FORM_ELEMENTS.inputsImages[1].files[0],
        additional_image_2: FORM_ELEMENTS.inputsImages[2].files[0],
        additional_image_3: FORM_ELEMENTS.inputsImages[3].files[0],
    }.filter(image => !!image)

    let res = await ProductService.sendData(
        FORM_ELEMENTS.inputName.value,
        FORM_ELEMENTS.inputDescription.value,
        FORM_ELEMENTS.inputColor.value,
        FORM_ELEMENTS.selectSizeType.value,
        FORM_ELEMENTS.inputPrice.value,
        FORM_ELEMENTS.selectMaxInstallment.value,
        FORM_ELEMENTS.inputDiscount.value,
        principal_image,
        additional_images
    );

    if(!res.ok) {
        ErrorDialog(res.message);
    } else {
        SuccessDialog(res.message, () => {
            window.location.href = URL_BASE_SITE+"admin/produtos"
        });
    }
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