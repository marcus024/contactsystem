<?php

include "auth/database/db.php";

session_start();


if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

$emailFK = mysqli_real_escape_string($conn, $_SESSION['emailAddress']);


$searchQuery = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

$sql = "SELECT * FROM contactInfo WHERE emailFK = '$emailFK' AND (contactName LIKE '%$searchQuery%' OR contactCompany LIKE '%$searchQuery%' OR contactPhone LIKE '%$searchQuery%' OR contactEmail LIKE '%$searchQuery%')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['contactName']}</td>
            <td>{$row['contactCompany']}</td>
            <td>{$row['contactPhone']}</td>
            <td>{$row['contactEmail']}</td>
            <td>
                <a href='edit_contact.php?id={$row['contact_id']}'>Edit</a> | 
                <a href='delete_contact.php?id={$row['contact_id']}'>Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No contacts found.</td></tr>";
}
?>
