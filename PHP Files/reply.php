<?php
session_start();
include('db_connect.php'); // Ensure database connection is included

if (isset($_POST['send_reply'])) {
    $id = $_POST['id'];
    $reply = $_POST['reply']; 

    // Ensure ID is an integer 
    $id = intval($id);

    $update_query = "UPDATE contact SET reply='$reply', status='Read' WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Reply Sent Successfully!'); window.location.href='admin_dashboard.php?page=messages';</script>";
        exit(); // Ensure script stops execution after redirection
    } else {
        echo "<script>alert('Error sending reply: " . mysqli_error($conn) . "');</script>";
    }
}
?>
