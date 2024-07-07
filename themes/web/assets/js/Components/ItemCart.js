import {Component} from "../../../../shared/assets/js/components/Component.js";
import {InputQuantity} from "../../../../shared/assets/js/components/InputQuantity.js";

export class ItemCart extends Component {
    constructor(parentId = null, id = null, title, color, size, resPath, value, quantity) {
        super(parentId)
        this.id = id;
        this.title = title;
        this.color = color;
        this.size = size;
        this.resPath = resPath;
        this.value = value;
        this.quantity = quantity;

        const itemCart = document.createElement('div');
        itemCart.classList.add('item-cart');

        const image = document.createElement('img');
        image.src = resPath;
        image.alt = `Imagem de ${title}`;

        const itemCartDesc = document.createElement('div');
        itemCartDesc.classList.add('item-cart-desc');

        const titleElement = document.createElement('h2');
        titleElement.textContent = title;

        const description = document.createElement('p');
        description.textContent = `Cor: ${color} | Tamanho: ${size}`;

        const priceSpan = document.createElement('span');
        priceSpan.textContent = value;


        itemCartDesc.appendChild(titleElement);
        itemCartDesc.appendChild(description);
        itemCartDesc.appendChild(priceSpan);
        // Append input and button elements here
        itemCartDesc.appendChild(new InputQuantity(id, `${id}-quantity`).inflateLocal())

        itemCart.appendChild(image);
        itemCart.appendChild(itemCartDesc);

        this.body = itemCart;
    }
}