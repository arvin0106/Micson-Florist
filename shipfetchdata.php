<?php
// fetchdata.php

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Get the filtered date from the query parameters
$filteredDate = mysqli_real_escape_string($con, $_GET['delivery_date']);

// Fetch data from the "PICKUP" table based on the filtered date
$query = "SELECT shipping_details.*, orders.ORDER_NO 
          FROM shipping_details
          LEFT JOIN orders ON shipping_details.UID = orders.UID
          WHERE PICKUP_DATE = '$filteredDate'";

$result = mysqli_query($con, $query);

// Check if there are any rows
if (mysqli_num_rows($result) > 0) {
    // Display data in the pop-up
    echo "<table>";
    while ($rowAll = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$rowAll['ORDER_NO']}</font></td>";
        echo "<td>{$rowAll['FIRST_NAME']}</font></td>";
        echo "<td>{$rowAll['LAST_NAME']}</font></td>";
        echo "<td>{$rowAll['EMAIL_ADDRESS']}</font></td>";
        echo "<td>{$rowAll['PHONE']}</font></td>";
        echo "<td>{$rowAll['POSTCODE']}</font></td>"; 
        echo "<td>{$rowAll['REMARK']}</font></td>";
        echo "<td>{$rowAll['PICKUP_DATE']}</font></td>"; 
        echo "<td>{$rowAll['DELIVERY_TIME']}</font></td>"; 
        echo "<td>{$rowAll['STATUS']}</font></td>"; 
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Display a message when there are no pickups for the selected date
    echo "There is no Shipping for the selected date.";
}

// Close the database connection
mysqli_close($con);
?>
