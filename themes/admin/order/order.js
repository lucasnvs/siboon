import {OrderService} from "../../shared/services/OrderService.js";
import {renderTable} from "../../shared/Constants.js";

(async () => {
    await renderTable({
        tableSelector: "#table-orders",
        service: OrderService,
        writeLine:  (order) => {
            return `
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
        `
        }
    })
})();