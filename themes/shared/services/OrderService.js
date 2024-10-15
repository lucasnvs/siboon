import {GetApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class OrderService extends Service {
    static endpoint = (path) => GetApiURL(`pedidos/${path ?? ""}`)

    static async sendData(
        addressId,
        orderProducts = []
    ) {
        let res = await fetch(this.endpoint(), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                address_id: addressId,
                order_items: orderProducts
            })
        })

        return [await res.json(), !res.ok];
    }
}