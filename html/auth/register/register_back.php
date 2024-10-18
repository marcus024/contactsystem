<?php
include "../database/db.php"; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required!";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        return;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        return;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO contactDetails (name, emailAddress, password, confirmPassword) VALUES ('$name', '$email', '$hashed_password','$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registered Successfully'); window.location.href='index.php';</script>";
        header("Location: ../../../index.php"); 
        exit(); 
    } else {
        echo "<script>alert('Duplicate Email'); window.location.href='index.php';</script>";
    }
}

mysqli_close($conn); 
?>
