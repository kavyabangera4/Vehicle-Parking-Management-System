<?php
session_start();
include('db_connect.php');
date_default_timezone_set('Asia/Kolkata'); // Set Indian Timezone

if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];
    $exit_time = date("Y-m-d H:i:s"); // Current Exit Time

    // Fetch Entry Time, Vehicle Category, and SlotID
    $query = "SELECT EntryTime, VehicleCategory, slotID FROM tblvehicle WHERE ID='$vehicle_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row || empty($row['EntryTime'])) {
        echo "<script>alert('Error: Entry time not found!'); window.location='admin_dashboard.php';</script>";
        exit();
    }

    $entry_time = strtotime($row['EntryTime']);
    $current_time = strtotime($exit_time);
    $hours = ceil(($current_time - $entry_time) / 3600); // Calculate Total Hours

    // Charge rates
    $charge_rates = [
        'Car' => 100,
        'Bike' => 50,
        'Truck' => 200
    ];

    $category = $row['VehicleCategory'];
    $slot_number = $row['slotID'];
    $charge = isset($charge_rates[$category]) ? $hours * $charge_rates[$category] : 0;

    // Minimum 1 Hour Charge
    if ($charge < $charge_rates[$category]) {
        $charge = $charge_rates[$category];
    }

    // Update vehicle status
    $update_vehicle = "UPDATE tblvehicle SET Status='Outgoing', ExitTime='$exit_time', Charge='$charge' WHERE ID='$vehicle_id'";

    if (mysqli_query($conn, $update_vehicle)) { // Update spaceslot table to make slot Available
     $update_slot = "UPDATE spaceslot SET Status='Available' WHERE spaceslotID='$slot_number'"; mysqli_query($conn, $update_slot);
     echo "<script>alert('Vehicle marked as outgoing successfully ✅. Charge: ₹$charge'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error updating vehicle: " . mysqli_error($conn) . "');</script>";
    }
} ?>    
