import {Service} from "./Service.js";
import {GetApiURL} from "../Constants.js";

export class CompanyService extends Service {
    static endpoint = (path) => GetApiURL(`company/${path ?? ""}`)

    static async sendData(formData) {
        let res = await fetch(GetApiURL("company"), {
            method: "POST",
            body: formData
        });

        return [await res.json(), !res.ok];
    }

    static async update(id) {
        let res = await fetch(this.endpoint(`update/${id}`), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: "{}"
        })

        return [await res.json(), !res.ok];
    }
}