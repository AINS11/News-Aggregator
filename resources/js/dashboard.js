document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector(".sidebar");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            document.querySelector(".sidebar-username").style.display = 'block';
        } else {
            document.querySelector(".sidebar-username").style.display = 'none';
        }
    });

    const logoutBtn = document.getElementById("logout-btn");
    const modal = document.getElementById("logout-modal");
    const closeModalBtn = document.querySelector(".modal-close");
    const confirmLogoutBtn = document.getElementById("confirm-logout");
    const cancelLogoutBtn = document.getElementById("cancel-logout");

    // Open modal when logout button is clicked
    logoutBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default link behavior
        modal.style.display = "flex";
    });

    // Close modal when close button (X) is clicked
    closeModalBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close modal when cancel button is clicked
    cancelLogoutBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Confirm logout action
    confirmLogoutBtn.addEventListener("click", function () {
        modal.style.display = "none";
        document.getElementById("logout-form").submit();
    });

    // Close modal if clicked outside the content area
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});



  