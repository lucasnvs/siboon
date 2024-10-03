import {GetApiURL} from "../Constants.js";
import {Service} from "./Service.js";

export class FaqService extends Service {
    static endpoint = (path) => GetApiURL(`faq/${path ?? ""}`)

    sendData() {
        console.log("Not implemented")
    }

    static async update(id, {question, answer}) {
        let res = await fetch(this.endpoint(`update/${id}`), {
            method: "POST",
            headers: new Headers({'Content-Type': 'application/json'}),
            body: JSON.stringify({
                question,
                answer
            })
        })

        return [await res.json(), !res.ok];
    }

    static async getAllTopics() {
        let res = await fetch(this.endpoint("topicos"))
        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }
}