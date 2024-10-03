export class Cache {
    key;

    constructor(cache_key) {
        this.key = cache_key;
    }

    get() {
        return JSON.parse(localStorage.getItem(this.key)) || []
    }

    set(value) {
        const types = {
            string: () => localStorage.setItem(this.key, value),
            object: () => localStorage.setItem(this.key, JSON.stringify(value)),
        }

        types[typeof value]();
    }

    getById(id) {
        let data = this.get();
        data = data.filter((value) => {
            return value.id === id;
        });

        return data[0];
    }

    push(value) {
        let newItem = this.get();
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

        this.set(newItem);
    }

    minus(id) {
        let data = this.get();
        data = data.map(value => {
            if(value.id === id) {
                value.amount--;
                if(value.amount < 1) this.remove();
            }
            return value;
        })

        this.set(data);
    }
    remove(id) {
        let data = this.get();
        data = data.filter((value) => {
            return value.id !== id;
        });

        this.set(data);
    }
}