<?php
// Include the database connection
include "auth/database/db.php";

// Start the session to access session variables
session_start();

// Check if the user email is set in the session
if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

// Prepare the SQL statement
$name = mysqli_real_escape_string($conn, $_POST['contactName']);
$company = mysqli_real_escape_string($conn, $_POST['contactCompany']);
$phone = mysqli_real_escape_string($conn, $_POST['contactPhone']);
$email = mysqli_real_escape_string($conn, $_POST['contactEmail']);
$emailFK = mysqli_real_escape_string($conn, $_SESSION['emailAddress']); // Get the email from the session

// Insert data into the database
$sql = "INSERT INTO contactInfo (contactName, contactCompany, contactPhone, contactEmail, emailFK) VALUES ('$name', '$company', '$phone', '$email', '$emailFK')";

try {
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Contact added successfully!'); window.location.href='main.php';</script>";
    } else {
        echo "<script>alert('Failed to add contact: " . mysqli_error($conn) . "'); window.location.href='main.php';</script>";
    }
} catch (mysqli_sql_exception $e) {
    echo "<script>alert('Failed to add contact: " . $e->getMessage() . "'); window.location.href='main.php';</script>";
}

// Close the database connection
mysqli_close($conn);
?>
