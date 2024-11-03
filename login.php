<?php
// login.php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('User not found'); window.location.href='index.php';</script>";
    }

    $conn->close();
}
?>