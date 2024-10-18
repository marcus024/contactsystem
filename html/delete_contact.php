<?php 
session_start();
include "auth/database/db.php";

if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_id'])) {
    $contactId = mysqli_real_escape_string($conn, $_POST['contact_id']);

    $sql = "DELETE FROM contactInfo WHERE contact_id = '$contactId' AND emailFK = '{$_SESSION['emailAddress']}'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Contact deleted successfully.'); window.location.href='main.php';</script>";
    } else {
        echo "<script>alert('Error deleting contact: " . mysqli_error($conn) . "'); window.location.href='main.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='main.php';</script>";
    exit();
}
?>
