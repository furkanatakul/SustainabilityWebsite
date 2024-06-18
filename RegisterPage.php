<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $gender = $_POST['gender'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($gender) && !empty($firstName) && !empty($lastName) && !empty($username) && !empty($password)) {
        $sql = "INSERT INTO users (gender, firstName, lastName, username, password) VALUES ('$gender', '$firstName', '$lastName', '$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo '<script>
                if (confirm("New record created successfully. Go to Login Page?")) {
                    window.location.href = "LoginPage.php";
                }
            </script>';
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="Main.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('mainBackground.jpg') no-repeat center center fixed;
            background-size: cover;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

.register-container {
    max-width: 400px;
    margin: auto;
    padding:  20px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
}

input, select, button {
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

input.valid {
    border: 2px solid green;
}

input.invalid {
    border: 2px solid red;
}

button {
    background-color: blue;
    color: white;
    border: none;
    cursor: not-allowed;
}

button:enabled {
    cursor: pointer;
}

#usernameCheck, #passwordCheck {
    display: block;
    margin-top: 5px;
}

</style>
</head>
<body>
    <div class="register-container">
        <form id="registerForm" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <h2 style="margin-bottom: -5px; margin-top: -5px;">Registration Form</h2>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <span id="usernameCheck"></span>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span id="passwordCheck"></span>
            <button type="submit" id="registerButton" name="register" disabled>Register</button>
        </form>
        <form method="POST" action="LoginPage.php">
            <label style="font-size: 20px; cursor: pointer; color:black;" for="create">You have an account?</label>
            <button id="create" name="create" style="background-color: green;" type="submit">Go to Login Page</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const registerButton = document.getElementById('registerButton');
    const usernameCheck = document.getElementById('usernameCheck');
    const passwordCheck = document.getElementById('passwordCheck');

    function validatePassword() {
        if (password.value === confirmPassword.value && password.value !== "") {
            password.classList.add('valid');
            confirmPassword.classList.add('valid');
            password.classList.remove('invalid');
            confirmPassword.classList.remove('invalid');
            passwordCheck.innerText = '';
        } else {
            password.classList.add('invalid');
            confirmPassword.classList.add('invalid');
            password.classList.remove('valid');
            confirmPassword.classList.remove('valid');
            passwordCheck.innerText = 'Passwords do not match';
        }
        toggleRegisterButton();
    }

    function validateUsername() {
        if (username.value !== "") {
            fetch(`check_username.php?username=${username.value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        username.classList.add('invalid');
                        username.classList.remove('valid');
                        usernameCheck.innerText = 'Username is already taken';
                    } else {
                        username.classList.add('valid');
                        username.classList.remove('invalid');
                        usernameCheck.innerText = '';
                    }
                    toggleRegisterButton();
                });
        } else {
            username.classList.remove('valid', 'invalid');
            usernameCheck.innerText = '';
        }
    }

    function toggleRegisterButton() {
        if (username.classList.contains('valid') && password.classList.contains('valid') && confirmPassword.classList.contains('valid')) {
            registerButton.disabled = false;
        } else {
            registerButton.disabled = true;
        }
    }

    username.addEventListener('input', validateUsername);
    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);
});

    </script>
</body>
</html>

