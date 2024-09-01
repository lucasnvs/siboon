export async function handleProductFormSubmit(e, FORM_ELEMENTS, ServiceFunction, id) {
    const principal_image = FORM_ELEMENTS.inputsImages[0].files[0];
    var additional_images = [
        FORM_ELEMENTS.inputsImages[1].files[0],
        FORM_ELEMENTS.inputsImages[2].files[0],
        FORM_ELEMENTS.inputsImages[3].files[0],
    ].filter(image => !!image)

    return ServiceFunction(
        id,
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
}

export function setImageChangeEvent(input) {
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
}