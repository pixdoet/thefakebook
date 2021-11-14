<?php
// edit_basic_info.php by ian
// this page should have nothing, and should show nothing

$conn = new mysqli("localhost","root","","fuckbook");
// do check for get var
if (isset($_GET['id'])){
    //yay
    // we should do all code here
    $id = $_GET['id'];
    // declare variables
    // hard job :(
    $school = $_POST['school'];
    $sex = $_POST['sexoptions'];
    $birthday = $_POST['date'];
    $hometown = $_POST['hometown'];
    $highschool = $_POST['highschool'];
    
    
    // insert statement :)
    $bas_ins_sql = $conn->prepare("UPDATE fuckbook_profiles SET school = ?, sex = ?, birthday = ?, hometown = ?, highschool = ? WHERE id = ?");
    $bas_ins_sql->bind_param("sisssi",$school, $sex, $birthday, $hometown, $highschool, $id);
    $res = $bas_ins_sql->execute();
    if ($res){
        echo "Yay!";
        // redirect to somewhere else
        header("Location: profile.php?id=".$id);
    }
    else{
        echo "Something went quite wrong";
    }
}
else{
    // nothing set
    // redirect to 404
    header("Location: 404.php");
}
?>