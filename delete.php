<?php
include_once 'config.php';
$sql = "DELETE FROM product_record WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
header("Location:welcome1.php");
 
?>
