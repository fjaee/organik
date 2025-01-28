<!-- THIS IS THE ORGANIZATION VOLUNTEER PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organik</title>
    <link rel="stylesheet" href="orgvolun.css">
<!-- THIS IS FOR THE BACKGROUND AND ITS ANIMATION -->
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

    </style>


</head>
<body>

     <header>
        <div class="logo">Organik</div>
        <nav>
          <a href="org.html">Home</a>
          <div class="dropdown volunteer">
            <a href="" class="dropdown-toggle">Volunteer</a>
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
    <main>
        <section class="listings">
          <h2>Aniks</h2>
          <br>
          <style>
            a {
              text-decoration: none;
              margin-top: 1rem;
            }
            .button{
              margin: auto;
              width:40%;
              padding: 10px 20px;
              border: 2px solid #A31B1B;
              background: transparent;
              color: #A31B1B;
              font-family: Qanelas;
              font-size: 14px;
              font-style: normal;
              font-weight: 700;
              border-radius: 20px;
              cursor: pointer;
          }

          .button:hover {
              background: #A31B1B;
              color: #fff;
          }
          
          </style>
          <!-- THIS IS FOR THE BUTTON TO CREATE A NEW LISTING -->
          <a href="orglisting.php" class="button">New Listings</a>
          <br><br><br>
          <p>
            Plant your impact in this community. Be part of the team behind-the-scenes.
            Join as a volunteer, speaker, or resource contributor.
          </p>
          <!-- THIS IS FOR THE FILTERS FOR THE LISTINGS -->
          <div class="filters">
            <select>
              <option value="organization">Organization</option>
            </select>
            <select>
              <option value="category">Category</option>
            </select>
            <select>
              <option value="modality">Modality</option>
            </select>
            <select>
              <option value="sort">Sort</option>
            </select>
          </div>
     
        
          <style>
            .cards {
              display: flex;
              flex-direction: column;
              align-items: center;
              gap: 40px;
              margin-top: 20px;
            }
          </style>
          <!-- THIS IS FOR THE CARDS OF THE LISTINGS -->
          <div class="cards">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "organik_db");
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            session_start(); // Ensure the session is started

            // Check if the user is logged in
            if (isset($_SESSION['orgEmail'])) {
                $loggedInUsername = $_SESSION['orgEmail'];

                // Fetch all listings
                $sql = "SELECT * FROM listing";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Prepared statement failed: " . $conn->error);
                }
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if there are any results and display them
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <!-- THIS IS FOR THE CARDS OF THE LISTINGS IN THE DATABASE -->
                        <div class="card" onclick="openModal(this)">
                            <h3><?= htmlspecialchars($row['listingTitle'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><strong><?= htmlspecialchars($row['eventTitle'], ENT_QUOTES, 'UTF-8') ?></strong></p>
                            <p><strong><?= htmlspecialchars($row['listingSub'], ENT_QUOTES, 'UTF-8') ?></strong> • <?= htmlspecialchars($row['eventDate'], ENT_QUOTES, 'UTF-8') ?></p>
                            <p>Tags: <span><?= htmlspecialchars($row['categName'], ENT_QUOTES, 'UTF-8') ?></span>, <span><?= htmlspecialchars($row['eventModality'], ENT_QUOTES, 'UTF-8') ?></span></p>
                            <p><strong>Location:</strong> <?= htmlspecialchars($row['eventLocation'], ENT_QUOTES, 'UTF-8') ?></p>
                            <p><strong>Expires:</strong> <?= htmlspecialchars($row['listingDeadline'], ENT_QUOTES, 'UTF-8') ?></p>
                            <div class="additional-info" style="display: none;">
                                <p><strong>More Details:</strong> <?= htmlspecialchars($row['listingDesc'], ENT_QUOTES, 'UTF-8') ?></p>
                                <p>Requirements: <?= htmlspecialchars($row['listingApply'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<h1>No listings found</h1>";
                }
                $stmt->close();
            } else {
                echo "<h1>Please log in to view listings.</h1>";// Display a message if the user is not logged in
            }

            $conn->close();
            ?>
        </div>


        </div>
        <!-- THIS IS FOR THE MODAL OF THE LISTINGS -->
        <div id="modal" class="modal" onclick="closeModal(event)">
            <div class="modal-content">
            <span id="modal-close" class="modal-close" onclick="closeModal(event)">&times;</span>
            <div id="modal-body"></div>
            </div>
        </div>
  
        </section>
      </main>
    


    <footer class="organik-footer">
        <div class="footer-content">
            <div class="footer-left">
                <h1 class="logo">Organik</h1>
                <h3> Organic communities.<br></h3>
                <h3>Organic experiences.<br></h3>    
                <h3>Organic growth.</h3>
                <div class="privacy-links">
                  <a class = "link1" href="#">Privacy Policy</a> | <a class = "link2" href="#">Terms of Service</a>
                </div>
              </div>
              <div class="footer-right">
                <ul>
                <li><a class = "home" href="org.html">Home</a></li>
                  <li><a class = "volun" href="orgvolun.php">Volunteer</a></li>
                  <li><a class = "orgs" href="orgorg.html">Organizations</a></li>
                </ul>
                <p>&copy; 2024 Organik. All Rights Reserved.</p>
              </div>
            </div>


           

        </div>
    </footer>
    
    <script src="js/orgvolun.js"></script>
</body>
</html>
