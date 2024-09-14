import {getApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class FaqService extends Service {
    static endpoint = (path) => getApiURL(`faq/${path ?? ""}`)

    sendData() {
        console.log("Not implemented")
    }

    update() {
        console.log("Not implemented")
    }

    static async getAllTopics() {
        let res = await fetch(this.endpoint("topicos"))
        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }
}