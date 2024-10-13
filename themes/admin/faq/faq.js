import {FaqService} from "../../shared/services/FaqService.js";
import {renderTable} from "../../shared/Constants.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {Modal} from "../../shared/components/Modal/Modal.js";

const showEditDialog = (data) => {
    let closeModal = Modal({
        id: "dialog-edit-faq",
        title: data.type,
        children: [
            `
            <div class="input-container" style="width: 500px;">
                <label>Questão:</label>
                <input id="question-edit" class="default-input" type="text" value="${data.question}">
            <div class="input-container">
                <label for="answer-edit">Resposta:</label>
                <textarea class="default-input" id="answer-edit" rows="8">${data.answer}</textarea>
            </div>
            <button id="edit-content" class="btn green" style="display: flex;align-self: flex-end">Editar</button>
            `
        ]
    })

    document.getElementById("edit-content").onclick = async function () {
        const [res, isError] = await FaqService.update(data.id, {
            question: document.getElementById("question-edit").value,
            answer: document.getElementById("answer-edit").value
        });

        if(isError) {
            ErrorDialog(res.message)
        } else {
            SuccessDialog(res.message)
            await updateTable();
            closeModal();
        }
    }
}

async function renderFaqTypeSelect() {
    let [data, isError] = await FaqService.getAllTopics();
    if(isError) {
        console.log(data.message);
    }
    const {data: topics} = data;
    if(!topics) return;

    let selectType = document.getElementById("faq-type");

    topics.forEach(topic => {
        selectType.innerHTML += `<option value="${topic.id}">${topic.description}</option>`
    })
}

(async () => {
    await updateTable();
    await renderFaqTypeSelect();
})();


async function updateTable() {
    await renderTable({
        tableSelector: "#table-faq",
        service: FaqService,
        writeLine: (faq) => {
            return `
                <tr data-id="${faq.id}">
                    <td>${faq.type}</td>
                    <td>${faq.question}</td>
                    <td class="limit-text">${faq.answer}</td>
                    <td>
                         <button class="btn green">Editar</button>
                    </td>
                </tr>
        `
        }
    })

    document.querySelectorAll("#table-faq .btn.green").forEach(btn => {
        btn.addEventListener("click", async (e) => {
            const getRowParent = (parent) => {
                if(!parent) return null;
                if(parent.tagName === "TR") {
                    return parent
                }
                return getRowParent(parent.parentElement)
            }

            let faqId = getRowParent(e.target.parentElement)?.dataset.id;
            let [data, isError] = await FaqService.getDataById(faqId);
            if (isError) {
                ErrorDialog(data.message)
            }
            let {data: faq} = data;
            if (!faq) return

            showEditDialog(faq);
        })
    })
}