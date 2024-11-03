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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_breeding'])) {
    $livestock_id = $_POST['livestock_id'];
    $breed = $_POST['breed'];
    $insemination_date = $_POST['insemination_date'];
    $birth_expectancy_date = $_POST['birth_expectancy_date'];

    $sql = "INSERT INTO breeding (livestock_id, breed, insemination_date, birth_expectancy_date) 
            VALUES ('$livestock_id', '$breed', '$insemination_date', '$birth_expectancy_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Breeding Record Added Successfully!'); window.location.href='breeding_management.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$breeding_records = [];
if (isset($_POST['search_breeding'])) {
    $search_id = $_POST['search_livestock_id'];
    $sql = "SELECT * FROM breeding WHERE livestock_id='$search_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $breeding_records[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breeding Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <h1>Breeding Management</h1>

    <form action="breeding_management.php" method="POST">
        <input type="text" name="livestock_id" placeholder="Livestock ID" required>
        <input type="text" name="breed" placeholder="Breed" required>
        <label>Insemination Date</label>
        <input type="date" name="insemination_date" required>
        <label>Birth Expectancy Date</label>
        <input type="date" name="birth_expectancy_date" required>
        <button type="submit" name="add_breeding">Add Breeding Record</button>
    </form>

    <h2>Search Breeding Records</h2>
    <form action="breeding_management.php" method="POST">
        <input type="text" name="search_livestock_id" placeholder="Livestock ID" required>
        <button type="submit" name="search_breeding">Search</button>
    </form>

    <?php if (!empty($breeding_records)): ?>
    <h2>Breeding Records</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Livestock ID</th>
                <th>Breed</th>
                <th>Insemination Date</th>
                <th>Birth Expectancy Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($breeding_records as $record): ?>
            <tr>
                <td><?php echo $record['id']; ?></td>
                <td><?php echo $record['livestock_id']; ?></td>
                <td><?php echo $record['breed']; ?></td>
                <td><?php echo $record['insemination_date']; ?></td>
                <td><?php echo $record['birth_expectancy_date']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <button onclick="location.href='dashboard.php'">Back to Dashboard</button>
</div>

</body>
</html>
