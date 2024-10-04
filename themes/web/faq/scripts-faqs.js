import { FaqService } from "../../shared/services/FaqService.js";

function separateByType(data) {
    return data.data.reduce((acc, item) => {
        if (!acc[item.type]) {
            acc[item.type] = [];
        }
        acc[item.type].push(item);
        return acc;
    }, {});
}

async function renderFaqList() {
    const mainElement = document.querySelector("#main");
    const [faqsResponse, isError] = await FaqService.getData();

    if (isError) {
        mainElement.innerHTML = "Erro ao encontrar as perguntas, tente novamente.";
        return;
    }

    const separatedFaqs = separateByType(faqsResponse);
    mainElement.innerHTML = Object.keys(separatedFaqs).map(type => createFaqSection(type, separatedFaqs[type])).join('');
}

function createFaqSection(type, faqItems) {
    const faqItemsHtml = faqItems.map(item => `
        <div class="faq-item">
            <h3>${item.question}</h3>
            <p>${item.answer}</p>
        </div>
    `).join('');

    return `
        <div class="faq-type">
            <h2>${type}</h2>
            ${faqItemsHtml}
        </div>
    `;
}

(async () => {
    await renderFaqList();
})();
