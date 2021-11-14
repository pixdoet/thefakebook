<?php
include('conn.php');

// if id exists
if(isset($_GET['id'])){
    // read database
    $idDb = $conn->prepare("SELECT * FROM fuckbook_status WHERE id = ?");
    $idDb->bind_param("i",$_GET['id']);
    $idDb->execute();
}
else{
    
}
?>