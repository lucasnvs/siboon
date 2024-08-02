const sidebar = document.querySelector(".sidebar");
const toggleSidebar = document.getElementById("button-toggle-sidebar");

let isMin = localStorage.getItem("navbar_size")

if(isMin === "true") {
    sidebar.classList.add("min");
}

toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("min")
    if(sidebar.classList[1] !== undefined) {
        console.log("setando true")
        localStorage.setItem("navbar_size", "true");
    } else {
        console.log("setando false")
        localStorage.setItem("navbar_size", "false");
    }
})