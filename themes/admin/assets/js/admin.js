const sidebar = document.querySelector(".sidebar");
const toggleSidebar = document.getElementById("button-toggle-sidebar");
const MINIMIZED_CLASS = "min";

let isMin = localStorage.getItem("navbar_size");

switch(isMin) {
    case "true": sidebar.classList.add(MINIMIZED_CLASS)
        break;
}

toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle(MINIMIZED_CLASS)
    if(sidebar.classList[1] !== undefined) {
        localStorage.setItem("navbar_size", "true");
    } else {
        localStorage.setItem("navbar_size", "false");
    }
})