import {GetApiURL} from "../Constants.js";

export class WebsiteService {
    static endpoint = (path) => GetApiURL(`website/${path ?? ""}`)
    static endpointSection = (path) => this.endpoint(`sections/${path ?? ""}`)
    static endpointFeaturedItems = (path) => this.endpoint(`featured-items/${path ?? ""}`)

    static async getSection() {
        let res = await fetch(this.endpointSection());

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async getSectionById(id) {
        let res = await fetch(this.endpointSection(id));

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async sendSection(newSectionName) {
        let res = await fetch(this.endpointSection(), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name: newSectionName })
        });

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async updateSection(id, {name}) {
        let res = await fetch(this.endpointSection("update/"+id), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name })
        });

        return [await res.json(), !res.ok];
    }

    static async deleteSection(id) {
        let res = await fetch(this.endpointSection(id), {
            method: "DELETE"
        });

        return [await res.json(), !res.ok];
    }

    static async getFeaturedItems() {
        let res = await fetch(this.endpointFeaturedItems());

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async getFeaturedItemById(id) {
        let res = await fetch(this.endpointFeaturedItems(id));

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async sendFeaturedItem({section_id, product_id, display_order}) {
        let res = await fetch(this.endpointFeaturedItems(), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                section_id,
                product_id,
                display_order: display_order ?? 1
            })
        });

        if(res.status === 204) return [[], !res.ok];

        return [await res.json(), !res.ok];
    }

    static async updateFeaturedItem(id, {section_id, product_id, display_order}) {
        let res = await fetch(this.endpointFeaturedItems("update/"+id), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ section_id, product_id, display_order })
        });

        return [await res.json(), !res.ok];
    }

    static async deleteFeaturedItem(id) {
        let res = await fetch(this.endpointFeaturedItems(id), {
            method: "DELETE"
        });

        return [await res.json(), !res.ok];
    }
}