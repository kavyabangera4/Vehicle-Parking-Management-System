<?php
session_start();
include('db_connect.php');

if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];
    $query = "SELECT * FROM tblvehicle WHERE ID='$vehicle_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Receipt</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 50px;
        }

        .receipt-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 500px;
            margin: auto;
            text-align: left;
            border: 2px solidrgb(12, 13, 14);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .btn {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-print {
            background: #007bff; 
            color: white;
            width: 140px;
            height: 45px;
        }

        .btn-back {
           background: #007bff; 
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        hr {
            margin: 20px 0;
            border: 1px dashed #007bff;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h2>Vehicle Parking Receipt</h2>
    <hr>
    <p><strong>Vehicle Number:</strong> <?php echo $row['VehicleNumber']; ?></p>
    <p><strong>Category:</strong> <?php echo $row['VehicleCategory']; ?></p>
    <p><strong>Entry Time:</strong> <?php echo $row['EntryTime']; ?></p>
    <p><strong>Exit Time:</strong> <?php echo $row['ExitTime']; ?></p>
    <p><strong>Total Charge:</strong> ₹<?php echo $row['charge']; ?></p>
    <hr>
</div>
    <button class="btn btn-print" onclick="window.print()">Print Receipt</button>

    <a href="user_dashboard.php" class="btn btn-back">Back</a>


</body>
</html>
