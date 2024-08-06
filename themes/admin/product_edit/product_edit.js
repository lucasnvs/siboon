import {URL_BASE_SITE} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";

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

    let res = await ProductService.update(PRODUCT_ID, formData);
});

ACTIONS.deleteProduct.addEventListener("click", async e => {
    let res = await ProductService.delete(PRODUCT_ID);

    if(!res.ok) {
        ErrorDialog(res.message);
    } else {
        SuccessDialog(res.message, () => {
            window.location.href = URL_BASE_SITE+"admin/produtos"
        });
    }
})

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


async function setProductData() {
    let {data: product} = await ProductService.getDataById(PRODUCT_ID);

    FORM_ELEMENTS.inputName.value = product.name;
    FORM_ELEMENTS.inputDescription.value = product.description;
    FORM_ELEMENTS.inputPrice.value = product.price_brl;
    FORM_ELEMENTS.inputColor.value = product.color;
    FORM_ELEMENTS.selectSizeType.value = product.size_type_id;
    FORM_ELEMENTS.selectMaxInstallment.value = product.max_installments;
    FORM_ELEMENTS.inputDiscount.value = product.discount_brl_percentage;


    document.querySelector(`label[for="${FORM_ELEMENTS.inputsImages[0].id}"] .image-view`).src = URL_BASE_SITE+product.principal_img;
    if(product.additional_imgs) {
        for (let i = 0; i < product.additional_imgs.length; i++){
            document.querySelector(`label[for="${FORM_ELEMENTS.inputsImages[i + 1].id}"] .image-view`).src = URL_BASE_SITE+product.additional_imgs[i];
        }
    }
}

(async function () {
    await setProductData()
})()