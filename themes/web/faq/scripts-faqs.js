import {URL_BASE_API} from "../../shared/Constants.js";

async function getFaq() {
    let res = await fetch(URL_BASE_API+"faq");

    if(!res.ok) throw res;

    return await res.json();
}


async function renderFaqList() {
    let {data: list} = await getFaq();
    for(let i = 0; i < list.length; i++) {
        const faq = list[i];
        let stringItems = "";
        if(!faq.hasOwnProperty("data")) continue;

        faq.data.forEach(item => {
            stringItems += `
                <div class="faq-item">
                    <h3>${item.question}</h3>
                    <p>${item.answer}</p>
                </div>
            `
        });

        document.querySelector("#main").innerHTML += `
        <div class="faq-type">
            <h2>${faq.type}</h2>
            ${stringItems}
        </div>
        `
    }
}

(async () => {
    await renderFaqList();
})();