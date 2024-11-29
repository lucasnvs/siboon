import {appendLinkOnHead, GetBaseURL} from "../../Constants.js";

appendLinkOnHead(GetBaseURL("themes/shared/components/SimpleDialog/simple_dialog.css"))

class SimpleDialog {
    constructor(message, icon, style, onClick = () => {}) {
        this.dialog = document.createElement("dialog");
        this.dialog.classList = `simple_dialog ${style}`;

        const iconElement = document.createElement("i");
        iconElement.className = "material-symbols-outlined";
        iconElement.textContent = icon;

        const p = document.createElement("p");
        p.textContent = message;

        const closeBtn = document.createElement("button");
        closeBtn.textContent = "Ok";
        closeBtn.classList = "btn";

        this.dialog.appendChild(iconElement);
        this.dialog.appendChild(p);
        this.dialog.appendChild(closeBtn);
        document.body.appendChild(this.dialog);

        closeBtn.onclick = () => {
            onClick();
            this.close();
        };

        this.dialog.showModal();
    }

    static showDialog({ type, message, successCallback }) {
        switch (type) {
            case "success":
                return this.SuccessDialog(message, successCallback);
            case "warning":
                return this.WarningDialog(message);
            case "error":
                return this.ErrorDialog(message);
            default:
                throw new Error(`Unknown dialog type: ${type}`);
        }
    }

    close() {
        this.dialog.close();
        this.dialog.remove();
    }

    static SuccessDialog(message, onClick) {
        return new SimpleDialog(message, "check_circle", "success", onClick);
    }

    static WarningDialog(message) {
        return new SimpleDialog(message, "warning", "warning");
    }

    static ErrorDialog(message) {
        return new SimpleDialog(message, "error", "error");
    }
}

export default SimpleDialog;