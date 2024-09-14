import {getBaseURL} from "../../shared/Constants.js";
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
    inputPrice: document.getElementById("product-price"),
    inputColor: document.getElementById("product-color"),
    selectSizeType: document.getElementById("product-size-type"),
    selectMaxInstallment: document.getElementById("product-installments"),
    inputDiscount: document.getElementById("product-discount"),
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

    FORM_ELEMENTS.inputName.value = product.name;
    FORM_ELEMENTS.inputDescription.value = product.description;
    FORM_ELEMENTS.inputPrice.value = product.price_brl;
    FORM_ELEMENTS.inputColor.value = product.color;
    FORM_ELEMENTS.selectSizeType.value = product.size_type_id;
    FORM_ELEMENTS.selectMaxInstallment.value = product.max_installments;
    FORM_ELEMENTS.inputDiscount.value = product.discount_brl_percentage;


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