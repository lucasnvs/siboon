import {appendLinkOnHead, GetBaseURL} from "../../Constants.js";
appendLinkOnHead(GetBaseURL("themes/shared/components/Modal/Modal.css"))

export const Modal = ({id, title = "Sem título", children} = {}) => {

    const dialog = document.createElement("dialog");
    if(id) dialog.id = id;
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
        let appendByTypeOf = {
            object: (child) => dialog.appendChild(child),
            string: (child) => dialog.insertAdjacentHTML("beforeend", child),
        }

        children.forEach(child => {
            appendByTypeOf[typeof child](child)
        })
    }
    document.body.appendChild(dialog);

    const closeFunction = ()=> {
        dialog.close();
        dialog.remove()
    }

    closeBtn.onclick = closeFunction
    dialog.showModal()

    return closeFunction;
}