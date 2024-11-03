<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livestock_id = $_POST['livestock_id'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];

    $sql = "INSERT INTO livestock (livestock_id, gender, age, breed) VALUES ('$livestock_id', '$gender', $age, '$breed')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Livestock Added Successfully!'); window.location.href='livestock_management.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$livestock_records = [];
$sql = "SELECT * FROM livestock";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $livestock_records[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livestock Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <h1>Livestock Management</h1>

    <form action="livestock_management.php" method="POST">
        <input type="text" name="livestock_id" placeholder="Livestock ID" required>
        <select name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <input type="number" name="age" placeholder="Age (in years)" required>
        <input type="text" name="breed" placeholder="Breed" required>
        <button type="submit">Add Livestock</button>
    </form>

    <h2>Livestock Records</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Livestock ID</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Breed</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livestock_records as $livestock): ?>
            <tr>
                <td><?php echo $livestock['id']; ?></td>
                <td><?php echo $livestock['livestock_id']; ?></td>
                <td><?php echo $livestock['gender']; ?></td>
                <td><?php echo $livestock['age']; ?></td>
                <td><?php echo $livestock['breed']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="location.href='dashboard.php'">Back to Dashboard</button>
</div>

</body>
</html>
