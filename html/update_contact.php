<?php 
session_start();
include "auth/database/db.php";

// Check if the user email is set in the session
if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contactId = mysqli_real_escape_string($conn, $_POST['contact_id']);
    $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
    $contactCompany = mysqli_real_escape_string($conn, $_POST['contactCompany']);
    $contactPhone = mysqli_real_escape_string($conn, $_POST['contactPhone']);
    $contactEmail = mysqli_real_escape_string($conn, $_POST['contactEmail']);

    // Update the contact in the database
    $sql = "UPDATE contactInfo SET 
                contactName = '$contactName', 
                contactCompany = '$contactCompany', 
                contactPhone = '$contactPhone', 
                contactEmail = '$contactEmail' 
            WHERE contact_id = '$contactId' AND emailFK = '{$_SESSION['emailAddress']}'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Contact updated successfully.'); window.location.href='main.php';</script>";
    } else {
        echo "<script>alert('Error updating contact: " . mysqli_error($conn) . "'); window.location.href='main.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='main.php';</script>";
    exit();
}
?>
