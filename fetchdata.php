<?php
// fetchdata.php

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "db_shopping_cart") or die(mysqli_error());

// Get the filtered date from the query parameters
$filteredDate = mysqli_real_escape_string($con, $_GET['pickup_date']);

// Fetch data from the "PICKUP" table based on the filtered date
$query = "SELECT pickup_detail.*, orders.ORDER_NO 
          FROM pickup_detail
          LEFT JOIN orders ON pickup_detail.UID = orders.UID
          WHERE PICKUP_DATE = '$filteredDate'";

$result = mysqli_query($con, $query);

// Check if there are any rows
if (mysqli_num_rows($result) > 0) {
    // Display data in the pop-up
    echo "<table>";
    while ($rowAll = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$rowAll['ORDER_NO']}</td>";
        echo "<td>{$rowAll['FIRST_NAME']}</td>";
        echo "<td>{$rowAll['LAST_NAME']}</td>";
        echo "<td>{$rowAll['EMAIL_ADDRESS']}</td>";
        echo "<td>{$rowAll['PHONE']}</td>";
        echo "<td>{$rowAll['REMARK']}</td>"; 
        echo "<td>{$rowAll['PICKUP_DATE']}</td>";
        echo "<td>{$rowAll['STATUS']}</td>";
        echo "<td><button onclick=\"location.href='pickup_edit.php?uid={$rowAll['UID']}'\">Edit</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Display a message when there are no pickups for the selected date
    echo "There is no pickup for the selected date.";
}

// Close the database connection
mysqli_close($con);
?>
