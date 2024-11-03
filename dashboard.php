<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Background image and overall styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://images.pexels.com/photos/422218/pexels-photo-422218.jpeg?cs=srgb&dl=pexels-matthiaszomer-422218.jpg&fm=jpg&_gl=1*cj8yke*_ga*MTAxMjA2NTM4OC4xNzMwMzU3NTUw*_ga_8JE65Q40S6*MTczMDM1NzU0OS4xLjAuMTczMDM1NzU0OS4wLjAuMA.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
        }

        /* Navigation bar styling */
        .navbar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Darker semi-transparent background */
            padding: 15px 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .navbar button {
            background-color: #4CAF50; /* Green background for buttons */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .navbar button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        /* Container styling */
        .dashboard-container {
            text-align: center;
            padding-top: 120px; /* Space for fixed navbar */
            padding-bottom: 50px;
            margin: 0 auto;
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.8); /* Light background for readability */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .welcome-message {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.8);
        }

        /* Optional button container styling */
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        /* Content styling */
        .content {
            margin-top: 20px;
            font-size: 1.2em;
            color: #555;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="navbar">
    <button onclick="location.href='livestock_management.php'">Livestock Management</button>
    <button onclick="location.href='breeding_management.php'">Breeding Management</button>
    <button onclick="location.href='product_management.php'">Product Management</button>
    <button onclick="location.href='reports.php'">Reports</button>
    <button onclick="location.href='logout.php'">Logout</button>
</div>

<div class="dashboard-container">
    <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <div class="content" id="content">
    </div>