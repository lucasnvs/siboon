import {GetApiURL, showDataForm} from "../../shared/Constants.js";
import {ErrorDialog, SuccessDialog} from "../../shared/components/SimpleDialog/SimpleDialog.js";


async function updateForm() {
    let {data: info} = await fetch(GetApiURL("company"))
        .then(res => res.json())


    showDataForm({
        object: info,
        changeUnderscores: true,
    })
}

updateForm();


const form = document.getElementById("info-form");
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formData = new FormData(form);

    // for(var pair of formData.entries()){
    //     console.log(pair[0], pair[1]);
    // }

    let data = await fetch(GetApiURL("company"), {
        method: "POST",
        body: formData
    });

    let resJSON = await data.json();
    if(!data.ok) {
        ErrorDialog(resJSON.message);
    } else {
        SuccessDialog(resJSON.message);
    }
})