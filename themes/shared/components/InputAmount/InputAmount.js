import {URL_BASE_SITE} from "../../Constants.js";

const link = document.createElement("link");
link.rel = "stylesheet";
link.href = URL_BASE_SITE+"themes/shared/components/InputAmount/InputAmount.css";
document.head.appendChild(link);

export const InputAmount = ({id, onIncrement = (amount) => {}, onMinus = (amount) => {}, onZero = () => {}, initialValue = 1}) => {

    var AMOUNT = initialValue;

    const quantityElement = document.createElement('div');
    if(id) quantityElement.id = id;
    quantityElement.classList.add('quantity');

    const quantityBox = document.createElement('div');
    quantityBox.classList.add('quantity-box');

    const btnMinus = document.createElement('span');
    btnMinus.id = id + "-minus"
    btnMinus.classList.add('minus');
    btnMinus.textContent = '-';

    const inputQuantity = document.createElement('input');
    inputQuantity.type = 'text';
    inputQuantity.name = 'quantity';
    inputQuantity.value = AMOUNT.toString();
    inputQuantity.maxLength = 4;

    const btnPlus = document.createElement('span');
    btnPlus.id = id + "-plus"
    btnPlus.classList.add('plus');
    btnPlus.textContent = '+';

    quantityBox.appendChild(btnMinus);
    quantityBox.appendChild(inputQuantity);
    quantityBox.appendChild(btnPlus);

    quantityElement.appendChild(quantityBox);

    inputQuantity.addEventListener("change", (e) => {
        console.log(1);
    })

    btnPlus.addEventListener("click", (e) => {
        AMOUNT = Number(AMOUNT) + 1
        inputQuantity.value = AMOUNT.toString();
        onIncrement(AMOUNT)
    })

    btnMinus.addEventListener("click", () => {
        if(Number(AMOUNT) - 1 > 0 ) {
            AMOUNT = Number(AMOUNT) - 1;
        } else {
            AMOUNT = 0;
            onZero(quantityElement);
        }
        onMinus(AMOUNT)
        inputQuantity.value = AMOUNT.toString();
    })

    return quantityElement;
}