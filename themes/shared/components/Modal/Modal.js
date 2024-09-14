import {appendLinkOnHead, getBaseURL} from "../../Constants.js";
appendLinkOnHead(getBaseURL("themes/shared/components/Modal/Modal.css"))

export const Modal = ({title = "Sem título", children} = {}) => {

    const dialog = document.createElement("dialog");
    dialog.classList = `dialog`;

    const header = document.createElement("header");
    header.classList = "header";

    const pTitle = document.createElement("p");
    pTitle.classList = "title";
    pTitle.textContent = title;

    const closeBtn = document.createElement("button")
    closeBtn.classList = "close-x"

    header.appendChild(pTitle);
    header.appendChild(closeBtn);

    dialog.appendChild(header);
    if(children) {
        children.forEach(child => {
            dialog.appendChild(child);
        })
    }
    document.body.appendChild(dialog);

    closeBtn.onclick = ()=> {
        dialog.close();
        dialog.remove()
    }

    dialog.showModal()
}