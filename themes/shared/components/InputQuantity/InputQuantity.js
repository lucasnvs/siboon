import {Component} from "../../assets/js/Component.js";
export class InputQuantity extends Component {
    id;
    quantity = 0;
    inputQuantity;
    btnPlus;
    btnMinus;

    constructor(parentId = null, id = null) {
        super(parentId);
        this.id = id;

        const quantityElement = document.createElement('div');
        quantityElement.id = this.id;
        quantityElement.classList.add('quantity');

        const quantityBox = document.createElement('div');
        quantityBox.classList.add('quantity-box');

        this.btnMinus = document.createElement('span');
        this.btnMinus.id = this.id + "-minus"
        this.btnMinus.classList.add('minus');
        this.btnMinus.textContent = '-';

        this.inputQuantity = document.createElement('input');
        this.inputQuantity.type = 'text';
        this.inputQuantity.name = 'quantity';
        this.inputQuantity.value = this.quantity;
        this.inputQuantity.maxLength = 4;

        this.btnPlus = document.createElement('span');
        this.btnPlus.id = this.id + "-plus"
        this.btnPlus.classList.add('plus');
        this.btnPlus.textContent = '+';

        quantityBox.appendChild(this.btnMinus);
        quantityBox.appendChild(this.inputQuantity);
        quantityBox.appendChild(this.btnPlus);

        quantityElement.appendChild(quantityBox);

        this.body = quantityElement;


        this.btnPlus.addEventListener("click", (e) => {
            this.quantity = Number(this.quantity) + 1
            this.inputQuantity.value = this.quantity;

        })

        this.btnMinus.addEventListener("click", () => {
            this.quantity = Number(this.quantity) - 1;
            this.inputQuantity.value = this.quantity;
        })
    }
}