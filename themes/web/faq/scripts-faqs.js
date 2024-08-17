import {FaqService} from "../../shared/services/FaqService.js";

function separateByType(data) {
    const result = {};

    data.data.forEach(item => {
        if (!result[item.type]) {
            result[item.type] = [];
        }
        result[item.type].push(item);
    });

    return result;
}

async function renderFaqList() {
    const mainElement = document.querySelector("#main");

    let [faqsResponse, isError] = await FaqService.getData();

    if(isError) {
        mainElement.innerHTML = "Erro ao encontrar as perguntas, tente novamente."
    }

    var separatedFaqs = separateByType(faqsResponse);

    for (let type in separatedFaqs) {
        if (separatedFaqs.hasOwnProperty(type)) {
            const faqItems = separatedFaqs[type];
            let stringItems = "";

            faqItems.forEach(item => {
                stringItems += `
                    <div class="faq-item">
                        <h3>${item.question}</h3>
                        <p>${item.answer}</p>
                    </div>
                `;
            });

            mainElement.innerHTML += `
                    <div class="faq-type">
                        <h2>${type}</h2>
                        ${stringItems}
                    </div>
            `;
        }
    }
}

(async () => {
    await renderFaqList();
})();