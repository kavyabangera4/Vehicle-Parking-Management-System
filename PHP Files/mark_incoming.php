<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];

    // Update Vehicle Status to Incoming
    mysqli_query($conn, "UPDATE tblvehicle SET Status='Incoming' WHERE ID='$vehicle_id'");

    echo "<script>alert('Vehicle Accepted'); window.location='admin_dashboard.php';</script>";
}
?>
