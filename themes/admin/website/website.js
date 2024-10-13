import { WebsiteService } from "../../shared/services/WebsiteService.js";
import { ErrorDialog, SuccessDialog } from "../../shared/components/SimpleDialog/SimpleDialog.js";
import { Modal } from "../../shared/components/Modal/Modal.js";
import { InputAmount } from "../../shared/components/InputAmount/InputAmount.js";
import {handleDialog} from "../../shared/Constants.js";

(async () => {
    await loadSections();
    await renderFeaturedItems();
})()

async function loadSections() {
    let [responseSection, isError] = await WebsiteService.getSection();

    if (isError) {
        ErrorDialog("Erro ao carregar seções: " + responseSection.message);
        return;
    }

    const sectionList = document.getElementById('section-list');
    sectionList.innerHTML = '';

    if (!responseSection.data) {
        sectionList.insertAdjacentHTML("beforeend", "Não foi encontrada nenhuma seção.");
        return;
    }

    responseSection.data.forEach(section => {
        const li = document.createElement('li');
        li.className = 'section-item';
        li.innerHTML = `
            <span>${section.name}</span>
            <div>
                <button class="edit-section" data-id="${section.id}">Editar</button>
                <button class="delete-section" data-id="${section.id}">Excluir</button>
            </div>
        `;

        li.querySelector(".edit-section").addEventListener("click", () => editSection(section.id));
        li.querySelector(".delete-section").addEventListener("click", () => deleteSection(section.id));

        sectionList.appendChild(li);
    });
}
document.getElementById("add-section").addEventListener("click", addSection);

async function addSection() {
    const newSectionName = document.getElementById('new-section-name').value.trim();

    if (newSectionName === '') {
        ErrorDialog('Nome da seção não pode estar vazio.');
        return;
    }

    let [responseSection, isError] = await WebsiteService.sendSection(newSectionName);

    handleDialog(isError, responseSection.message, async () => {
        await loadSections();
        document.getElementById('new-section-name').value = '';
    });
}

async function editSection(sectionId) {
    const newSectionName = prompt('Digite o novo nome da seção:');

    if (!newSectionName || newSectionName.trim() === '') {
        return;
    }

    let [responseSection, isError] = await WebsiteService.updateSection(sectionId, { name: newSectionName });

    handleDialog(isError, responseSection.message, loadSections);
}

async function deleteSection(sectionId) {
    if (confirm('Tem certeza que deseja excluir essa seção?')) {
        let [responseSection, isError] = await WebsiteService.deleteSection(sectionId);

        handleDialog(isError, responseSection.message, loadSections);
    }
}

///////////////////////////////
async function loadAndPopulateSections(sectionSelect, selectedId = null) {
    const [responseSection, isError] = await WebsiteService.getSection();
    if (isError) {
        ErrorDialog("Erro ao carregar seções.");
        return;
    }
    let options = "<option selected disabled value=\"\">Selecione uma seção</option>";
    options += responseSection.data.map(section => `<option value="${section.id}">${section.name}</option>`).join("");
    sectionSelect.innerHTML = options;
    if (selectedId) sectionSelect.value = selectedId;
}

async function openFeaturedItemModal({ id = null, productId = '', sectionId = null, displayOrder = 0, isEdit = false }) {
    const modalTitle = isEdit ? `Atualizar Item ${id}` : "Adicionar Item Destacado";

    let closeMyModal = Modal({
        title: modalTitle,
        children: [
            `
                <form id="featuredItemForm">
                    <div class="input-container">
                        <label for="productId">Id Produto:</label>
                        <input type="text" class="default-input" id="productId" value="${productId}" required>
                    </div>
                    <br>
                    <div class="input-container">
                        <label for="sectionSelect">Seção:</label>
                        <select id="sectionSelect" required></select>
                    </div>
                    <br>
                    <div id="display-order-amount-container" class="input-container">
                        <label for="displayOrder">Ordem de Exibição:</label>
                    </div>
                    <br>
                    <button style="width: 100%" class="btn" type="submit">Salvar</button>
                </form>
            `
        ]
    });

    const sectionSelect = document.getElementById('sectionSelect');
    await loadAndPopulateSections(sectionSelect, sectionId);

    const displayOrderContainer = document.getElementById("display-order-amount-container");
    const [elementDisplayOrder, displayOrderAmount] = InputAmount({ initialValue: displayOrder, style: "outlined" });
    displayOrderContainer.appendChild(elementDisplayOrder);

    const featuredItemForm = document.getElementById('featuredItemForm');
    featuredItemForm.onsubmit = async (event) => {
        event.preventDefault();
        const productIdInput = document.getElementById('productId').value;
        const sectionIdSelected = sectionSelect.value;
        const displayOrderValue = parseInt(displayOrderAmount.value);

        const itemData = {
            product_id: productIdInput,
            section_id: sectionIdSelected,
            display_order: displayOrderValue
        };

        let response, isError;

        if (isEdit) {
            [response, isError] = await WebsiteService.updateFeaturedItem(id, itemData);
        } else {
            [response, isError] = await WebsiteService.sendFeaturedItem(itemData);
        }

        handleDialog(isError, response.message, async () => {
            await renderFeaturedItems();
            closeMyModal();
        });
    };
}

document.getElementById('addFeaturedItemBtn').addEventListener('click', async () => {
    await openFeaturedItemModal({ isEdit: false });
});

async function editFeaturedItem(id) {
    const [response, isError] = await WebsiteService.getFeaturedItemById(id);
    if (isError) {
        ErrorDialog("Erro ao carregar item destacado.");
        return;
    }
    const { product_id, section_id, display_order } = response.data;

    await openFeaturedItemModal({
        id,
        productId: product_id,
        sectionId: section_id,
        displayOrder: display_order,
        isEdit: true
    });
}

async function renderFeaturedItems() {
    const featuredItemsBody = document.getElementById('featuredItemsBody');
    const [response, isError] = await WebsiteService.getSection();
    if (isError) return console.error("Erro ao carregar itens destacados.");

    featuredItemsBody.innerHTML = '';
    response.data.forEach(section => {
        const sectionHeader = document.createElement('tr');
        sectionHeader.innerHTML = `<td colspan="4" style="font-weight: bold;">${section.name}</td>`;
        featuredItemsBody.appendChild(sectionHeader);

        section.featured_items.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.product_id}</td>
                <td>${item.display_order}</td>
                <td>
                    <button class="edit-featured-item" data-id="${item.id}">Editar</button>
                    <button class="delete-featured-item" data-id="${item.id}">Deletar</button>
                </td>
            `;

            row.querySelector(".edit-featured-item").addEventListener("click", () => editFeaturedItem(item.id));
            row.querySelector(".delete-featured-item").addEventListener("click", () => deleteFeaturedItem(item.id));

            featuredItemsBody.appendChild(row);
        });
    });
}

async function deleteFeaturedItem(id) {
    const [response, isError] = await WebsiteService.deleteFeaturedItem(id);
    handleDialog(isError, response.message, renderFeaturedItems);
}
