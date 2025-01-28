<!-- THIS IS FOR ORGANIZATION PROFILE PAGE WHERE WE CONNECT THE DATABASE AND UPDATE THE PROFILE -->
<?php

include 'config.php';
session_start();
$user_id = $_SESSION['orgEmail'];

if(isset($_POST['update_profile'])){
// Escape special characters in the user input to prevent SQL injection and assign the sanitized values to variables
   $update_orgName = mysqli_real_escape_string($conn, $_POST['orgName']);
   $update_orgEmail = mysqli_real_escape_string($conn, $_POST['orgEmail']);
   $update_orgLink = mysqli_real_escape_string($conn, $_POST['orgLink']);
 

   mysqli_query($conn, "UPDATE `orguserstbl` SET orgName = '$update_orgName', orgEmail = '$update_orgEmail', orgLink = '$update_orgLink' WHERE orgEmail = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['updatePass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
//check if any of the password fields are not empty and if the old password matches the one in the database
   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `orguserstbl` SET orgPassword = '$confirm_pass' WHERE orgEmail = '$user_id'") or die('query failed pass');
         $message[] = 'password updated successfully!';
      }
   }
//check if the update image field is not empty and if the image size is less than 2MB
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `orguserstbl` SET orgLogo = '$update_image' WHERE orgEmail = '$user_id'") or die('query failed pfp');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated successfully!';
      }
   }

}
?>
<!--    THIS IS THE ORGANIZATION PROFILE PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="studProfile.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
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
        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-family: Qanelas;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            color: #6a6a6a;
        }

        .form-group input {
            width: 80%;
            padding: 8px;
            border: none;
            border-bottom: 2px solid #ccc; 
            outline: none;
            background-color: transparent; 
            box-sizing: border-box;
            font-family: Qanelas;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            color: #000000;
        }

        .form-group input:focus {
            border-bottom: 2px solid #ae1c14; 
        }

        input {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            width: 80%;
        } .containers{
            padding: 3vh 3vh;
            background: rgba(252, 239, 227, 0.22);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(4.7px);
            -webkit-backdrop-filter: blur(4.7px);
            border: 1px solid rgba(255, 204, 173, 0.43);
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Organik</div>
    <nav>
      <a href="org.html">Home</a>
      <div class="dropdown volunteer">
        <a href="#" class="dropdown-toggle">Volunteer</a>
        <div class="dropdown-menu">
          <a href="orgvolun.php">Opportunities</a>
          <a href="orglisting.php">Listings</a>
        </div>
      </div>
      <a href="orgorg.html">Organizations</a>
      <div class="dropdown">
        <span>.</span>
        <div class="dropdown-menu">
          <a href="orgProfile.php">Account</a>
          <a href="loginO.html">Log out</a>
        </div>
      </div>
    </nav>
  </header>
<!--  THIS IS THE MAIN CONTENT -->
    <main>
        <form class="profile-container" method="post" action="" enctype="multipart/form-data">
            <div class="container">
            <div class="profile" style="text-align: left; float: left;">
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM `orguserstbl` WHERE orgEmail = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
                    $profileImage = $fetch['orgLogo'] == '' ? 'images/default-avatar.png' : 'uploaded_img/'.$fetch['orgLogo'];
                    echo '<img src="'.$profileImage.'" style="max-width: 18%; height: auto;">';
                ?>
            </div>
                <div>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "organik_db");
                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }
                    
                    // Check if the user is logged in
                    if (isset($_SESSION['orgEmail'])) {
                        $loggedInUsername = $_SESSION['orgEmail'];
                    
                        // Prepare the SQL query
                        $sql = "SELECT * FROM orguserstbl WHERE orgEmail = ?";
                        $stmt = $conn->prepare($sql);
                        if (!$stmt) {
                            die("Prepared statement failed: " . $conn->error);
                        }
                        $stmt->bind_param("s", $loggedInUsername);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                    
                            // Display user data
                            echo '<h1>' . htmlspecialchars($row['orgName'], ENT_QUOTES, 'UTF-8') . '</h1>';
                            echo '<p>' . htmlspecialchars('@' . $row['orgUsername'], ENT_QUOTES, 'UTF-8') . '</p>';
                            echo '<p>' . htmlspecialchars($row['orgClass'], ENT_QUOTES, 'UTF-8') . '</p>';
                        } else {
                            echo "<h1>User not found</h1>";
                        }
                    }
                    ?>
                    <p>0 Aniks claimed</p>
                </div>
                <div class="container">

            </div>
            <div class="containers">
            <div  class="profile-info">
                <div class="form-group">
                    <label for="student-no">Organization Name</label>
                    <input type="text" id="student-no" name="orgName" value="<?php echo htmlspecialchars($row['orgName']); ?>">
                </div>
                <div class="form-group">
                    <label for="first-name">Organization Email</label>
                    <input type="text" id="first-name" name="orgEmail" value="<?php echo htmlspecialchars($row['orgEmail']); ?>">
                </div>
                </div>
                <div class="form-group">
                    <label for="password">OrganizationPassword</label>
                    <input type="password" id="password" name="old_pass" placeholder="" value="<?php echo htmlspecialchars($row['orgPassword']); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" id="password" name="updatePass" placeholder="Enter your old password">
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="new_pass" placeholder="Update your password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="password" name="confirm_pass" placeholder="Confirm your password">
                </div>
                <div class="form-group">
                    <label for="student-no">Organization Link</label>
                    <input type="text" id="student-no" name="orgLink" value="<?php echo htmlspecialchars($row['orgLink']); ?>">
                </div>
                <div class="form-group">
                    <label for="pfp">Profile Picture</label>
                    <input type="file" id="pfp" name="update_image" placeholder="Insert your profile picture" class="box" accept="image/jpg, image/jpeg, image/png">
                </div>
            </div>
            <div class="profile-actions">
                <button type="submit" name="update_profile" id="edit-btn">Edit Profile</button>
                <button type="button" name="delete_profile" id="delete-btn">Delete Profile</button>
            </div>
            
        </form>
        </div>
        <script>
            document.getElementById('delete-btn').addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this profile?')) {
                    document.querySelector('.profile-info p').remove();
                }
            });
        </script>
    </main>

    <footer class="organik-footer">
        <div class="footer-content">
            <div class="footer-left">
                <h1 class="logo">Organik</h1>
                <h3> Organic communities.<br></h3>
                <h3>Organic experiences.<br></h3>    
                <h3>Organic growth.</h3>
                <div class="privacy-links">
                  <a class="link1" href="#">Privacy Policy</a> | <a class="link2" href="#">Terms of Service</a>
                </div>
              </div>
              <div class="footer-right">
                <ul>
                  <li><a class="home" href="#">Home</a></li>
                  <li><a class="volun" href="#">Volunteer</a></li>
                  <li><a class="orgs" href="#">Organizations</a></li>
                </ul>
                <p>&copy; 2024 Organik. All Rights Reserved.</p>
              </div>
            </div>
        </div>
    </footer>

</body>
</html>
