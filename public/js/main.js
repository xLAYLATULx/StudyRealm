function toggleNav() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar.classList.contains("minimized")) {
        sidebar.style.width = "16%";
    } else {
        sidebar.style.width = "8%";
    }

    sidebar.classList.toggle("minimized");
}