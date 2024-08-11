Storage.prototype.pushToItem = function (key, value) {
    let newItem = this.get(key) || [];

    newItem.push(value);
    this.set(key, newItem);
}

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

Storage.prototype.removeFromItemById = function (key, id) {
    let data = this.get(key);
    data = data.filter((value) => {
        return value.id !== id;
    });

    this.set(key, data);
}