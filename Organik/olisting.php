<?php
// creating listing and storing in the database
include 'config.php';
session_start();
$user_id = $_SESSION['orgEmail'];
if(isset($_POST['create_listing'])){
    $listingTitle = $_POST['listingTitle'];
    $listingSub = $_POST['listingSub'];
    $listingDesc = $_POST['listingDesc'];
    $listingApply = $_POST['listingApply'];
    $listingDeadline = $_POST['listingDeadline'];
    $eventTitle = $_POST['eventTitle'];
    $eventLocation = $_POST['eventLocation'];
    $eventModality = $_POST['eventModality'];
    $eventDate = $_POST['eventDate'];
    $categName = $_POST['categName'];

    $select_query = "SELECT * FROM `listing` WHERE listingTitle='$listingTitle' AND eventDate='$eventDate'";
    $select = mysqli_query($conn, $select_query) or die(mysqli_error($conn));

    if(mysqli_num_rows($select) > 0){
        $message[] = 'Listing already exists!'; 
    } else {
        // inserting into the database BY USING THE QUERY
        $insert_query = "INSERT INTO `listing` (listingTitle, listingSub, listingDesc, listingApply, listingDeadline, eventTitle, eventLocation, eventModality, eventDate, categName) VALUES ('$listingTitle', '$listingSub', '$listingDesc', '$listingApply', '$listingDeadline', '$eventTitle', '$eventLocation', '$eventModality', '$eventDate', '$categName')";
        $insert = mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
        

        if($insert){
            $message[] = 'Listing created successfully!';
        } else {
            $message[] = 'Listing creation failed!';
        }
    }
    header('Location:orgvolun.php'); 
    exit;
}
?>
