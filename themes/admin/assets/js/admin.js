const sidebar = document.querySelector(".sidebar");
const toggleSidebar = document.getElementById("button-toggle-sidebar");

toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("min")
})