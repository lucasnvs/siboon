import {OrderService} from "../../shared/services/OrderService.js";

const tableOrders = document.querySelector("#table-orders tbody");

async function renderTableOrders() {
    let {data: orders} = OrderService.getData();
    console.log(orders)
    if(!orders) return;

    tableOrders.innerHTML = "";

    orders.forEach(order => {
        tableOrders.innerHTML += `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.items}</td>
                    <td>${order.total_price_brl_formated}</td>
                    <td>${order.status}</td>
                    <td>${order.customer_email}</td>
                    <td>${order.sale_date}</td>
                    <td>
                        <a href="#">
                            <button class="btn">Detalhar</button>
                        </a>
                    </td>
                </tr>
        `;
    })
}

(async () => {
    await renderTableOrders();
})();