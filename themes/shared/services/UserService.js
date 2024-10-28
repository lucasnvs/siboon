import {GetApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class UserService extends Service {
    static endpoint = (path) => GetApiURL(`usuarios/${path ?? ""}`)

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

        return [await res.json(), !res.ok];
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

    static async getUserAddresses(userId) {
        let res = await fetch(this.endpoint(`${userId}/enderecos`));

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async me() {
        let res = await fetch(this.endpoint(`me`));

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async meUploadProfileImage(formData) {
        let res = await fetch(this.endpoint(`me/upload-profile-image`), {
            method: "POST",
            body: formData
        });

        return [await res.json(), !res.ok];
    }
}