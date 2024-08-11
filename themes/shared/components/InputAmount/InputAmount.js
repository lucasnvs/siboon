import {URL_BASE_SITE} from "../../Constants.js";

const link = document.createElement("link");
link.rel = "stylesheet";
link.href = URL_BASE_SITE+"themes/shared/components/InputAmount/InputAmount.css";
document.head.appendChild(link);

export const InputAmount = ({id = "", onZero = () => {}, initialValue = 0}) => {

    var AMOUNT = initialValue;

    const quantityElement = document.createElement('div');
    quantityElement.id = id;
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


    btnPlus.addEventListener("click", (e) => {
        AMOUNT = Number(AMOUNT) + 1
        inputQuantity.value = AMOUNT.toString();

    })

    btnMinus.addEventListener("click", () => {
        if(Number(AMOUNT) - 1 > 0 ) {
            AMOUNT = Number(AMOUNT) - 1;
        } else {
            AMOUNT = 0;
            onZero(quantityElement);
        }
        inputQuantity.value = AMOUNT.toString();
    })

    return quantityElement;
}