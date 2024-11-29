import {ProductService} from "../../shared/services/ProductService.js";
import SimpleDialog from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {GetBaseURL} from "../../shared/Constants.js";
import {handleProductFormSubmit, setImageChangeEvent} from "../assets/js/shared_products.js";

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

FORM_ELEMENTS.inputsImages.forEach(input => setImageChangeEvent(input))

ACTIONS.createProduct.addEventListener("click", async (e) => {
    let [res, isError] = await handleProductFormSubmit(e, FORM_ELEMENTS, ProductService.sendData, 0)

    SimpleDialog.showDialog({
        type: res.type,
        message: res.message,
        successCallback: () => {
            window.location.href = GetBaseURL("admin/produtos")
        }
    })
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
