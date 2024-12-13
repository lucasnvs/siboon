import { InputAmount } from "../../shared/components/InputAmount/InputAmount.js";
import { GetBaseURL } from "../../shared/Constants.js";
import { ProductService } from "../../shared/services/ProductService.js";
import SimpleDialog from "../../shared/components/SimpleDialog/SimpleDialog.js";

const productGallery = document.querySelector(".product-gallery");
const mainImage = document.querySelector(".product-main-image img");
const productInfo = document.querySelector(".product-info");
const PRODUCT_ID = document.getElementById("product_id").value;

async function renderProductDetail() {
    const [{ data: product, message }, isError] = await ProductService.getDataById(PRODUCT_ID);
    if (isError) {
        SimpleDialog.ErrorDialog(message);
        return;
    }

    updateProductImages(product);
    updateProductInfo(product);

    setupImageSwitching();
}

function updateProductImages(product) {
    const additionalImages = product.additional_imgs?.map((img, index) => `
        <img src="${GetBaseURL(img)}" alt="Thumbnail ${index + 1}" class="side-image">
    `).join("") || "";

    productGallery.innerHTML = additionalImages;

    mainImage.src = GetBaseURL(product.principal_img);
    mainImage.alt = product.name;
}

function updateProductInfo(product) {
    const installmentPrice = (product.price_brl / 3).toFixed(2);
    const sizeButtons = product.sizes?.map(size => `<button class="size">${size}</button>`).join("") || "";

    productInfo.querySelector(".product-title").textContent = product.name;
    productInfo.querySelector(".product-brand span").textContent = product.brand || "Unknown";
    productInfo.querySelector(".product-price").textContent = `${product.formated_price_brl}`;
    productInfo.querySelector(".product-description").textContent = product.description;

    const sizesContainer = productInfo.querySelector(".product-sizes ul");
    sizesContainer.innerHTML = sizeButtons;

    const quantityContainer = productInfo.querySelector("#quantity-container");
    if (quantityContainer) {
        let [element, amount] = InputAmount({ id: "quantity" });
        quantityContainer.append(element);
    }
}

function setupImageSwitching() {
    productGallery.addEventListener("click", (event) => {
        if (event.target.tagName === "IMG") {
            [mainImage.src, event.target.src] = [event.target.src, mainImage.src];
        }
    });
}

(async () => {
    await renderProductDetail();
})();
