import {URL_BASE_API} from "../Constants.js";

const endpointUrl = URL_BASE_API+"produtos/";

export const ProductService = {
    async getData() {
        let res = await fetch(endpointUrl);

        if(res.status === 204) return [];
        return await res.json();
    },

     async getDataById(id) {
        let res = await fetch(endpointUrl+id);

        return await res.json();
    },

    async sendData(
        name, description, color, size_type, price_brl, max_installments, discount_brl_percentage, principal_image_file,
        additional_images = []
    ) {
        const formData = new FormData();
        formData.append("name", name)
        formData.append("description", description)
        formData.append("color", color)
        formData.append("size_type", size_type)
        formData.append("price_brl", price_brl)
        formData.append("max_installments", max_installments)
        formData.append("discount_brl_percentage", discount_brl_percentage)
        formData.append("principal_image", principal_image_file)

        if(additional_images[0]) formData.append("additional_image_1", additional_images[0])
        if(additional_images[1]) formData.append("additional_image_2", additional_images[1])
        if(additional_images[2]) formData.append("additional_image_3", additional_images[2])

        let res = await fetch(endpointUrl, {
            method: "POST",
            body: formData,
        })

        const assign = {
            ok: res.ok
        }

        return Object.assign(await res.json(), assign);
    },

    async delete(id){
        let res = await fetch(endpointUrl+id, {
            method: "DELETE"
        });

        const assign = {
            ok: res.ok
        }

        return Object.assign(await res.json(), assign);
    },

    async update(id, body){
        let res = await fetch(endpointUrl+"update/"+id, {
            method: "POST",
            body: body
        });

        const assign = {
            ok: res.ok
        }

        return Object.assign(await res.json(), assign);
    }
}