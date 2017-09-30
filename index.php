<?php

$host_name = "host_name_here";
$user_name = "user_name_here";
$user_pass = "user_name_here";
$db = "database_here";

$conn = mysqli_connect($server_name, $user_name, $user_pass, $db);

if(!$conn) {
    die ("Cannot connect to database");
}

//Store the SQL query in a variable
    //this query select ALL COLUMNS from the inventory

    //Number in stock is greater than 0
$queryInStock = "SELECT * FROM tool_inventory WHERE number_in_stock > 0";

    //Number in stock is 0
$queryOutStock = "SELECT * FROM tool_inventory WHERE number_in_stock = 0";


//Use this resource ID with mysqli_fetch_array to grab the data one row at a time
$resultInStock = mysqli_query($conn, $queryInStock);

$resultOutStock = mysqli_query($conn, $queryOutStock);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tool Inventory</title>
    <style>
        tr:nth-child(even) {
            background-color: #77b300;
        }
    </style>
</head>
<body>
    <h1>Tool Inventory</h1>
    <h2>Items that are in stock:</h2>

    <table border="1">
        <tr>
            <th>Part Number</th>
            <th>Description</th>
            <th>Number in Stock</th>
            <th>Received Date</th>
            <th>Price</th>
        </tr>

    <?php

    while ($row = mysqli_fetch_array($resultInStock)) {
        echo '<tr><td>' . $row['part_number'] . '</td><td>' . $row['description'] . '</td><td>' . $row['number_in_stock'] . '</td><td>' . $row['received_date'] . '</td><td>' . $row['price_each'] . '</td></tr>';
    }

    ?>

    </table>



    <h2>Items that are not in stock:</h2>

    <table border="1">
        <tr>
            <th>Part Number</th>
            <th>Description</th>
            <th>Number in Stock</th>
            <th>Received Date</th>
            <th>Price</th>
        </tr>

    <?php

    while ($row = mysqli_fetch_array($resultOutStock)) {
        echo '<tr><td>' . $row['part_number'] . '</td><td>' . $row['description'] . '</td><td>' . $row['number_in_stock'] . '</td><td>' . $row['received_date'] . '</td><td>' . $row['price_each'] . '</td></tr>';
    }

    ?>

    </table>




    <h2>Add a new item:</h2>
    <p>All fields are required.</p>
    <form action="inventoryAdd.php" method="POST">
        <p>
            <input type="text" name="part_number" id="part_number" placeholder="part number (eg. BU01)" required>
        </p>
        <p>
            <input type="text" name="description" id="description" placeholder="description" size="40" required>
        </p>
        <p>
            <input type="number" name="number_in_stock" id="number_in_stock" placeholder="number in stock" required>
        </p>
        <p>
            <input type="text" name="received_date" id="received_date" placeholder="received date (eg. 00JAN2017)" size="30" required>
        </p>
        <p>
            <input type="number" step="0.01" name="price_each" id="price_each" placeholder="price each (eg. 2.99)" required>
        </p>
        <input type="submit" name="submit" id="submit" value="Add Item to Inventory">
    </form>

    <?php
        mysqli_close($conn);
    ?>
</body>
</html>
