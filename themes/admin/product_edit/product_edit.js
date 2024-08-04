import {URL_BASE_API, URL_BASE_SITE} from "../../shared/Constants.js";
import {getProductById} from "../../shared/ApiRequest.js";

const PRODUCT_ID = document.getElementById("header").dataset.id;

const ACTIONS = {
    clearForm: document.getElementById("clear-form"),
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

    let res = await updateProduct(PRODUCT_ID, formData);
    console.log(res)
});

async function updateProduct(id, body){
    let res = await fetch(URL_BASE_API + "produtos/update/"+id, {
        method: "POST",
        body: body
    });

    if (!res.ok) console.log(await res.text());

    return await res.json();
}


async function setProductData() {
    let {data: product} = await getProductById(PRODUCT_ID);

    console.log(product)
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
            document.querySelector(`label[for="${FORM_ELEMENTS.inputsImages[i + 1]}"] .image-view`).src = URL_BASE_SITE+ product.additional_imgs[i];
        }
    }
}

(async function () {
    await setProductData()
})()