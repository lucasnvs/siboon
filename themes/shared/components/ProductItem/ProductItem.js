import {appendLinkOnHead, CART_CACHE, GetBaseURL} from "../../Constants.js";
import {openCart} from "../../../web/assets/js/scripts-master.js";

appendLinkOnHead(GetBaseURL("themes/shared/components/ProductItem/ProductItem.css"))

export const ProductItem = (product) => {

    const productContainer = document.createElement('div');
    productContainer.classList.add('product-container');

    const productLink = document.createElement('a');
    productLink.href = GetBaseURL(`produto/${product.url}`);

    const imageContainer = document.createElement('div');
    imageContainer.classList.add('image-container');
    const image = document.createElement('img');

    image.src = GetBaseURL(product.principal_img);

    imageContainer.appendChild(image);

    const productDescription = document.createElement('div');
    productDescription.classList.add('product-description');

    const title = document.createElement('p');
    title.classList.add('title');
    title.textContent = product.name;
    const price1 = document.createElement('p');
    price1.classList.add('price');
    price1.textContent = product.formated_price_brl;
    const price2 = document.createElement('p');
    price2.classList.add('price');
    price2.textContent = `ou ${product.formated_price_brl_with_discount} no PIX`;
    productDescription.appendChild(title);
    productDescription.appendChild(price1);
    productDescription.appendChild(price2);

    productLink.appendChild(imageContainer);
    productLink.appendChild(productDescription);

    const sizeSelector = document.createElement('span');
    sizeSelector.textContent = 'SELECIONE O TAMANHO';

    const sizesContainer = document.createElement('div');
    sizesContainer.classList.add('sizes');

    const sizes = [
        { id: `${product.id}-size-p`, size: "P", isSelected: false },
        { id: `${product.id}-size-m`, size: "M", isSelected: false },
        { id: `${product.id}-size-g`, size: "G", isSelected: false },
        { id: `${product.id}-size-gg`, size: "GG", isSelected: false },
    ];

    sizes.forEach(sizeState => {
        const sizeButton = document.createElement('button');
        sizeButton.id = sizeState.id;
        sizeButton.classList.add('size');
        sizeButton.textContent = sizeState.size;
        sizesContainer.appendChild(sizeButton);

        sizeButton.addEventListener("click", () => {
            const hasSizeSelected = sizes.filter(size => size.isSelected === true)
            if(hasSizeSelected) {
                hasSizeSelected.forEach(size => {
                    size.isSelected = false;
                    document.getElementById(size.id).style.color = "black";
                });
            }
            product.size = sizeState.size;
            sizeState.isSelected = true;
            sizeButton.style.color = "#8A11A8";
            sizeSelector.remove();
            productContainer.appendChild(addButton);
        })
    });



    const addButton = document.createElement('button');
    addButton.classList.add('btn');
    addButton.textContent = 'ADICIONAR NA SACOLA';

    addButton.addEventListener("click", () => {
        CART_CACHE.push(product)
        openCart()
    });

    productContainer.appendChild(productLink);
    productContainer.appendChild(sizesContainer);
    productContainer.appendChild(sizeSelector);

    return productContainer;
}