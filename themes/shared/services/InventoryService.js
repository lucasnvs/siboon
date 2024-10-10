import {GetApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class InventoryService extends Service {
    static endpoint = (path) => GetApiURL(`inventory/${path ?? ""}`)

    static async sendData(product_id, size) {
        let res = await fetch(this.endpoint(), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                product_id,
                size
            })
        })

        return [await res.json(), !res.ok];
    }

    static async updateList(productId, sizesList) {
        let res = await fetch(this.endpoint(`update-list`), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                product_id: productId,
                sizes: sizesList
            })
        })

        return [await res.json(), !res.ok];
    }
}