import {renderTable} from "../../shared/Constants.js";
import {UserService} from "../../shared/services/UserService.js";

(async () => {
    await renderTable({
        tableSelector: "#table-customers",
        service: UserService,
        writeLine:  (customer) => {
            return `
                <tr>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.email}</td>
                    <td>0</td>
                    <td>
                        <button class="btn">Visualizar</button>
                    </td>
                </tr>
        `
        }
    })
})()