<?php
// edit_basic_info.php by ian
// this page should have nothing, and should show nothing
include ('config.inc.php');

if (isset($_SESSION['loggedin']))
{
    if (isset($_GET['id']) && $_GET['id'] == $_SESSION['userid'])
    {
        $school = $_POST['school'];
        $sex = $_POST['sexoptions'];
        $birthday = $_POST['date'];
        $hometown = $_POST['hometown'];
        $highschool = $_POST['highschool'];

        $bas_sql = $conn->prepare("UPDATE `fuckbook_profiles` SET school = ?, sex = ?, birthday = ?, hometown = ?, highschool = ? WHERE id = ?");
        $bas_sql->bind_param("sisssi",$school,$sex,$birthday,$hometown,$highschool);
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
        header("Location: 403.php");
    }
}
else
{
    header("Location: 403.php");
}
?>