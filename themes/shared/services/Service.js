export class Service {
    constructor() {
        if (this.constructor === Service) {
            throw new Error("Service é uma classe abstrata e não pode ser instanciada diretamente.");
        }
    }

    static endpoint = () => "";

    static async getData() {
        let res = await fetch(this.endpoint());

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async getDataById(id) {
        let res = await fetch(this.endpoint(id));

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static sendData() {
        throw new Error("Method 'sendData()' not implemented!");
    }

    static update() {
        throw new Error("Method 'update()' not implemented!");
    }

    static async delete(id) {
        let res = await fetch(this.endpoint(id), {
            method: "DELETE"
        });

        return [await res.json(), !res.ok];
    }
}