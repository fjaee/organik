<!-- THIS IS THE STUDENT VOLUNTEER PAGE   -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organik</title>
    <link rel="stylesheet" href="css/studvolun.css">
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
<!-- THIS IS THE NAVIGATION BAR   -->
    <header class="navbar">
        <div class="logo">Organik</div>
            <nav class="">
                <a href="home.html">Home</a>
                <a href="studvolun.php">Volunteer</a>
                <a href="studorg.html">Organizations</a>
                <div class="dropdown">
                    <span>.</span>
                    <div class="dropdown-menu">
                        <a href="studProfile.php">Account</a>
                        <a href="login.html">Log out</a>
                    </div>
                </div>
            </nav>
        </div>
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
          <br><br><br>
          <p>
            Plant your impact in this community. Be part of the team behind-the-scenes.
            Join as a volunteer, speaker, or resource contributor.
          </p>
          <!-- THIS IS FOR THE BUTTON TO CREATE A NEW LISTING   -->
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
    
        
          <div class="cards">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "organik_db");
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            session_start(); // Ensure the session is started

            // Check if the user is logged in
            if (isset($_SESSION['studEmail'])) {
                $loggedInUsername = $_SESSION['studEmail'];

                // Fetch all listings
                $sql = "SELECT * FROM listing";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Prepared statement failed: " . $conn->error);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                        ?>
                        <!-- THIS IS FOR THE CARDS OF THE LISTINGS   -->
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
                                <button onclick="applyPrompt(this)">Apply</button>
                              <script>
                                  function applyPrompt(element) {
                                      // Find the closest parent container and get the listing title
                                      const card = element.closest('.card');
                                      const listingTitle = card ? card.querySelector('h3')?.textContent : null;
                                      // Prompt the user to apply
                                      if (!listingTitle) {
                                          alert('Error: Unable to find the listing title.');
                                          return;
                                      }
                                      // Show confirmation dialog
                                      const confirmation = confirm(`Are you sure you want to apply for ${listingTitle}?`);
                                      if (confirmation) {
                                          // Show disclaimer confirmation
                                          const disclaimerAccepted = confirm(
                                              `Disclaimer: Claiming this listing in Organik does not guarantee your slot in ${listingTitle}. Do you accept this disclaimer?`
                                          );
                                          // If disclaimer is not accepted, cancel the application
                                          if (!disclaimerAccepted) {
                                              alert('Application cancelled due to disclaimer rejection.');
                                              return;
                                          }
                                          // Ask for final approval
                                          const approve = prompt(`Type "yes" if you want to apply for ${listingTitle}:`);
                                          if (approve === null || approve.trim() === '') {
                                              alert('Application cancelled.');
                                          } else if (approve.toLowerCase() === 'yes') {
                                              alert(`Application submitted for ${listingTitle}.\nYou have accepted the disclaimer.`);
                                          } else {
                                              alert('Application cancelled. You did not type "yes".');
                                          }
                                      }
                                  }
                              </script>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<h1>No listings found</h1>";
                }
                $stmt->close();
            } else {
                echo "<h1>Please log in to view listings.</h1>";
            }

            $conn->close();
            ?>
        </div>
        </div>
        <div id="modal" class="modal" onclick="closeModal(event)">
            <div class="modal-content">
            <span id="modal-close" class="modal-close" onclick="closeModal(event)">&times;</span>
            <div id="modal-body"></div>
            </div>
        </div>
        </section>
      </main>
    <!-- THIS IS FOR THE FOOTER   -->
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
                  <li><a class = "home" href="#">Home</a></li>
                  <li><a class = "volun" href="#">Volunteer</a></li>
                  <li><a class = "orgs" href="#">Organizations</a></li>
                </ul>
                <p>&copy; 2024 Organik. All Rights Reserved.</p>
              </div>
            </div>


           

        </div>
    </footer>
    
    <script src="studvolun.js"></script>
</body>
</html>
