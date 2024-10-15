import {OrderService} from "../../shared/services/OrderService.js";
import {renderTable} from "../../shared/Constants.js";

(async () => {
    let [responseOrder, isError] = await OrderService.getData();
    console.log(responseOrder)
    let orders = responseOrder.data || [];

    let statusFormat = {
        "PENDING": "Pendente...",
        "SENT": "Enviado",
        "PAID": "Pago"
    }

    orders = orders.map(order => {
        return {
            id: order.id,
            items: order.items || "Não encontrado",
            total_price_formated: order.total_price_formated || "Não encontrado",
            payment_status: statusFormat[order.payment_status] || "Não encontrado",
            shipment_status: statusFormat[order.shipment_status] || "Não encontrado",
            customer_email: order.customer_email || "Não encontrado",
            created_at: order.created_at || "Não encontrado",
        }
    })
    await renderTable({
        tableSelector: "#table-orders",
        optionalData: orders,
        writeLine:  (order) => {
            return `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.items}</td>
                    <td>${order.total_price_formated}</td>
                    <td>${order.payment_status}</td>
                    <td>${order.shipment_status}</td>
                    <td>${order.customer_email}</td>
                    <td>${order.created_at}</td>
                    <td>
                        <a href="#">
                            <button class="btn">Detalhar</button>
                        </a>
                    </td>
                </tr>
        `
        }
    })
})();