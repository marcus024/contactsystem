<?php
session_start(); 

include "html/auth/database/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    $sql = "SELECT * FROM contactDetails WHERE emailAddress = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s",$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['emailAddress'] = $row['emailAddress']; 
            echo "<script>alert('Login successfully!'); window.location.href='main.php';</script>";
            header("Location: html/main.php");
            exit;
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('No User found with that email or username'); window.location.href='index.php';</script>";
    }
}

mysqli_close($conn);
?>
