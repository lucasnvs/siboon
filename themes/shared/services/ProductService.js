import {URL_BASE_API} from "../Constants.js";
import {Service} from "./Service.js";


export class ProductService extends Service {
    static endpoint = URL_BASE_API+"produtos/";
    static #assignDataOnFormData(
        id,
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

        return formData;
    }

    static async sendData(
        id,
        name, description, color, size_type, price_brl, max_installments, discount_brl_percentage, principal_image_file,
        additional_images = []
    ) {

        const formData = ProductService.#assignDataOnFormData(id, name, description, color, size_type, price_brl, max_installments, discount_brl_percentage, principal_image_file, additional_images)

        let res = await fetch(ProductService.endpoint, {
            method: "POST",
            body: formData,
        })

        return [await res.json(), !res.ok];
    }

    static async update(
        id,
        name, description, color, size_type, price_brl, max_installments, discount_brl_percentage, principal_image_file,
        additional_images = []
    ){

        const formData = this.#assignDataOnFormData(id, name, description, color, size_type, price_brl, max_installments, discount_brl_percentage, principal_image_file, additional_images)

        let res = await fetch(this.endpoint+"update/"+id, {
            method: "POST",
            body: formData
        });

        return [await res.json(), !res.ok];
    }
}