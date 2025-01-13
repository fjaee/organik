<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $studno = mysqli_real_escape_string($conn, $_POST['studno']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, username, email, studno, password) VALUES('$name','$username','$email','$studno','$pass')";
         mysqli_query($conn, $insert);
         header('location:cr_acc.php');
      }
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
    <title>Let's Get Started</title>
    <link rel="stylesheet" href="cr_acc.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img class="logo" src="./images/OrganikLogo.png">
            </div>
            <a class="custom-subtitle">Set up your account.</a>
        </div>
    <form>
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" type="text" id="username" required placeholder="Enter a unique username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" id="email" required placeholder="Your email address here">
        </div>
        <div class="form-group">
            <label for="student-no">Student No.</label>
            <input name="studno" type="text" id="student-no" required placeholder="PUPSIS number (e.g., 2020-12345-MN-0)">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="pass" type="password" id="password" required placeholder="Password">
            <img src="./images/eye-hide-svgrepo-com.png" id="togglePassword">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input name="cpass" type="password" id="cpassword" required placeholder="Confirm Password">
            <img src="./images/eye-hide-svgrepo-com.png" id="togglePassword">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" id="name" required placeholder="Your full name here">
        </div>
        <div class="checkbox">
            <label>
            <input type="checkbox" id="terms"> I agree to the Terms and Conditions.
            </label>
        <div class="submit-container">
            <button type="submit" name="submit" class="signup-button">Sign up</button>
        </div>
    </form>
    </div>
    <div class="footer">
        <div class="legal">
            <a href="#" class = 'fp'>Forgot password?</a>
            <a href="#" class = 'pp'>Privacy Policy</a>
            <a href="#" class = 'ts'>Terms of Service</a>
            <a class = 'cc'>&copy; Organik 2024</a>
        </div>
    </div>     
    <script src="cr_acc.js"></script>
</body>
</html>
