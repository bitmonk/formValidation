




function togglePassword() {
    const passwordField = document.getElementById("Password");
    const toggleIcon = document.querySelector(".toggle-password");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      
    } else {
      passwordField.type = "password";
      
    }
  }

