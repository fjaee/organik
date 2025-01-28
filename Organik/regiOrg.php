<!-- THIS IS WHERE THE ORGANIZATION SETS UP THEIR ACCOUNT -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- THIS IS FOR THE BACKGROUND AND ITS ANIMATION -->
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
  <title>[For Org] - Setup Your Account</title>
  <link rel="stylesheet" href="css/regiOrg.css">
</head> 
<body>
  <!-- THIS JS SCRIPT CHECKS IF THE USER FILL OUT ALL THE REQUIRED FIELDS, IT WILL RETURN A PROMPT IF THE USER DOESN'T FILL OUT ALL THE REQUIRED FIELDS AND IT WILL ALSO REDIRECT THE USER TO THE LOGIN PAGE -->
  <script>
    function validateForm() {
        // Get the form and input values
        const form = document.getElementById("myForm");
        const name = document.getElementById("orgName").value;
        const link = document.getElementById("orgLink").value;
        const orgname = document.getElementById("orgUN").value;
        const email = document.getElementById("orgEmail").value;
        const pass = document.getElementById("pass").value;
        const college = document.getElementById("college").value;
        const pfp = document.getElementById("pfp").value;

        // Check if fields are empty
        if (name === "" || email === "" || link === "" || orgname === "" || pass === "" || college === "" || pfp === "") {
            alert("Please fill out all required fields!");
        } else {
            form.submit(); 
            alert("Your organization account has been successfully created!");
            window.location.href = "loginO.html";
        }
    }
  </script>
  <!-- THIS IS THE FORM FOR ORGANIZATIONS -->
  <div class="container">
    <div class="left-section">
      <div class="logo">
        <img class="logo" src="images/OrganikLogo.png">
    </div>
    <a class="custom-subtitle">Set up your account.</a>
    </div>
    <div class="right-section">
      <form method="post" action="orgRegi.php" id="myForm" name="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">
        <div class="form-group">
          <label for="student-no">Organization Name</label>
          <input type="text" id="orgName" name="orgName" required placeholder="Enter the full registered name of your org">
        </div>
        <div class="form-group">
          <label for="first-name">Facebook Page</label>
          <input type="text" id="orgLink" name="orgLink" required placeholder="Enter the link of your org’s Facebook page">
        </div>
        <div class="form-group">
          <label for="last-name">Username</label>
          <input type="text" id="orgUN" name="orgUN" required placeholder="Enter a unique username">
        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="text" id="orgEmail" name="orgEmail" required placeholder="Your org’s email address here">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="pass" name="pass" placeholder="Set a strong, unique password" required>
          <img src="images/eye-hide-svgrepo-com.png" id="togglePassword">
          
        </div>
    
        <div class="form-group">
          <label for="college">College/Type</label>
          <select id="college" name="college">
            <option value="">Select the college your org is under</option>
            <option value="University-Wide">University-Wide</option>
            <option value="College of Accountancy and Finance (CAF)">College of Accountancy and Finance (CAF)</option>
            <option value="College of Architecture, Design and the Built Environment (CADBE)">College of Architecture, Design and the Built Environment (CADBE)</option>
            <option value="College of Arts and Letters (CAL)">College of Arts and Letters (CAL)</option>
            <option value="College of Business Administration (CBA)">College of Business Administration (CBA)</option>
            <option value="College of Communication (COC)">College of Communication (COC)</option>
            <option value="College of Computer and Information Sciences (CCIS)">College of Computer and Information Sciences (CCIS)</option>
            <option value="College of Education (COED)">College of Education (COED)</option>
            <option value="College of Engineering (CE)">College of Engineering (CE)</option>
            <option value="College of Human Kinetics (CHK)">College of Human Kinetics (CHK)</option>
            <option value="College of Law (CL)">College of Law (CL)</option>
            <option value="College of Political Science and Public Administration (CPSPA)">College of Political Science and Public Administration (CPSPA)</option>
            <option value="College of Social Sciences and Development (CSSD)">College of Social Sciences and Development (CSSD)</option>
            <option value="College of Science (CS)">College of Science (CS)</option>
            <option value="College of Tourism, Hospitality and Transportation Management (CTHTM)">College of Tourism, Hospitality and Transportation Management (CTHTM)</option>
            <option value="Institute of Technology (ITECH)">Institute of Technology (ITECH)</option>
          </select>
        </div>

        <div class="form-group">
          <label for="pfp">Profile Picture</label>
          <input type="file" id="pfp" name="image" placeholder="Insert your profile picture" required class="box" accept="image/jpg, image/jpeg, image/png">
        </div>
        <div class="form-group">
          <button class="signup-btn" onclick="validateForm()" name="signUpO">Sign up</button>
        </div>

      </form>
    </div>
  </div>
  <div class="navigation">
      <button class="nav-btn"><a href="cr_acc.html">&larr;</a></button>
    <span>2 of 2</span>
     <button type="submit" onclick="validateForm()" class="nav-btn"></button>
  </div>
  <script src="js/regiOrg.js"></script>
</body>
</html>
