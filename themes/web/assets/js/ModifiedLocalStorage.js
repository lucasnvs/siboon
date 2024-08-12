Storage.prototype.get = function (key) {
    return JSON.parse(this.getItem(key)) || [];
}

Storage.prototype.set = function (key, value){
    if (typeof value !== 'string') {
        this.setItem(key, JSON.stringify(value));
        return;
    }
    if (typeof value === 'undefined') return;

    this.setItem(key, value);
}

Storage.prototype.pushToItem = function (key, value) {
    let newItem = this.get(key) || [];

    let incrementFlag = false;

    newItem = newItem.map(item => {
        if(item.id === value.id) {
            item.amount = item.amount ? item.amount + 1 : 1;
            incrementFlag = true;
        }

        return item
    })

    if(!incrementFlag) {
        value.amount = 1;
        newItem.push(value);
    }

    this.set(key, newItem);
}

Storage.prototype.minusFromItemById = function (key, id) {
    let data = this.get(key);
    data = data.map(value => {
        if(value.id === id) {
            value.amount--;
        }
        return value;
    })

    this.set(key, data);
}

Storage.prototype.removeFromItemById = function (key, id) {
    let data = this.get(key);
    data = data.filter((value) => {
        return value.id !== id;
    });

    this.set(key, data);
}