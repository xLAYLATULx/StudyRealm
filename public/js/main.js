function toggleNav() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar.classList.contains("minimized")) {
        sidebar.style.width = "16%";
    } else {
        sidebar.style.width = "8%";
    }

    sidebar.classList.toggle("minimized");
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("opacity").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("opacity").style.display = "none";
  }