import {GetBaseURL, renderTable} from "../../shared/Constants.js";
import {ProductService} from "../../shared/services/ProductService.js";
import {Modal} from "../../shared/components/Modal/Modal.js";
const tableProductsBody = document.querySelector("#table-products tbody");

HTMLAnchorElement.prototype.ModalAddStock = (productID) => {
    Modal({
        title: "CALCA BIG MUITO GRANDE NOME GRANDE VANS EDITION HIGH TECH",
        children: [
            `
             <div class="modal-content">
                <div class="modal-content-section">
                    <h3>Informações do Produto</h3>
                    <p><strong>Quantidade Atual:</strong> <span id="current-quantity">0</span></p>
                    <p><strong>Última Inserção:</strong> <span id="last-insertion">Nenhuma</span></p>
                </div>
                <div class="modal-content-section">
                    <h3>Adicionar ao Estoque</h3>
                    <div class="size-grid" id="size-container"></div>
                    <button id="submit-add">Adicionar ao Estoque</button>
                </div>
            </div>
            `
        ]
    })
    setupModal()
}

(async () => {
    await renderTable("#table-products", ProductService, (product) => {
        return `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.formated_price_brl}</td>
                    <td>54</td>
                    <td>
                        <a href="#" onClick="ModalAddStock(${product.id})">
                            <button class="btn green">Add. Estoque</button>
                        </a>
                        <a href="${ GetBaseURL(`admin/produtos/${product.id}/editar`) }">
                            <button class="btn">Editar</button>
                        </a>
                    </td>
                </tr>
        `
    })
})();

function setupModal() {
    const sizes = [
        { label: 'PP', id: 'size-pp' },
        { label: 'P', id: 'size-p' },
        { label: 'M', id: 'size-m' },
        { label: 'G', id: 'size-g' },
        { label: 'GG', id: 'size-gg' },
        { label: '35', id: 'size-35' },
        { label: '36', id: 'size-36' },
        { label: '37', id: 'size-37' }
    ];

    const sizeContainer = document.getElementById('size-container');

    sizes.forEach(size => {
        const sizeItem = document.createElement('div');
        sizeItem.classList.add('size-item');

        const label = document.createElement('label');
        label.setAttribute('for', size.id);
        label.textContent = size.label;

        const input = document.createElement('input');
        input.type = 'number';
        input.id = size.id;
        input.classList.add('quantity-input');
        input.min = '0';
        input.placeholder = '0';

        sizeItem.appendChild(label);
        sizeItem.appendChild(input);
        sizeContainer.appendChild(sizeItem);
    });

    function updateStockInfo(product) {
        document.getElementById('current-quantity').textContent = product.currentQuantity || 0;
        document.getElementById('last-insertion').textContent = product.lastInsertion || 'Nenhuma';
    }

    document.getElementById('submit-add').onclick = () => {
        const quantities = {};
        sizes.forEach(size => {
            quantities[size.label] = parseInt(document.getElementById(size.id).value) || 0;
        });

        // Lógica para adicionar ao estoque e atualizar a interface...
    };
}