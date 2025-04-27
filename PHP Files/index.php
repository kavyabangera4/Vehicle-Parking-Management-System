<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Parking Management System</title>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #f0f0f0, #ffffff);
            text-align: center;
        }

        header {
            background: rgba(40, 60, 72, 0.9); /* Dark Blue + Gray mix */

            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        #logo {
            width: 70px;
            height: 70px;
            border-radius: 20%;
            margin-left: 30px;
        }

        header h1 {
            font-weight: bold;
            
            margin-left: 20px;
            flex-grow: 1;
            margin-left:80px ;
            text-align: center;
        }

        header nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover{
            color:rgb(186, 203, 215);
        }
        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 40px;
            padding: 30px;
            background:linear-gradient(to right,rgb(190, 200, 208)) ;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
            transition: transform 0.5s ease;
        }

        .row img {
            width: 250px;
            border-radius: 10px;
        }
        .row #img1 {
    width: 100%; /* Image will fit full section width */
    height: 400px; /* Maintain original aspect ratio */
    object-fit: cover; /* Crop the image nicely if bigger */
    border-radius: 10px; /* Optional for rounded corners */
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3); /* Shadow effect */
}     
        footer {
            background:rgba(40, 60, 72, 0.9);
            padding: 30px;
            margin-top: 30px;
            height:90px ;
            text-align: center;
            color: white;
        }

        footer .social img {
            width: 20px;
            margin: 0 10px;
            transition: transform 0.3s;
        }

        footer .social img:hover {
            transform: scale(1.3);
        }

        
        .shadow-box {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3); /* Outer Shadow */
    padding: 40px;
    margin: 40px;
    border-radius: 20px; /* Round corner */
    animation: fadeIn 2s ease-in-out; /* Fade in Animation */
    transition: transform 0.5s ease; /* Hover effect */
    background:linear-gradient(to right,rgb(199, 203, 207)) ; /* White Transparent Background */
}

#box {
    display: flex; 
    justify-content: space-between; 
    flex-wrap: wrap; 
    gap: 20px;
}

.service {
    width: 22%; /* Each box width */
    padding: 20px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    background:linear-gradient(to right,rgb(197, 206, 214)) ;
    box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.5s ease; /* Hover effect */
}

.service:hover {
    transform: scale(1.05); /* Hover Zoom effect */
}
.shadow-box:hover {
    transform: scale(1.05); /* Hover Zoom effect */
}
.row:hover {
    transform: scale(1.05); /* Hover Zoom effect */
}

/* Fade-In Animation */




p {
    font-size: 16px;
    color: #333;
    line-height: 2; 
}
#service{
    display: flex;
    align-items: center;
}
        div p{
            align-items: center;
        }
        #left{ margin-left: 120px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<header>
    <img id="logo" src="images/logo.jpg" alt="Logo">
    <h1>Vehicle Parking  Management  System</h1>
    <nav>
        <a href="admin_login.php">Admin</a>
        <a href="user_login.php">User</a>
    </nav>
</header>
<br>
<!-- About Section -->

<section class="about">
    <div id="about">
            <h2 style="font-size:30px;color: rgba(40, 60, 72, 0.9);">About Our Parking System</h2>
            <br>
            <p style="font-weight:bold">Our Vehicle Parking Management System helps you park your vehicles easily and efficiently. Whether you have a <b>Bike</b>, <b>Car</b>, or <b>Truck</b>, we provide safe and<br> affordable parking services.</p>
        </div>
    <div class="row">
        <img id="img1" src="images/slider2.jpg" alt="Parking">
    </div>

        
    </div>
</section>
<div class="shadow-box">
<h2 style="font-size:30px;color: rgba(40, 60, 72, 0.9);">Services Available:</h2><br>

    <div id="box">
        <div class="service">
            <p id="service">✅ Driver Assistance<br>✅ Priority Parking Slot<br>✅ 24/7 Security<br>✅ Fast Exit</p>
        </div>

        <div class="service">
            <p id="service">✅ EV Charging Station<br>✅ Fast Charging Point<br>✅ Green Energy<br>  ✅ Available for Cars & Bikes</p>
        </div>

        <div class="service">
            <p id="service">✅ Secure & Covered Parking<br>✅ High Security<br> ✅ Priority Booking<br>✅ Separate Entry & Exit</p>
        </div>

        <div class="service">
            <p id="service">✅ Book Parking Slot through Site<br>
            ✅ Automatic Slot Allotment</p>
        </div>
    </div>
</div>


<!-- Bike Section -->
<section>
    <div class="row">
        <img src="images/bike.jpg" alt="Bike">
        <div>
            <h3>🚲 Bike Parking</h3>
            <p>Charges ₹50 per hour with secure slots.</p>
        </div>
    </div>
</section>

<!-- Car Section -->
<section>
    <div class="row reverse">
        <div>
            <h3>🚗 Car Parking</h3>
            <p>Charges ₹100 per hour with wide parking spaces.</p>
        </div>
        <img src="images/car.jpeg" alt="Car">
    </div>
</section>

<!-- Truck Section -->
<section>
    <div class="row">
        <img src="images/truck.jpg" alt="Truck">
        <div>
            <h3>🚚 Truck Parking</h3>
            <p>Charges ₹200 per hour with large designated slots.</p>
        </div>
    </div>
</section>
<!-- Footer Section -->
<footer>
    <div class="social">
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Facebook"></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111421.png" alt="Instagram"></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
    </div>
    <p style="color:white;font-size:12px;">© 2025 Vehicle Parking Management System | All Rights Reserved</p>
</footer>

</body>
</html>
