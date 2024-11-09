<?php
session_start();  // Start the session to manage user data


// Define the correct credentials (in real scenarios, use hashed passwords)
$valid_email = "user1@gmail.com";
$valid_password = "pass";

$error_message = ""; // Variable to store error message, if any

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if both fields are filled
    if (empty($email) || empty($password)) {
        $error_message = "Both fields are required.";
    } elseif ($email !== $valid_email) {
        $error_message = "Invalid email address.";
    } elseif ($password !== $valid_password) {
        $error_message = "Invalid password.";
    } else {
        // If credentials are correct, store email in session and redirect to dashboard
        $_SESSION['user_email'] = $email;
        header('Location: dashboard.php');
        exit();  // Stop the script execution after redirect
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Your existing CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Styling for the alert message */
        .alert-message {
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px auto;
            max-width: 400px;
            text-align: left;
            position: relative;
        }
        .alert-message .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 16px;
            color: #721c24;
            cursor: pointer;
        }
        .alert-message .close-btn:hover {
            color: #f1a2a8;
        }
    </style>
</head>
<body>

    <!-- Display error message if any -->
    <?php if (!empty($error_message)) { ?>
        <div class="alert-message">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">×</button>
            <?php echo $error_message; ?>
        </div>
    <?php } ?>

    <!-- Login Form -->
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" required>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

</body>
</html>
