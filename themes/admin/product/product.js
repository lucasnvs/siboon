import { GetBaseURL, renderTable } from "../../shared/Constants.js";
import { ProductService } from "../../shared/services/ProductService.js";
import { Modal } from "../../shared/components/Modal/Modal.js";
import { InventoryService } from "../../shared/services/InventoryService.js";
import SimpleDialog from "../../shared/components/SimpleDialog/SimpleDialog.js";
import { InputAmount } from "../../shared/components/InputAmount/InputAmount.js";

(async () => {
    await renderTableProducts()
})();
async function renderTableProducts() {
    const [{ data: products }, isErrorProducts] = await ProductService.getData();
    const [inventory, isErrorInventory] = await InventoryService.getData();

    if (isErrorInventory) {
        SimpleDialog.ErrorDialog(inventory.message);
        return;
    }

    const mergedList = products.map(product => {
        const productInventory = inventory.data?.filter(item => item.product_id === product.id) || [];

        const hasStock = productInventory.some(item => item.amount > 0);

        const inventoryItem = {
            stockStatus: hasStock ? "Em estoque" : "Sem estoque",
            inventory: productInventory
        };

        return { ...product, ...inventoryItem };
    });


    await renderTable({
        tableSelector: "#table-products",
        optionalData: mergedList,
        writeLine: (product) => `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.formated_price_brl}</td>
                <td>${product.stockStatus}</td>
                <td>
                    <a href="#" class="manage-stock" data-id="${product.id}">
                        <button class="btn green">G. Estoque</button>
                    </a>
                    <a href="${GetBaseURL(`admin/produtos/${product.id}/editar`)}">
                        <button class="btn">Editar</button>
                    </a>
                </td>
            </tr>
        `
    });

    document.querySelectorAll('.manage-stock').forEach(anchor => {
        anchor.addEventListener('click', async function (e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            await modalAddStock(productId);
        });
    });
}

async function modalAddStock(productId) {
    const closeModal = Modal({
        title: "CALÇA BIG MUITO GRANDE NOME GRANDE VANS EDITION HIGH TECH",
        children: [
            `
            <div class="modal-content">
                <div class="modal-content-section">
                    <h3>Informações do Produto</h3>
                    <p><strong>Última Inserção:</strong> <span id="last-insertion">Nenhuma</span></p>
                </div>
                <div class="modal-content-section">
                    <h3>Gerenciar estoque</h3>
                    <div class="size-grid" id="size-container"></div>
                    <button id="submit-add">Atualizar Estoque</button>
                </div>
            </div>
        `
        ]
    });

    let inventoryData = [];
    const [inventoryResponse, isError] = await InventoryService.getDataById(productId);

    if (!isError && inventoryResponse && Array.isArray(inventoryResponse.data)) {
        inventoryData = inventoryResponse.data;
    }

    const sizes = [
        { label: 'PP', id: 'size-pp' },
        { label: 'P', id: 'size-p' },
        { label: 'M', id: 'size-m' },
        { label: 'G', id: 'size-g' },
        { label: 'GG', id: 'size-gg' },
    ];

    const sizeContainer = document.getElementById('size-container');
    sizeContainer.innerHTML = '';

    sizes.forEach(size => {
        const sizeItem = document.createElement('div');
        sizeItem.classList.add('size-item');

        const label = document.createElement('label');
        label.setAttribute('for', size.id);
        label.textContent = size.label;

        const matchingInventory = inventoryData.find(item => item.size === size.label);
        const initialValue = matchingInventory ? matchingInventory.amount : 0;

        const [elementAmount, quantityAmount] = InputAmount({
            id: size.id,
            initialValue: initialValue,
            noNegative: true,
            style: "outlined"
        });

        size.amount = quantityAmount;

        sizeItem.appendChild(label);
        sizeItem.appendChild(elementAmount);
        sizeContainer.appendChild(sizeItem);
    });

    document.getElementById('submit-add').onclick = async () => {
        const quantities = sizes.map(size => ({
            size: size.label,
            amount: parseInt(size.amount.value)
        }));

        const [data, isError] = await InventoryService.updateList(productId, quantities);


        SimpleDialog.showDialog({
            type: data.type,
            message: data.message,
            successCallback: async () => {
                await renderTableProducts();
            }
        })

        closeModal();
    };
}