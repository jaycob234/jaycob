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

$sql = "SELECT gender, COUNT(*) as count FROM livestock GROUP BY gender";
$gender_distribution = $conn->query($sql);

$sql = "SELECT breed, COUNT(*) as count FROM livestock GROUP BY breed";
$breed_distribution = $conn->query($sql);

$sql = "SELECT * FROM breeding";
$breeding_records = $conn->query($sql);

$sql = "SELECT * FROM products";
$product_records = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Container styling */
        .report-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Heading and title styling */
        h1, h2 {
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 30px;
            font-size: 1.5em;
            color: #2980b9;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 30px;
            text-align: left;
            background-color: #ffffff;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #ffffff;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button styling */
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="report-container">
    <h1>Livestock Reports</h1>

    <h2>Gender Distribution</h2>
    <table>
        <thead>
            <tr>
                <th>Gender</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $gender_distribution->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['count']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Breed Distribution</h2>
    <table>
        <thead>
            <tr>
                <th>Breed</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $breed_distribution->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['breed']; ?></td>
                <td><?php echo $row['count']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

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
            <?php while($row = $breeding_records->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['livestock_id']; ?></td>
                <td><?php echo $row['breed']; ?></td>
                <td><?php echo $row['insemination_date']; ?></td>
                <td><?php echo $row['birth_expectancy_date']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Product Records</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $product_records->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <button onclick="location.href='dashboard.php'">Back to Dashboard</button>
</div>

</body>
</html>
