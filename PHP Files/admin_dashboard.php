<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

/*ADDING SPACE SLOT*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $status = $_POST['status'];

    // Insert into spaceslot table
    $sql = "INSERT INTO spaceslot (category, status) VALUES ('$category', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Space Slot Added Successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

$incoming_vehicles = mysqli_query($conn, "SELECT * FROM tblvehicle WHERE Status='Incoming'");
$outgoing_vehicles = mysqli_query($conn, "SELECT * FROM tblvehicle WHERE Status='Outgoing'");
$vehicle_categories = mysqli_query($conn, "SELECT * FROM tblcategory");
$registered_users = mysqli_query($conn, "SELECT * FROM tblusers");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background:linear-gradient(to right, #4facfe) ;
        }
        .sidebar {
            width: 250px;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            color: #fff;
            height: 300vh;
            text-align: center;
        }
        .sidebar h3 {
            margin-bottom: 20px;
            font-size: 24px;
            letter-spacing: 2px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            background: #4facfe;
            color: black;
            border-radius: 10px;
        }
        .sidebar a:hover {
            background: #4facfe;
            color: white;
        }
        .container {
            flex: 1;
            padding: 40px;
            text-align: center;
        }
       .space form {
            background: rgba(40, 60, 72, 0.9);
            padding: 20px;
           align-items: center;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
        }
       .space select {
            padding: 10px;
            width: 300px;
            margin: 10px;
        }
        .space button {
            padding: 10px 20px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .space button:hover {
            background: #48b1fe;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.8);;
            background: rgba(255, 255, 255, 0.3);
        }
        th {
            background:rgba(0, 0, 0, 0.8);
            color: #fff;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Admin Dashboard</h3>
    <a href="admin_dashboard.php">Incoming Vehicles 🚗</a>
    <a href="?page=outgoing">Outgoing Vehicles ✅</a>
    <a href="?page=users">Registered Users 🧑‍💻</a>
    <a href="?page=messages">User Messages 📩</a>
    <a href="?page=space">Add Space 🚗  </a>
    <a href="index.php" style="background: red;">Logout</a>
</div>
<div class="container">
<h1>Welcome Admin 🎯</h1>
<?php if (isset($_GET['page']) && $_GET['page'] == 'messages') { 
    $messages = mysqli_query($conn, "SELECT * FROM contact"); ?>
<br>
<h3>User Messages 📩</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Reply</th>
        <th>Action</th>
    </tr>
    <?php while ($msg = mysqli_fetch_assoc($messages)) { ?>
        <tr>
            <td><?php echo $msg['id']; ?></td>
            <td><?php echo $msg['name']; ?></td>
            <td><?php echo $msg['email']; ?></td>
            <td><?php echo $msg['message']; ?></td>
            <td><?php echo $msg['reply']; ?></td>
            <td>
                <form method="POST" action="reply.php">
                    <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                    <input type="text" name="reply" placeholder="Reply Here..." required>
                    <button type="submit" name="send_reply">Send</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<?php } ?> 


<?php if (isset($_GET['page']) && $_GET['page'] == 'space') {?>
    <br>
    <h3>Add Space Slot 🚗 </h3>
<br>
<div class="space">
    <form action="" method="POST">
  
        <select name="category" required>
        <option value="">Select Category</option>
            <option value="Bike">Bike</option>
            <option value="Car">Car</option>
            <option value="Truck">Truck</option>
        </select><br>
        <select name="status" required>
        <option value="">Select Status</option>
            <option value="Available">Available</option>
        </select><br>
    <br>
        <button type="submit" name="submit">Add Space</button>
    </form>
</div>
<?php } ?>
    <?php if (isset($_GET['page']) && $_GET['page'] == 'users') { ?>
    <br>
        <h3>Registered Users 🧑‍💻</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>UserName</th>
            <th>Email</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($registered_users)) { ?>
            <tr>
                <td><?php echo $user['ID']; ?></td>
                    <td><?php echo $user['FullName']; ?></td>
                    <td><?php echo $user['UserName']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                    </tr>
        <?php } ?>
    </table>
<?php } ?>

    <?php if (!isset($_GET['page'])) { ?>
        
        <br><h3>Incoming Vehicles 🚗 </h3>
        <table>
            <tr>
                <th>Vehicle No</th>
                <th>Category</th>
                <th>Entry Time</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($incoming_vehicles)) { ?>
                <tr>
                    <td><?php echo $row['VehicleNumber']; ?></td>
                    <td><?php echo $row['VehicleCategory']; ?></td>
                    <td><?php echo $row['EntryTime']; ?></td>
                    <td><a href="mark_outgoing.php?id=<?php echo $row['ID']; ?>" class="btn">Mark Outgoing</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

    <?php if (isset($_GET['page']) && $_GET['page'] == 'outgoing') { ?>
        
        <!-- #region -->
         <br><h3>Outgoing Vehicles ✅</h3>
        <table>
            <tr>
                <th>Vehicle No</th>
                <th>Category</th>
                <th>Exit Time</th>
                <th>Charge</th>
                <th>Receipt</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($outgoing_vehicles)) { ?>
                <tr>
                    <td><?php echo $row['VehicleNumber']; ?></td>
                    <td><?php echo $row['VehicleCategory']; ?></td>
                    <td><?php echo $row['ExitTime']; ?></td>
                    <td><?php echo $row['charge']; ?></td>
                    <td><a href="print_receiptadmin.php?id=<?php echo $row['ID']; ?>" class="btn">Print Receipt</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>

</body>
</html>