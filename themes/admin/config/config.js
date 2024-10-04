import {showDataForm} from "../../shared/Constants.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {CompanyService} from "../../shared/services/CompanyService.js";

(async () =>{
    await updateForm();
})()

async function updateForm() {
    let [{data: info, message}, isError] = await CompanyService.getData();

    if(isError) {
        ErrorDialog(message)
        return
    }

    showDataForm({
        object: info,
        changeUnderscores: true,
    })
}

const form = document.getElementById("info-form");
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formData = new FormData(form);
    let [data, isError] = await CompanyService.sendData(formData)

    if(isError) {
        ErrorDialog(data.message)
    } else {
        SuccessDialog(data.message);
    }
})