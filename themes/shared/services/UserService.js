import {getApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class UserService extends Service {
    static endpoint = (path) => getApiURL(`usuarios/${path ?? ""}`)

    static async sendData(
        firstName,
        lastName,
        email,
        password,
    ) {
        let res = await fetch(this.endpoint(), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                first_name: firstName,
                last_name: lastName,
                email: email,
                password: password
            }),
        })

        return [await res.json(), !res.ok];
    }

    static async update(id, body){
        let res = await fetch(this.endpoint("update/"+id), {
            method: "POST",
            body: body
        });

        if (!res.ok) console.log(await res.text());

        return await res.json();
    }

    static async login(
        email,
        password
    ) {
        let res = await fetch(this.endpoint("login"), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                email,
                password
            })
        });

        return [await res.json(), !res.ok];
    }
}