<?php
session_start();

// require connection file for db operations 
include 'session_test.php';
require 'dbConnect.php';
include 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['productSubmit'])) {
        $qry = "INSERT INTO products(supplier_id, product_name, product_price, product_qty) VALUES(?,?,?,?)";

        // prepare
        if (!($stmt = $conn->prepare($qry))) {
            echo "Prepare failed: " . $stmt->error;
        }

        if (!$stmt->bind_param("issi", $supp, $name, $price, $qty)) {
            echo "Binding parameters failed: " . $stmt->error;
        }

        // parameter variables
        $supp = $_SESSION['supplier_id'];
        $name = $_POST['productName'];
        $price = $_POST['productPrice'];
        $qty = $_POST['productQty'];

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            echo "<script>alert('Thank you! Your product has been added to the site.')</script>";
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href='css/main.css' />
    <title>Insert Product - App. Project</title>
    <!-- <link rel="stylesheet" href="css/styles.css"/> -->
    <style>
        form {
            margin:2vh;
            font-size: 18pt;
        }
        h2 {
            margin:2vh;
        }
    </style>
</head>

<body>
    <h2>Insert Product Information</h2>
    <!-- Insert Product form -->
    <!-- Remember to add method once second page is created -->
    <form method="post">
        <!-- Product Name -->
        <label>Product Name:</label><br>
        <input type="text" class='productInput' name="productName" id="productName" /><br>

        <!-- Price -->
        <label>Product Price:</label><br>
        <input type="text" class='productInput' name="productPrice" id="productPrice" /><br>

        <!-- Quantity -->
        <label>Product Quantity:</label><br>
        <input type="text" class='productInput' name="productQty" id="productQty" /><br>

        <!-- Submit Product Form -->
        <input type="submit" name="productSubmit" value="Post Product" />
    </form>
</body>

</html>