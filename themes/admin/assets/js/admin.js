(() => {
    highlightCurrentPage();
})()
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const toggleSidebar = document.getElementById("button-toggle-sidebar");
    const MINIMIZED_CLASS = "min";

    highlightCurrentPage();

    let isMin = localStorage.getItem("navbar_size");

    if (isMin === "true") {
        sidebar.classList.add(MINIMIZED_CLASS);
    } else {
        sidebar.classList.remove(MINIMIZED_CLASS);
    }

    if (toggleSidebar) {
        toggleSidebar.addEventListener("click", () => {
            sidebar.classList.toggle(MINIMIZED_CLASS);
            const isMinimized = sidebar.classList.contains(MINIMIZED_CLASS);
            localStorage.setItem("navbar_size", isMinimized ? "true" : "false");
        });
    }


});

function highlightCurrentPage() {
    const sidebar = document.querySelector(".sidebar");
    if(!sidebar) return;

    const currentUrl = window.location.href;
    const links = sidebar.querySelectorAll("a");

    links.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add("active");
            link.setAttribute("disabled", true);
            link.style.pointerEvents = "none";
        }
    });
}