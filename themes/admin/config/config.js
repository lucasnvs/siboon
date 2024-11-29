import {showDataForm} from "../../shared/Constants.js";
import SimpleDialog from "../../shared/components/SimpleDialog/SimpleDialog.js";
import {CompanyService} from "../../shared/services/CompanyService.js";

(async () =>{
    await updateForm();
})()

async function updateForm() {
    let [{data: info, message}, isError] = await CompanyService.getData();

    if(isError) {
        SimpleDialog.ErrorDialog(message)
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

    SimpleDialog.showDialog({
        type: data.type,
        message: data.message,
    })
})