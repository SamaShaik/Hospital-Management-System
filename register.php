<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register | Global Hospital</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #3931af, #00c6ff);
}
.container {
    max-width: 400px;
    margin: 50px auto;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}
h3 {
    text-align: center;
    color: #333;
}
form div {
    margin-bottom: 15px;
}
label {
    color:rgb(55, 62, 70);
    font-weight: 500;
}
input, select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #fff;
}
button {
    width: 100%;
    padding: 10px;
    background: #3931af;
    color: #fff;
    font-size: 16px;
    border-radius: 4px;
    border: none;
}
button:hover {
    background: #281d93;
}
a {
    text-decoration: none;
    color: #3931af;
}
.text-center {
    text-align: center;
}
.error {
    color: red;
    font-size: 14px;
}
</style>
</head>
<body>
<div class="container">
    <h3>Register to Global Hospital</h3>
    <form method="POST" action="register_handler.php" onsubmit="return validateForm()">
        <div>
            <label>Register as:</label>
            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div>
            <label>First Name:</label>
            <input type="text" id="fname" name="fname" required>
            <span id="errorFname" class="error"></span>
        </div>
        <div>
            <label>Last Name:</label>
            <input type="text" id="lname" name="lname" required>
            <span id="errorLname" class="error"></span>
        </div>
        <div>
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">-- Select Gender --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" id="email" name="email" required>
            <span id="errorEmail" class="error"></span>
        </div>
        <div>
            <label>Contact:</label>
            <input type="text" id="contact" name="contact" required>
            <span id="errorContact" class="error"></span>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword" required>
            <span id="errorCpass" class="error"></span>
        </div>
        <div>
            <input type="checkbox" name="agree" required>
            <label>I agree to the terms & conditions</label>
        </div>
        <div>
            <button type="submit" name="register">Register</button>
        </div>
    </form>
    <p class="text-center">Already have an account? <a href="index.php">Login here</a></p>
</div>

<script>
function validateForm() {
    const fname = document.getElementById("fname").value.trim();
    const lname = document.getElementById("lname").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const cpassword = document.getElementById("cpassword").value.trim();

    const errorFname = document.getElementById("errorFname");
    const errorLname = document.getElementById("errorLname");
    const errorContact = document.getElementById("errorContact");
    const errorEmail = document.getElementById("errorEmail");
    const errorCpass = document.getElementById("errorCpass");

    let isValid = true;

    // Validate First Name
    if (/\d/.test(fname)) {
        errorFname.textContent = "First name must not contain digits.";
        isValid = false;
    } else {
        errorFname.textContent = ""; 
    }

    // Validate Last Name
    if (/\d/.test(lname)) {
        errorLname.textContent = "Last name must not contain digits.";
        isValid = false;
    } else {
        errorLname.textContent = ""; 
    }

    // Validate Contact
    if (contact.length !== 10 || isNaN(contact)) {
        errorContact.textContent = "Contact number must be exactly 10 digits.";
        isValid = false;
    } else {
        errorContact.textContent = ""; 
    }

    // Validate Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    if (!emailPattern.test(email)) {
        errorEmail.textContent = "Please enter a valid email.";
        isValid = false;
    } else {
        errorEmail.textContent = ""; 
    }

    // Validate Password Match
    if (password !== cpassword) {
        errorCpass.textContent = "Passwords do not match.";
        isValid = false;
    } else {
        errorCpass.textContent = ""; 
    }

    return isValid;
}
</script>
</body>
</html>
