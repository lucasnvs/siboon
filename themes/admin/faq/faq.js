import {FaqService} from "../../shared/services/FaqService.js";

const tableFaqBody = document.querySelector("#table-faq tbody");

async function renderTable() {
    let [{data: faqs}, isError] = await FaqService.getData();
    tableFaqBody.innerHTML = "";

    if(!faqs) return;

    faqs.forEach(faq => {
        tableFaqBody.innerHTML += `
                <tr>
                    <td>${faq.id}</td>
                    <td>${faq.type}</td>
                    <td>${faq.question}</td>
                    <td>${faq.answer}</td>
                    <td>
                        <a href="#">
                            <button class="btn green" >Editar</button>
                        </a>
                    </td>
                </tr>
        `;
    })
}

(async () => {
    await renderTable();
})();