<?php
session_start();
include('db_connect.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to send a message.");
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // Get UserID from session
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into contact table
    $sql = "INSERT INTO contact (UserID, name, email, message, status) VALUES ('$user_id', '$name', '$email', '$message', 'Unread')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message Sent Successfully!'); window.location='contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message: " . mysqli_error($conn) . "');</script>";
    }
}
?>
