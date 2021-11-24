<?php
// sidebar.php for doing all things sidebars do, plus more

if (!isset($_SESSION)) {
    session_start();
}

include("includes/config.inc.php");

if (!isset($_SESSION['loggedin']) && !isset($_SESSION['userid'])) {
?>
    <table class="dashedtable" width="100%" cellspacing="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="text-align:right;">
                    <p>
                    </p>
                    <form method="post" action="login.php">
                        Email:<br> <input type="text" class="inputtext" name="email" value="" size="20"><br> Password:<br>
                        <input type="password" class="inputtext" name="pass" size="20"><br>
                        <div style="float:center">
                            <input type="submit" class="inputsubmit" value="login">&nbsp;
                            <input type="button" class="inputsubmit" value="register" onclick="javascript:document.location='register.php';">
                        </div>
                    </form>
                    <!--<br>-->
                </td>
            </tr>
        </tbody>
    </table>
<?php
} else {
?>
    <table class="dashedtable" width="100%" cellspacing="0" cellpadding="2">
        <tbody>
            <tr>
                <td style="text-align:center">
                    <p><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>">My Profile</a><a href="edit_profile.php?id=<?php echo $_SESSION['userid']; ?>"> [ Edit ] </a></p>
                    <p><a href=".#">My friends</a></p>
                    <p><a href=".#">My groups</a></p>
                    <p><a href=".#">My parties</a></p>
                    <p><a href=".#">My messages</a></p>
                    <p><a href="edit_profile.php?id=<?php echo $_SESSION['userid']; ?>">My account</a></p>
                    <p><a href=".#">My privacy</a></p>
                </td>
            </tr>
        </tbody>
    </table>
<?php
}
?>