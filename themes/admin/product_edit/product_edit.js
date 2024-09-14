import {getBaseURL, showDataForm} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {handleProductFormSubmit, setImageChangeEvent} from "../assets/js/shared_products.js";

const PRODUCT_ID = document.getElementById("header").dataset.id;

const ACTIONS = {
    deleteProduct: document.getElementById("delete-product"),
    editProduct: document.getElementById("edit-product")
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
    inputPrice: document.getElementById("product-price-brl"),
    inputColor: document.getElementById("product-color"),
    selectSizeType: document.getElementById("product-size-type-id"),
    selectMaxInstallment: document.getElementById("product-max-installments"),
    inputDiscount: document.getElementById("product-discount-brl-percentage"),
}

ACTIONS.editProduct.addEventListener("click", async (e) => {
    let [res, isError] = await handleProductFormSubmit(e, FORM_ELEMENTS, ProductService.update, PRODUCT_ID)
    if(isError) {
        ErrorDialog(res.message);
    } else {
        SuccessDialog(res.message, () => {
            window.location.href = getBaseURL("admin/produtos")
        });
    }
});

ACTIONS.deleteProduct.addEventListener("click", async e => {
    let [res, isError] = await ProductService.delete(PRODUCT_ID);

    if(isError) {
        ErrorDialog(res.message);
    } else {
        SuccessDialog(res.message, () => {
            window.location.href = getBaseURL("admin/produtos")
        });
    }
})

FORM_ELEMENTS.inputsImages.forEach(input => setImageChangeEvent(input))

async function setProductData() {
    let [{data: product}, isError] = await ProductService.getDataById(PRODUCT_ID);

    showDataForm({
        object: product,
        previousTitle: "product",
        changeUnderscores: true
    });

    document.querySelector(`label[for="${FORM_ELEMENTS.inputsImages[0].id}"] .image-view`).src = getBaseURL(product.principal_img);
    if(product.additional_imgs) {
        for (let i = 0; i < product.additional_imgs.length; i++){
            document.querySelector(`label[for="${FORM_ELEMENTS.inputsImages[i + 1].id}"] .image-view`).src = getBaseURL(product.additional_imgs[i]);
        }
    }
}

(async function () {
    await setProductData()
})()