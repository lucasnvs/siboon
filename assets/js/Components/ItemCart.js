class ItemCart {
    constructor(title, color, size, resPath, value, quantity) {
        this.title = title;
        this.color = color;
        this.size = size;
        this.resPath = resPath;
        this.value = value;
        this.quantity = quantity;
    }

    #criarCard() {
        let HTML =
            `
            <div class="item-cart">
                    <img src="${this.resPath}" alt="Imagem de ${this.title}">
                    <div class="item-cart-desc">
                        <h2>Tênis Tesla Shine Black Reflect</h2>
                        <p>Cor: ${this.color} | Tamanho: ${this.size}</p>
                        <p>${this.value}</p>

                        <!-- input quantity number -->
                        <!-- button icon trash -->
                    </div>
            </div>
            `
        return HTML;
    }

    appendCardToParentBySelector(parentSelector) {
        const cardElement = this.#criarCard();
        const container = document.querySelector(parentSelector);
        container.append(cardElement);
    }

    appendCardToParent(parent) {
        const cardElement = this.#criarCard();
        parent.insertAdjacentHTML("beforeend", cardElement);
    }
}