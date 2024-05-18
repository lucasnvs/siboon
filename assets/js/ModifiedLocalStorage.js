Storage.prototype.pushToItem = function (key, value) {
    let newItem = this.get(key) || [];
    if(value instanceof CartProduct) {
        value = value.destructure();
    }
    newItem.push(value);
    this.set(key, newItem);
}

Storage.prototype.get = function (key) {
    return JSON.parse(this.getItem(key));
}

Storage.prototype.set = function (key, value){
    if (typeof value !== 'string') {
        this.setItem(key, JSON.stringify(value));
        return;
    }
    if (typeof value === 'undefined') return;

    this.setItem(key, value);
}