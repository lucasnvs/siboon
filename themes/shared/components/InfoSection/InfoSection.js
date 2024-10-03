import {appendLinkOnHead, GetBaseURL} from "../../Constants.js";

appendLinkOnHead(GetBaseURL("themes/shared/components/InfoSection/InfoSection.css"))
export function InfoSection({
        title = "No Title",
        child
    }) {

    const infoSection = document.createElement('div');
    infoSection.className = 'info-section';

    const header = document.createElement('header');

    const headerTitle = document.createElement('h2');
    headerTitle.textContent = title;

    const icon = document.createElement('i');
    icon.className = 'material-symbols-outlined';
    icon.textContent = 'expand_circle_down';

    header.appendChild(headerTitle);
    header.appendChild(icon);

    const content = document.createElement('div');
    content.className = 'content';

    const innerContent = document.createElement('div');


    const checkInsertChild = (child) => {
        if(typeof child === "string") {
            innerContent.insertAdjacentHTML("beforeend", child)
        } else {
            innerContent.appendChild(child);
        }

        content.appendChild(innerContent)
    }
    if(child) {
        if(Array.isArray(child)) {
            child.forEach(c => {
                checkInsertChild(c)
            })
        } else {
            checkInsertChild(child)
        }
    }

    infoSection.appendChild(header);
    infoSection.appendChild(content);

    header.addEventListener("click", e => {
        header.parentElement.classList.toggle("appear");
    })

    return infoSection;
}