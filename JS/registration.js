function validateForm() {
    // Validation for minimum age (18 years)
    const date_of_birthInput = document.getElementById("date_of_birth");
    const date_of_birth = new Date(date_of_birthInput.value);
    const currentDate = new Date();
    const minAge = 18;
    const minAgeDate = new Date(currentDate.getFullYear() - minAge, currentDate.getMonth(), currentDate.getDate());
    if (date_of_birth > minAgeDate) {
        alert("You must be at least 18 years old to register.");
        return false;
    }

    // Validation for password (must contain at least one uppercase letter and one digit)
    const passwordInput = document.getElementById("password");
    const password = passwordInput.value;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)/;
    if (!passwordRegex.test(password)) {
        alert("Password must contain at least one uppercase letter and one digit.");
        return false;
    }

    // Validation for email (simple email format check)
    const emailInput = document.getElementById("email");
    const email = emailInput.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Validation for username uniqueness (server-side validation should be used for a real application)
    const usernameInput = document.getElementById("username");
    const username = usernameInput.value;
    const existingUsernames = ["user1", "user2", "user3"]; // Replace with the list of existing usernames from the database
    if (existingUsernames.includes(username)) {
        alert("Username already exists. Please choose a different username.");
        return false;
    }

    return true; // If all validations pass, the form will be submitted
}

