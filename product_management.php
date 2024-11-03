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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (product_name, price, quantity) 
            VALUES ('$product_name', $price, $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product Added Successfully!'); window.location.href='product_management.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$product_records = [];
if (isset($_POST['search_product'])) {
    $search_name = $_POST['search_product_name'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_name%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_records[] = $row;
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
    <title>Product Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <h1>Product Management</h1>

    <form action="product_management.php" method="POST">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Search Products</h2>
    <form action="product_management.php" method="POST">
        <input type="text" name="search_product_name" placeholder="Product Name" required>
        <button type="submit" name="search_product">Search</button>
    </form>

    <?php if (!empty($product_records)): ?>
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
            <?php foreach ($product_records as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['product_name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <button onclick="location.href='dashboard.php'">Back to Dashboard</button>
</div>

</body>
</html>
