const allInfoCardHeader = document.querySelectorAll(".info-card header");
const btnLogout = document.getElementById("logout");

allInfoCardHeader.forEach(card => {
    card.addEventListener("click", e => {
        card.parentElement.classList.toggle("appear");
    })
})

btnLogout.addEventListener("click", e => {
    eraseCookie("AUTHORIZATION");
    window.location.href = "/siboon";
});

function eraseCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}