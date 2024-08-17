import {URL_BASE_API} from "../Constants.js";

const endpointUrl = URL_BASE_API+"usuarios/";

export const UserService = {
    async getData() {
        let res = await fetch(endpointUrl);

        if(res.status === 204) return [];
        return await res.json();
    },

    async getDataById(id) {
        let res = await fetch(endpointUrl+id);

        if(res.status === 204) return [];
        return await res.json();
    },

    async sendData(
        firstName,
        lastName,
        email,
        password,
    ) {
        let res = await fetch(endpointUrl, {
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
    },

    async delete(id){
        let res = await fetch(endpointUrl+id, {
            method: "DELETE"
        });

        if (!res.ok) console.log(await res.text());

        return await res.json();
    },

    async update(id, body){
        let res = await fetch(endpointUrl+"update/"+id, {
            method: "POST",
            body: body
        });

        if (!res.ok) console.log(await res.text());

        return await res.json();
    },

    async login(
        email,
        password
    ) {
        let res = await fetch(endpointUrl+"login", {
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