<?php
// edit_contact_info.php by ian
// like e_b_i but smoller(and different database)

session_start();
include ('includes/config.inc.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    if (isset($_GET['id']) && $_GET['id'] == $_SESSION['userid'])
    {
        $id = $_GET['id'];
        // declare variables
        // hard job :(
        $screenname = $_POST['screenname'];
        $mobile = $_POST['mobile'];

        $bas_ins_sql = $conn->prepare("UPDATE fuckbook_profiles SET screenname = ?, mobile = ? WHERE id = ?");
        $bas_ins_sql->bind_param("sss", $screenname, $mobile, $id);
        $res = $bas_ins_sql->execute();

        if($res)
        {
            header("Location: profile.php?id=" . $_GET['id']);
        }
        else
        {
            echo("Something went wrong");
        }
    }
    else
    {
        header("Location: 403.php");
    }
}
else
{
    header("Location: 403.php");
}
?>