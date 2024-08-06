import {URL_BASE_SITE} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";

const tableProductsBody = document.querySelector("#table-products tbody");

async function renderTableProducts() {
    let {data: products} = await ProductService.getData();
    tableProductsBody.innerHTML = "";

    if(!products) return;

    products.forEach(product => {
        tableProductsBody.innerHTML += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.formated_price_brl}</td>
                    <td>54</td>
                    <td style="text-align: center">
                        <a href="#">
                            <button class="btn green" >Add. Estoque</button>
                        </a>
                        <a href="${URL_BASE_SITE+`admin/produtos/${product.id}/editar`}">
                            <button class="btn">Editar</button>
                        </a>
                    </td>
                </tr>
        `;
    })
}

(async () => {
    await renderTableProducts();
})();