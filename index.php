<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://images.pexels.com/photos/533848/pexels-photo-533848.jpeg'); 
            background-size: cover;
            background-position: center;
            color: #333;
        }

        .form-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .switch {
            background-color: transparent;
            color: #4CAF50;
            border: 1px solid #4CAF50;
            margin-top: 10px;
        }

        .switch:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<?php
    
    $form = isset($_GET['form']) ? $_GET['form'] : 'login';

    if ($form == 'register') {
?>
        <!-- Registration Form -->
        <div class="form-container">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <button type="submit">Register</button>
                <button type="button" onclick="window.location.href='index.php?form=login'" class="switch">Back to Login</button>
            </form>
        </div>
<?php
    } else {
?>
        <!-- Login Form -->
        <div class="form-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <button type="button" onclick="window.location.href='index.php?form=register'" class="switch">Register</button>
            </form>
        </div>
<?php
    }
?>

</body>
</html>