<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background:linear-gradient(to right, #4facfe) ;
            text-align: center;
            padding: 50px;
        }
        form {
            background: rgba(40, 60, 72, 0.9);
            padding: 30px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            display: inline-block;
            max-width: 500px;
            width: 150%;
        }
        input, textarea {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>📞 Contact Us</h1>
<form action="contact_action.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <input type="email" name="email" placeholder="Your Email" required><br>
    <textarea name="message" placeholder="Your Message" rows="5" required></textarea><br>
    <button type="submit" name="submit">Send Message</button>
</form>

<br>
<a href="user_dashboard.php">Back</a>
</body>
</html>
