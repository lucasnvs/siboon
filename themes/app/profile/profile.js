const allInfoCardHeader = document.querySelectorAll(".info-card header");

allInfoCardHeader.forEach(card => {
    card.addEventListener("click", e => {
        card.parentElement.classList.toggle("appear");
    })
})