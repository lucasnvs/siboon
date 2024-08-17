import {URL_BASE_API} from "../Constants.js";

const endpointUrl = URL_BASE_API+"faq/";

export const FaqService = {
    async getData() {
        let data;
        let res = await fetch(endpointUrl);

        if(res.status === 204) data = [];
        data = await res.json();

        return [data, !res.ok];
    },

    async getDataById(id) {
        let res = await fetch(endpointUrl+id);
        return [await res.json(), !res.ok];
    },

    sendData() {
        console.log("Not implemented")
    },

    update() {
        console.log("Not implemented")
    }
}