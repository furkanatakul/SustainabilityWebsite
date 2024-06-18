<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('mainBackground.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: rgba(44, 62, 80, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .login-container h1 {
            color: #fff;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: #34495e;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .input-group .icon {
            color: #fff;
            margin-right: 10px;
        }

        .input-group input {
            border: none;
            background: none;
            outline: none;
            color: #fff;
            width: 100%;
        }

        button {
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>LOGIN PAGE</h1>
        <form method="POST" action="login.php">
            <div class="input-group">
                <span class="icon">&#128100;</span>
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <span class="icon">&#128274;</span>
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form><br>
        <form method="POST" action="RegisterPage.php">
            <label style="font-size: 20px; cursor: pointer; color:#fff;" for="create">You don't have an account?</label><br>
            <button id="create" name="create" style="background-color: blue;" type="submit">Create an Account</button>
        </form>
    </div>
</body>
</html>
