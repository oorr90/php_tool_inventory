<?php

$part_number = $_POST['part_number'];
$description = $_POST['description'];
$number_in_stock = $_POST['number_in_stock'];
$received_date = $_POST['received_date'];
$price_each = $_POST['price_each'];

$host_name = "host_name_here";
$user_name = "user_name_here";
$user_pass = "user_name_here";
$db = "database_here";

$insert_query = "INSERT INTO
`tool_inventory`
(`part_number`, `description`, `number_in_stock`, `received_date`, `price_each`)
VALUES
('$part_number', '$description','$number_in_stock', '$received_date', $price_each)";


$conn = mysqli_connect($host_name, $user_name, $user_pass, $db);

if (!$conn) {
    die ("Cannot connect to database");
}

$insert_result = mysqli_query($conn, $insert_query);

if (!$insert_result) {
    echo ("Cannot insert into table");
}

mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tool Inventory</title>
</head>
<body>
    <h1>Item Added to Inventory</h1>
    <p>This is the item you just added:</p>

    <table border="1">
        <tr>
            <td><?php echo $part_number; ?></td>
            <td><?php echo $description; ?></td>
            <td><?php echo $number_in_stock; ?></td>
            <td><?php echo $received_date; ?></td>
            <td><?php echo $price_each; ?></td>
        </tr>
    </table>

    <p>Go back <a href="index.php">to the inventory list</a></p>
</body>
</html>
