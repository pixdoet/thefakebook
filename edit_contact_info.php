<?php
// edit_contact_info.php by ian
// like e_b_i but smoller(and different database)

$conn = new mysqli("localhost","root","","fuckbook");
// do check for get var
if (isset($_GET['id'])){
    //yay
    // we should do all code here
    $id = $_GET['id'];
    // declare variables
    // hard job :(
    $screenname = $_POST['screenname'];
    $mobile = $_POST['mobile'];
    
    
    // insert statement :)
    $bas_ins_sql = $conn->prepare("UPDATE fuckbook_profiles SET screenname = ?, mobile = ? WHERE id = ?");
    $bas_ins_sql->bind_param("sii", $screenname, $mobile, $id);
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