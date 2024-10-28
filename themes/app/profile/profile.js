import { UserService } from "../../shared/services/UserService.js";
import { Modal } from "../../shared/components/Modal/Modal.js";
import { ErrorDialog, SuccessDialog } from "../../shared/components/SimpleDialog/SimpleDialog.js";
import { appendLinkOnHead, AUTHORIZATION_COOKIE_KEY, GetBaseURL, USER_CACHE } from "../../shared/Constants.js";

appendLinkOnHead(GetBaseURL("themes/shared/components/InfoSection/InfoSection.css"));

const btnLogout = document.getElementById("logout");
const userNameDisplay = document.getElementById("user-name-display");
const userEmailDisplay = document.getElementById("user-email-display");
const userImageDisplay = document.getElementById("user-image");

(async () => {
    const headers = document.querySelectorAll('.info-section header');
    headers.forEach(header => {
        header.addEventListener('click', () => {
            header.parentElement.classList.toggle("appear");
        });
    });

    await updateUserDetails();

    document.getElementById("edit-user").onclick = async function() {
        await openEditModal();
    };
})();

btnLogout.addEventListener("click", () => {
    eraseCookie(AUTHORIZATION_COOKIE_KEY);
    window.location.href = "/siboon";
});

function eraseCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

async function updateUserDetails() {
    const [{data: user}, isError] = await UserService.me();
    console.log(user)
    if (isError) {
        ErrorDialog("Erro ao carregar os dados do usuário.");
        return;
    }

    userNameDisplay.textContent = user.name;
    userEmailDisplay.textContent = user.email;

    if (user.img) {
        userImageDisplay.src = GetBaseURL(user.img);
        userImageDisplay.style.display = "block";
        document.getElementById("user-initials").style.display = "none";
    } else {
        const initials = user.name
            .split(" ")
            .map(name => name.charAt(0))
            .join("")
            .toUpperCase();

        const userInitials = document.getElementById("user-initials");
        userInitials.textContent = initials;
        userInitials.style.display = "flex";
        userImageDisplay.style.display = "none";
    }
}

async function openEditModal() {
    const [{data: user}, isError] = await UserService.me();
    let [name, last] = user.name.split(" ");
    const modalContent = `
        <div class="input-container" style="width: 500px;">
            <label>Nome</label>
            <input id="user-name" class="default-input" type="text" value="${name}">
        </div>
        <div class="input-container">
            <label>Sobrenome</label>
            <input id="user-last-name" class="default-input" type="text" value="${last || ''}">
        </div> 
        <div class="input-container">
            <label>Email</label>
            <input id="user-email" class="default-input" type="text" value="${user.email}">
        </div>
        <div class="input-container">
            <label>Imagem de Perfil</label>
            <input id="user-edit-image" class="default-input" type="file">
        </div>
        <button id="edit-content" class="btn green" style="display: flex; align-self: flex-end">Editar</button>
    `;

    const closeModal = Modal({
        id: "dialog-edit-user",
        title: "Editar Perfil",
        children: [modalContent]
    });

    document.getElementById("edit-content").addEventListener("click", async () => {
        await updateUser(user);
        closeModal();
    });
}

async function updateUser(user) {
    const userName = document.getElementById("user-name").value;
    const userLastName = document.getElementById("user-last-name").value;
    const userEmail = document.getElementById("user-email").value;
    const imageInput = document.getElementById("user-edit-image")?.files[0];

    const updateForm = new FormData();
    updateForm.append("first_name", userName);
    updateForm.append("last_name", userLastName);
    updateForm.append("email", userEmail);

    const [userResponse, userError] = await UserService.update(USER_CACHE.get().id, updateForm);

    if (userError) {
        ErrorDialog("Erro ao atualizar dados do usuário.");
        return;
    }

    if (imageInput) {
        await uploadProfileImage(imageInput);
    } else {
        updateUserDetails({ ...user, name: userName, last_name: userLastName, email: userEmail });
    }

    SuccessDialog("Perfil atualizado com sucesso!");
}

async function uploadProfileImage(imageInput) {
    const formData = new FormData();
    formData.append("image", imageInput);

    const [imageResponse, imageError] = await UserService.meUploadProfileImage(formData);
    if (imageError) {
        ErrorDialog("Erro ao fazer upload da imagem.");
    } else {
        const userImageDisplay = document.getElementById("user-image");
        userImageDisplay.src = URL.createObjectURL(imageInput);
    }
}