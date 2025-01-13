<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $studno = mysqli_real_escape_string($conn, $_POST['studno']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

    else{
      $error[] = 'incorrect email or password!';
    }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/OrgIcon.png" type="image/png">
    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background-image: url('images/Background Pattern.jpg');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            animation: zoomInOut 15s infinite;
        }

        @keyframes zoomInOut {
            0% {
                background-size: 100%; 
            }
            50% {
                background-size: 110%; 
            }
            100% {
                background-size: 100%;
            }
        }

    </style>
    <title>Organik</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="header">
                <div class="logo">
                    <img class="logo" src="./images/OrganikLog1.png">
                </div>
                <a class="custom-subtitle">Start connecting with your orgmates.</a>
            </div>
            <form>
                <div class="email-container">
                <input type="email" id="email" name="email" required placeholder="Email or username">
                </div>
                <div class="password-container">
                    <input type="password" id="password" name="password" required placeholder="Password">
                    <img src="./images/eye-hide-svgrepo-com.png" id="togglePassword">
                </div>
                <div class="submit-container">
                    <button type="submit" name="submit" class="login-button">Login</button>
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox"> Keep me signed in
                    </label>
                </div>
            </form>
            <div class="footer-links">
                <div class="dha">
                    <a>Don't have an account yet?</a>
                </div>
                <div class="rn">
                    <a href="#">Register Now!</a> 
                </div>
            </div>   
        </div>
            <div class="legal">
                <a href="#" class = "fp">Forgot password?</a>
                <a href="#" class = "pp">Privacy Policy</a>
                <a href="#" class = "ts">Terms of Service</a>
                <a class = "cc">&copy; Organik 2024</a>
            </div>
    </div>
    
    <script src="login.js"></script>
</body>
</html>



