<?php
// Start the session at the top
session_start();

// Admin credentials (you can change these)
$admin_username = 'admin';  // Default admin username
$admin_password = 'admin';  // Default admin password

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted username and password, sanitize and trim them
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Check if the credentials match
    if ($username === $admin_username && $password === $admin_password) {
        // Set session variable indicating the admin is logged in
        $_SESSION['admin_logged_in'] = true;

        // Redirect to the admin dashboard
        header("Location: admin-dashboard.php");
        exit(); // Ensure the script stops executing after redirect
    } else {
        // Invalid credentials, show an error message
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #0073e6;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .login-form button:hover {
            background-color: #005bb5;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-form">
        <h2>Admin Login</h2>

        <!-- Display error message if credentials are incorrect -->
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Login form -->
        <form action="admin-login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button href="admin-dashboard.php">Login</button>
            </form>
    </div>

</body>
</html>
