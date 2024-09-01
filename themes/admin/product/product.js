import {URL_BASE_SITE} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";
import {Modal} from "../../shared/components/Modal/Modal.js";
import {ContainerInput} from "../../shared/components/ContainerInput/ContainerInput.js";

const tableProductsBody = document.querySelector("#table-products tbody");


HTMLAnchorElement.prototype.ModalAddStock = (productID) => {
    Modal({
        title: "Produto: "+ productID,
        children: [
            ContainerInput({
                label: "2x",
            })
        ]
    })
}

async function renderTableProducts() {
    let [{data: products}, isError]= await ProductService.getData();
    tableProductsBody.innerHTML = "";

    if(!products) return;

    products.forEach(product => {
        tableProductsBody.innerHTML += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.formated_price_brl}</td>
                    <td>54</td>
                    <td>
                        <a href="#" onClick="ModalAddStock(${product.id})">
                            <button class="btn green">Add. Estoque</button>
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