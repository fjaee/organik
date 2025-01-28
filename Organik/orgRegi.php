<?php 
// FOR ORGANIZATION REGISTER
include 'config.php'; 

if (isset($_POST['signUpO'])) {
    $name = $_POST['orgName']; // Escape special characters in the user input to prevent SQL injection
    $link = $_POST['orgLink'];
    $username = $_POST['orgUN'];
    $email = $_POST['orgEmail'];
    $password = $_POST['pass'];
    $password_hashed = md5($password);
    $college = $_POST['college'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
// check if the image is not empty and if the image size is less than 2MB
    if(!file_exists($image_tmp_name)){
        $message[] = 'file not found!';
    }else if($image_size > 2000000){
        $message[] = 'image size is too large!';
    }else{
        // check if the user already exist
        $select = mysqli_query($conn, "SELECT * FROM `orguserstbl` WHERE orgEmail = '$email' AND orgPassword = '$pass'") or die('query failed');
        // if the user already exist
        if(mysqli_num_rows($select) > 0){
            $message[] = 'user already exist'; 
        }else{
            $insert = mysqli_query($conn, "INSERT INTO `orguserstbl`(orgName,orgLink,orgUsername,orgEmail,orgPassword,orgClass,orgLogo) VALUES('$name','$link','$username','$email','$password_hashed','$college','$image')") or die('query failed');
 
            if($insert){
                if(!move_uploaded_file($image_tmp_name, $image_folder)){
                    $message[] = 'error in uploading image!';
                }else{
                    $message[] = 'registered successfully!';
                    header('location:loginO.html');
                }
            }else{
                $message[] = 'registeration failed!';
            }
        }
    }
}
// FOR ORGANIZATION LOGIN
if (isset($_POST['signInO'])) {
    $email = $_POST['orgEmail'];
    $password = $_POST['pass'];
    $password_hashed = md5($password);
// check if the email and password are correct
    $sql="SELECT * FROM orguserstbl WHERE orgEmail='$email' and orgPassword='$password_hashed'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['orgEmail']=$row['orgEmail'];// store the data in the session
    header("Location:org.html");// redirect the user to the home page
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";// display an error message
   }

}









?>