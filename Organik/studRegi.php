<?php 
// FOR STUDENT REGISTER
include 'config.php';

if(isset($_POST['signUp'])){
   /// Escape special characters in the user input to prevent SQL injection and assign the sanitized values to variables
    $studNo = $_POST['studno'];
    $studFN = $_POST['fname'];
    $studLN = $_POST['lname'];
    $studUsername = $_POST['username'];
    $studEmail = $_POST['email'];
    $studPassword = $_POST['pass'];
    $studPassword = md5($studPassword);
    $studAddress = $_POST['address'];
    $studContactNum = $_POST['contact'];
    $studBirthday = $_POST['birthday'];
    $studCollege = $_POST['college'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    if(!empty($image)){
       if($image_size > 2000000){
          $message[] = 'image size is too large!';
       }else{
          $select = mysqli_query($conn, "SELECT * FROM `studuserstbl` WHERE studEmail = '$email' AND studPassword = '$pass'") or die('query failed');

          if(mysqli_num_rows($select) > 0){
             $message[] = 'user already exist'; 
          }else{
             $insert = mysqli_query($conn, "INSERT INTO `studuserstbl`(studNo,studFN,studLN,studUsername,studEmail,studPassword,studAddress,studContactNum,studBirthday,studCollege,studProfile) VALUES('$studNo','$studFN','$studLN','$studUsername','$studEmail','$studPassword','$studAddress','$studContactNum','$studBirthday','$studCollege','$image')") or die('query failed');
  
             if($insert){
                if(!move_uploaded_file($image_tmp_name, $image_folder)){
                   $message[] = 'error in uploading image!';
                }else{
                   $message[] = 'registered successfully!';
                   header('location:login.html');//redirect to the login page
                }
             }else{
                $message[] = 'registeration failed!';
             }
          }
       }
    }else{
       $message[] = 'please upload an image!';
    }
   

}
// FOR STUDENT LOGIN 
if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['pass'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM studuserstbl WHERE studEmail='$email' and studPassword='$password'"; // check if the email and password are correct
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc(); // fetch the data from the database
    $_SESSION['studEmail']=$row['studEmail']; // store the data in the session
    header("Location: home.html");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}

?>


