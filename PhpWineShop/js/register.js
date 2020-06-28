window.onload= function() {

    var registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", validateRegistration);

    function validateRegistration(event) {
        var form = event.target;
        var username = form['username'].value;
        var password = form['password'].value;
        var password2 = form['password2'].value;
        

        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (username === "") {
            errors["username"] = "Username cannot be empty\n";
        }
        if (password === "") {
            errors["password"] = "Password cannot be empty\n";
        }
        else if (password.length < 6) {
            errors["password"] = "Password must be at least six characters\n";
        }
        if (password2 === "") {
            errors["password2"] = "Confirm Password cannot be empty\n";
        }
        else if (password2.length < 6) {
            errors["password2"] = "Confirm Password must be at least six characters\n";
            form["password2"].value = "";
        }
        else if (password !== password2) {
            errors["password2"] = "Passwords must match\n";
            form["password2"].value = "";
        }
       

        var valid = true;
        for (var index in errors) {
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            spanElement.innerHTML = errorMessage;

            form["password"].value = "";
            form["password2"].value = "";
        }
        if (!valid) {
            event.preventDefault();
        }
    }

};
