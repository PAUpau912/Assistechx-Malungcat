<?php
// Authentication Logic
session_start();
$_SESSION['logged-in'] = false;

require_once './src/Database.php';
$db = Database::getInstance();

$err = '';
$success = '';

if (isset($_POST['submit'])) {
    // Login logic
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($email) < 1) {
        $err = 'Please enter email address';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Please enter a valid email address';
    } else if (strlen($password) < 1) {
        $err = "Please enter your password";
    } else {
        $sql = "SELECT id, name, email, password, role FROM users WHERE email = '$email'";
        $res = $db->query($sql);

        if ($res->num_rows < 1) {
            $err = "No user found";
        } else {
            $user = $res->fetch_object();

            if (password_verify($password, $user->password)) {
                $_SESSION['logged-in'] = true;
                $_SESSION['user'] = $user;
                
                // Redirect based on user role
                if ($user->role == 'admin') {
                    header('Location: ./dashboard.php');
                } 
                
                elseif ($user->role == 'staff') {
                    header('Location: ./dashboard.php');
                }
                
                else {
                    header('Location: ./user_dashboard.php');
                }
                exit();
            } else {
                $err = "Wrong username or password";
            }
        }
    }
} elseif (isset($_POST['register'])) {
    // Registration logic
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($name) < 1) {
        $err = 'Please enter your name';
    } else if (strlen($email) < 1) {
        $err = 'Please enter email address';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Please enter a valid email address';
    } else if (strlen($password) < 6) {
        $err = "Password must be at least 6 characters long";
    } else if ($password !== $confirm_password) {
        $err = "Passwords do not match";
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password_hash')";

        if ($db->query($sql)) {
            $success = "Registration successful! Please log in.";
        } else {
            $err = "Registration failed: " . $db->error;
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
    <title>AssisTechX</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

<div class="wrapper">
    <div class="container">
        <div class="form-box login">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Login</h1>

                <div class="input-box">
                    <input type="text" name="email" placeholder="Email address" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" name="submit" class="btn">Login</button>
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
                    <a href="#">Forgot password?</a>
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