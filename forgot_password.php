<?php
// Forgot Password Logic
session_start();

require_once './src/Database.php';
$db = Database::getInstance();

$err = '';
$success = '';

if (isset($_POST['submit'])) {
    // Forgot password logic
    $email = $_POST['email'];

    if (strlen($email) < 1) {
        $err = 'Please enter email address';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Please enter a valid email address';
    } else {
        $sql = "SELECT id, email FROM users WHERE email = '$email'";
        $res = $db->query($sql);

        if ($res->num_rows < 1) {
            $err = "No user found with this email";
        } else {
            // Generate reset token and save to database
            $reset_token = bin2hex(random_bytes(16)); // Secure token
            $expires_at = date('l, F j, Y g:i A', strtotime('+1 hour')); // Token expires in 1 hour

            $update_sql = "UPDATE users SET reset_token = '$reset_token', reset_token_expires = '$expires_at' WHERE email = '$email'";
            if ($db->query($update_sql)) {
                // Send reset email
                $reset_link = "http://localhost/reset_password.php?token=$reset_token";
                $to = $email;
                $subject = "Password Reset Request";
                $message = "Click the link below to reset your password:\n$reset_link";
                $headers = "From: no-reply@assistechx.com";

                if (mail($to, $subject, $message, $headers)) {
                    $success = "A reset link has been sent to your email address.";
                } else {
                    $err = "Failed to send email. Please try again.";
                }
            } else {
                $err = "Failed to generate reset link: " . $db->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Forgot Password | AssisTechX</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

<div class="wrapper">
    <div class="container">
        <div class="form-box login">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Forgot Password</h1>

                <div class="input-box">
                    <input type="text" name="email" placeholder="Enter your registered email" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <button type="submit" name="submit" class="btn">Send Reset Link</button>
                <p></p>

                <?php if (strlen($err) > 1) : ?>
                <div class="alert alert-danger text-center mt-3" role="alert">
                    <strong>Failed! </strong> <?php echo $err; ?>
                </div>
                <?php endif; ?>

                <?php if (strlen($success) > 1) : ?>
                <div class="alert alert-success text-center mt-3" role="alert">
                    <strong>Success! </strong> <?php echo $success; ?>
                </div>
                <?php endif; ?>

                <div class="forgot-link">
                    <a href="index.php">Back to Login</a>
                </div>
            </form>
        </div>
        <div class="form-box register">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Register</h1>

                <div class="input-box">
                    <input type="text" name="name" placeholder="Name" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="text" name="email" placeholder="Email address" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <i class='bx bxs-check-circle'></i>
                </div>

                <button type="submit" name="register" class="btn">Register</button>
            </form>
        </div>

        <div class="toggle-box"> 
            <div class="toggle-panel toggle-left">
                <img onclick="window.location.href='landing_page.php';" class="styled-image" src="./assets/assistechx.png">
                <h1> Hello! Welcome to <br>Company's Help Desk</h1>
                <p> Don't have an account?</p>
                <button class="btn admin-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <img onclick="window.location.href='landing_page.php';" class="styled-image" src="./assets/assistechx.png">
                <h1> Create an Account</h1>
                <p>Already have an Account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>

    </div>
</div>

<script src="./js/login.js"></script>
</body>
</html>
