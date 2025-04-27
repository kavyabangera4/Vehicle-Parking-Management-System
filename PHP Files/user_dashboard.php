<?php
session_start();
echo "User ID: " . $_SESSION['user_id']; // Debug session

include('db_connect.php'); // Ensure this file properly connects to the database

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
// Handle form submission for adding a vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleNumber = $_POST['vehicleNumber'];
    $ownerName = $_POST['ownerName'];
    $mobile = $_POST['mobile'];
    $category = $_POST['category'];

    // Set parking charge based on vehicle category
    $charge = ($category == 'Bike') ? 50 : (($category == 'Car') ? 100 : 200);

    // Check if vehicle number already exists
    $checkVehicle = mysqli_query($conn, "SELECT * FROM tblvehicle WHERE VehicleNumber='$vehicleNumber'");

    if (mysqli_num_rows($checkVehicle) > 0) {
        echo "<script>alert('Error: This vehicle number is already registered!');</script>";
    } else {
        // Check for available parking space
        $checkSpace = mysqli_query($conn, "SELECT * FROM spaceslot WHERE category='$category' AND status='Available' LIMIT 1");

        if (mysqli_num_rows($checkSpace) > 0) {
            $slot = mysqli_fetch_assoc($checkSpace);
            $slotID = $slot['spaceslotID'];

            // Insert vehicle details into the database
            $insert = mysqli_query($conn, "INSERT INTO tblvehicle (VehicleNumber, OwnerName, MobileNumber, VehicleCategory, Status, EntryTime, charge, slotID,UserID) 
                                           VALUES ('$vehicleNumber', '$ownerName', '$mobile', '$category', 'Incoming', NOW(), '$charge', '$slotID','$user_id')");

            if ($insert) {
                // Update space status
                mysqli_query($conn, "UPDATE spaceslot SET status='Occupied' WHERE spaceslotID='$slotID'");
                echo "<script>alert('Vehicle Added Successfully!');</script>";
            } else {
                echo "<script>alert('Error adding vehicle!');</script>";
            }
        } else {
            echo "<script>alert('No Parking Space Available');</script>";
        }
    }
} // ✅ This was missing earlier

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            background: linear-gradient(to right, #4facfe);
            margin: 0;
        }
        .container {
            flex: 1;
            padding: 40px;
            text-align: center;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #283C48;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            color: white;
            background: #4facfe;
            text-align: center;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #48b1fe;
        }
        .content {
            margin-left: 270px;
            padding: 50px;
            text-align: center;
            width: 100%;
        }
        form {
            margin-left: 100px;
            background: rgba(40, 60, 72, 0.9);
            padding: 20px;
           align-items: center;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
        }
        input, select {
            padding: 10px;
            width: 300px;
            margin: 10px;
        }
        button {
            padding: 10px 20px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #48b1fe;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            margin-left: 230px;
        }
        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.8);;
            background: rgba(255, 255, 255, 0.3);
        }
        th {
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
        }
        h3,h1{
            margin-top: 5px;
            text-align: center;
            margin-left: 100px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>🚗 User Panel</h2>
    <a href="?page=add">Add Vehicle 🚗</a>
    <a href="?page=status">Check Status ✅</a>
    <a href="?page=messages">Messages 📩</a>
    <a href="contact.php">Contact Us 📞</a>
    <a href="index.php" style="background: red;">Logout</a>
</div>

<div class="container">
    <h1>Welcome User 🎯</h1>

    <?php if (!isset($_GET['page'])) { ?>
     
    <?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] == 'add') { ?>
        <h3>Add Vehicle 🚗 </h3>
        <form method="POST" action="">
            <input type="text" name="vehicleNumber" placeholder="Vehicle Number" required><br>
            <input type="text" name="ownerName" placeholder="Owner Name" required><br>
            <input type="text" name="mobile" placeholder="Mobile Number" required><br>
            <select name="category" required>
                <option value="">Select Category</option>
                <option value="Bike">Bike</option>
                <option value="Car">Car</option>
                <option value="Truck">Truck</option>
            </select><br><br>
            <button type="submit">Add Vehicle</button>
        </form>
    <?php } ?>

    <?php if (isset($_GET['page']) && $_GET['page'] == 'status') { ?>
        <h3>Check Vehicle Status 🚗 </h3>
        <table>
            <thead>
                <tr>
                    <th>Vehicle Number</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id']; // Get logged-in user ID
                $result = mysqli_query($conn, "SELECT * FROM tblvehicle WHERE UserID='$user_id'");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['VehicleNumber']); ?></td>
                            <td><?= htmlspecialchars($row['VehicleCategory']); ?></td>
                            <td><?= htmlspecialchars($row['Status']); ?></td>
                            <td>
                                <?php if ($row['Status'] == 'Outgoing') { ?>
                                    <a href="print_receiptuser.php?id=<?= $row['ID']; ?>" target="_blank">
                                        <button>Print Receipt</button>
                                    </a>
                                <?php } else {
                                    echo "No Receipt";
                                } ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="4">No vehicles found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
<?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] == 'messages') { ?>
        <h3>Admin Messages 📩</h3>
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $msgs = mysqli_query($conn, "SELECT * FROM contact WHERE UserID='$user_id'");
                while ($msg = mysqli_fetch_assoc($msgs)) { ?>
                    <tr>
                        <td><?= $msg['message']; ?></td>
                        <td><?= $msg['reply'] ?: "No Reply Yet"; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

</body>
</html>
