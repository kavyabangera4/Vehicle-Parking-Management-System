<?php
session_start();
include('db_connect.php'); // Database Connection

if (isset($_POST['login'])) {
    $username =$_POST['username'];
    $password = $_POST['password'];

    
        $sql = "SELECT * FROM tblusers WHERE UserName='$username' AND Password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['user_name'] = $row['UserName'];
            header("Location: user_dashboard.php");
            exit();
        } else {
            $login_error = "Invalid Username or Password!";
        }
    }


if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email =$_POST['email'];
    $password =$_POST['password'];

    // Check if username already exists
    $checkUser = mysqli_query($conn, "SELECT * FROM tblusers WHERE UserName='$username'");

    if (mysqli_num_rows($checkUser) > 0) {
        $register_error = "Username already exists!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tblusers (FullName, UserName, Email, Password) 
                                       VALUES ('$fullname', '$username', '$email', '$password')");

        if ($insert) {
            echo "<script>alert('Registration Successful! You can now Login');</script>";
        } else {
            $register_error = "Registration Failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login & Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family:'Poppins', Arial, sans-serif;
            background:linear-gradient(to right, #4facfe) ;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(40, 60, 72, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: white;
        }

        input {
            padding: 10px;
            width: 90%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        button {
            background: #4facfe;
            color: white;
            padding: 10px;
            width: 94%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Login</h2>
    <?php if (isset($login_error)) echo "<p class='error'>$login_error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <hr>

    <h2>New User? Register Here</h2>
    <?php if (isset($register_error)) echo "<p class='error'>$register_error</p>"; ?>

    <form method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
</div>

</body>
</html>
