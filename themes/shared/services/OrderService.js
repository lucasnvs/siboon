import {URL_BASE_API} from "../Constants.js";

const endpointUrl = URL_BASE_API+"pedidos/";

export const OrderService = {
    getData() {
        // let res = await fetch(endpointUrl);

        // if(res.status === 204) return [];
        // return await res.json();

        return {
            data: [
                {
                    id: 1,
                    items: "1xM Tênis VANS Outlander<br>2xG Camisa High Spacial Edition XV<br>1xÚnico Shoulder Bag Supreme Skate",
                    total_price_brl_formated: "R$ 764,90",
                    status: "ENTREGUE",
                    customer_email: "johndoe@email.com",
                    sale_date: "24/07/2024"
                },
                {
                    id: 2,
                    items: "1x40 Tênis Tesla Street",
                    total_price_brl_formated: "R$ 299,90",
                    status: "ENVIADO",
                    customer_email: "cala.ss@email.com",
                    sale_date: "27/07/2024"
                },
                {
                    id: 3,
                    items: "1xM Tênis VANS Outlander<br>2xG Camisa High Spacial Edition XV<br>1xÚnico Shoulder Bag Supreme Skate",
                    total_price_brl_formated: "R$ 544,34",
                    status: "PENDENTE",
                    customer_email: "lopes@email.com",
                    sale_date: "01/08/2024"
                },
            ]
        };
    },

    getDataById(id) {
        // let res = await fetch(endpointUrl+id);
        //
        // return await res.json();
    }
}