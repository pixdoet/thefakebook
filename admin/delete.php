<?php
include("../includes/config.inc.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; // get id through query string

$del = $conn->prepare("delete from `fuckbook_users` where id = ?"); // delete query
$del->bind_param("i",$id);
$del->execute();

if($del)
{
    //mysqli_close($db); // Close connection
    // we only need to use conn to close -ian
    $conn->close();
    header("Location: index.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>