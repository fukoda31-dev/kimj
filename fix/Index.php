<?php
session_start();
require 'db.php'; // Include database connection

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){
        $error = "Please fill in both fields!";
    } else {

        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT user_id, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {

                // Success
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;

                header("Location: dashboard.php");
                exit();

            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "User not found!";
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PLSP Login Page</title>
<link rel="stylesheet" href="index.css">
</head>
<body>

<div class="container">

    <!-- Left Panel -->
    <div class="left-panel">
        <img src="plsp pic.jpg" alt="PLSP Logo" class="logo">
        <h1>Pamantasan ng Lungsod<br>ng San Pablo</h1>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="profile-icon">👤</div>
        <h2 class="login-text">Log In</h2>

        <form action="" method="POST">
            <input type="text" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="forget.php" class="forgot">Forgot Password</a>
            <button type="submit" class="login-btn">Log In</button>
        </form>

        <!-- Display error message if exists -->
        <?php if(isset($error)) { ?>
            <p style="color:red; text-align:center; margin-top:10px;"><?php echo $error; ?></p>
        <?php } ?>

        <a href="register.php" class="register">Register an account</a>
    </div>

</div>

</body>
</html>
