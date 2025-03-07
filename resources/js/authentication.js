document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const togglePasswordBtn = document.getElementById("togglePassword");
    const toggleIcon = document.getElementById("toggleIcon");

    togglePasswordBtn.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "/storage/images/hide.png"; // Hide icon
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "/storage/images/show.png"; // Show icon
        }
    });
});