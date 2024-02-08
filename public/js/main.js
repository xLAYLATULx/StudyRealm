function toggleNav() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar.classList.contains("minimized")) {
        sidebar.style.width = "16%";
    } else {
        sidebar.style.width = "8%";
    }

    sidebar.classList.toggle("minimized");
}

function openCreateGoalForm() {
    document.getElementById("createGoalForm").style.display = "block";
    document.getElementById("opacity").style.display = "block";
}

function openEditGoalForm() {
    document.getElementById("editGoalForm").style.display = "block";
    document.getElementById("opacity").style.display = "block";
}

function closeForm() {
    document.getElementById("createGoalForm").style.display = "none";
    document.getElementById("editGoalForm").style.display = "none";
    document.getElementById("opacity").style.display = "none";
}