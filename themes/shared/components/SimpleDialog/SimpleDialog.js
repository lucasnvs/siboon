import {appendLinkOnHead, getBaseURL} from "../../Constants.js";

appendLinkOnHead(getBaseURL("themes/shared/components/SimpleDialog/simple_dialog.css"))

const SimpleDialog = (message, icon, style, onClick = () => {}) => {
    const dialog = document.createElement("dialog");
    dialog.classList = `dialog ${style}`;

    const iconElement = document.createElement("i");
    iconElement.className = "material-symbols-outlined";
    iconElement.textContent = icon;

    const p = document.createElement("p");
    p.textContent = message

    const closeBtn = document.createElement("button")
    closeBtn.textContent = "Ok"
    closeBtn.classList = "btn"

    dialog.appendChild(iconElement);
    dialog.appendChild(p);
    dialog.appendChild(closeBtn);
    document.body.appendChild(dialog);

    closeBtn.onclick = ()=> {
        onClick()
        dialog.close();
        dialog.remove()
    }

    dialog.showModal()
}

export const SuccessDialog = (message, onClick) => SimpleDialog(message, "check_circle", "success", onClick)

export const ErrorDialog = (message) => SimpleDialog(message, "error", "error")