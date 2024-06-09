class CartProduct {
    #id;
    #name;
    #color;
    #size;
    #price;
    #formated_price;
    #quantity;
    #resPath;

    constructor(id, name, color, size, price, formated_price, quantity, resPath) {
        this.#id = id;
        this.#name = name;
        this.#color = color;
        this.#size = size;
        this.#price = price;
        this.#formated_price = formated_price;
        this.#quantity = quantity;
        this.#resPath = resPath;
    }

    destructure() {
        return {
            id: this.#id,
            name: this.#name,
            color: this.#color,
            size: this.#size,
            price: this.#price,
            formated_price: this.#formated_price,
            quantity: this.#quantity,
            resPath: this.#resPath,
        }
    }
    get id() {
        return this.#id;
    }

    set id(value) {
        this.#id = value;
    }

    get name() {
        return this.#name;
    }

    set name(value) {
        this.#name = value;
    }

    get color() {
        return this.#color;
    }

    set color(value) {
        this.#color = value;
    }

    get size() {
        return this.#size;
    }

    set size(value) {
        this.#size = value;
    }

    get price() {
        return this.#price;
    }

    set price(value) {
        this.#price = value;
    }

    get formated_price() {
        return this.#formated_price;
    }

    set formated_price(value) {
        this.#formated_price = value;
    }

    get quantity() {
        return this.#quantity;
    }

    set quantity(value) {
        this.#quantity = value;
    }

    get resPath() {
        return this.#resPath;
    }

    set resPath(value) {
        this.#resPath = value;
    }
}

//{id: 23, resPath: "../imgs/tesla.jpg", name: "Tênis Tesla Shine Black Reflect", color: "Black Reflect", size: 38, price: 320.00, formated_price: "R$ 320,00", quantity: 1},
