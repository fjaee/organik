<!-- THIS IS WHERE THE ORGANIZATION LIST THEIR UPCOMING EVENTS -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organik</title>
    <link rel="stylesheet" href="css/orglisting.css">
    <!-- THIS IS FOR THE BACKGROUND IMAGE AND ITS ANIMATION -->
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
        } .container{
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
    
<!-- THIS FORM FOR ORGANIZATIONS TO LIST THEIR UPCOMING EVENTS OR VOLUNTEERING THEN IT WILL BE DIRECTED TO OLISTING.PHP -->
<main>
    <div class="container">
        <h1>Aniks</h1>
        <h3>Plant your impact in this community. Enlist help and fill in the gaps by creating opportunities through student listings.</h3>
        <form method="post" action="olisting.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="listing-title">Listing Title</label>
                <input type="text" id="listing-title" name="listingTitle" placeholder="e.g., Web Developer">
            </div>

            <div class="form-group">
                <label for="listing-subtitle">Listing Subtitle</label>
                <input type="text" id="listing-subtitle" name="listingSub" placeholder="One-sentence headline">
            </div>

            <div class="form-group">
                <label for="listing-description">Listing Description</label>
                <textarea id="listing-description" name="listingDesc" placeholder="Enter a 2 to 3 paragraph description"></textarea>
            </div>

            <div class="form-group">
                <label for="confirmation-link">Confirmation/Registration Link</label>
                <input type="url" id="confirmation-link" name="listingApply" placeholder="Your organization's form link">
            </div>

            <div class="form-group">
                <label for="listing-deadline">Listing Deadline</label>
                <input type="datetime-local" name="listingDeadline" id="listing-deadline">
            </div>

            <div class="form-group">
                <label for="event-title">Event Title</label>
                <input type="text" id="event-title" name="eventTitle" placeholder="e.g., Organicik Press Conference">
            </div>

            <div class="form-group">
                <label for="event-location">Event Location</label>
                <input type="text" id="event-location" name="eventLocation" placeholder="Floor Details, Bldg, District, City">
            </div>

            <div class="form-group">
                <label for="event-modality">Event Modality</label>
                <select id="event-modality" name="eventModality">
                    <option value="">Select modality</option>
                    <option value="on-site">On-site</option>
                    <option value="online">Online</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>

            <div class="form-group">
                <label for="event-date">Event Date</label>
                <input type="date" name="eventDate" id="event-date">
            </div>

            <div class="form-group">
                <label for="event-category">Event Category</label>
                <select id="event-category" name="categName">
                    <option value="">Select a category</option>
                    <option value="education">Education</option>
                    <option value="health">Health</option>
                    <option value="environment">Environment</option>
                    <option value="technology">Technology</option>
                    <option value="community">Community</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="create_listing">Confirm</button>
            </div>
        </form>
    </div>
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
                  <li><a class = "home" href="#">Home</a></li>
                  <li><a class = "volun" href="#">Volunteer</a></li>
                  <li><a class = "orgs" href="#">Organizations</a></li>
                </ul>
                <p>&copy; 2024 Organik. All Rights Reserved.</p>
              </div>
            </div>
        </div>
    </footer>
    

</body>
</html>
