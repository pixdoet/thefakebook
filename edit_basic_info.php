<?php
// edit_basic_info.php by ian
// this page should have nothing, and should show nothing

// start session (im an idiot forgot bout this)
session_start();
include ('includes/config.inc.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
    if (isset($_GET['id']) && $_GET['id'] == $_SESSION['userid'])
    {
        $school = $_POST['school'];
        $sex = $_POST['sexoptions'];
        $birthday = $_POST['date'];
        $hometown = $_POST['hometown'];
        $highschool = $_POST['highschool'];

        $bas_sql = $conn->prepare("UPDATE fuckbook_profiles SET school = ?, sex = ?, hometown = ?, highschool = ? WHERE id = ?");
        $bas_sql->bind_param("sissi",$school,$sex,$hometown,$highschool,$_GET['id']);
        $bas_sql->execute();

        if($bas_sql)
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
        echo "wrong session id";
        //header("Location: 403.php");
    }
}
else
{
    // echo "not logged in!";
    header("Location: 403.php");
}
?>