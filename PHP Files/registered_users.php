<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$users = mysqli_query($conn, "SELECT * FROM tblusers");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
</head>
<body>
<div>
    <h2>Registered Users List</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($users)) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['FullName']; ?></td>
                <td><?php echo $row['UserName']; ?></td>
                <td><?php echo $row['Email']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
