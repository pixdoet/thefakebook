<?php
session_start();
// re-write php code on may 1st, 2021 by ian
include("includes/config.inc.php");

$login_status = 0; //set this for debug purposes. Remove in final code!
$login_status_text = ""; //the real login status

if (isset($_GET['fromregister'])) {
  $login_status_text = "Your account has been created! Now you can log in";
}
// do this to prevent nasty errors!
if (isset($_POST['submit'])) {
  // do a check for empty fields
  // the check breaks login_status somehow. Commenting it
  //if(isset($_POST['email'])){
  //if (isset($_POST['password'])){
  // get the vars
  $post_email = $_POST['email'];
  $password = $_POST['password'];

  // get password from user row
  $getuserpassword = $conn->prepare('SELECT * FROM fuckbook_users WHERE email = ?');
  $getuserpassword->bind_param("s", $post_email);
  $getuserpassword->execute();
  $getres1 = $getuserpassword->get_result();
  // now we see if user exists
  if ($getres1->num_rows > 0) {
    while ($row = $getres1->fetch_assoc()) {
      // password check
      $db_password = $row['password'];

      if (password_verify($password, $db_password)) {
        $login_status = 2;
        $login_status_text = "You are logged in!";
        // we now do some additional trolling
        // storing session stuff
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $row['id'];
        header("Location: profile.php?id=" . $row['id']);
      } else {
        // password check is not ok
        $login_status = 1;
        $login_status_text = "Incorrect password";
      }
    }
  } else {
    // oh ho ho user doesnt not exist
    $login_status = 3;
    $login_status_text = "The email does not exist or has been terminated";
  }
}
?>
<html>

<head>
  <title>Thefuckbook | Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="favicon.ico">

</head>

<body>
  <center>
    <table class="bordertable" cellspacing="0" cellpadding="0" border="0" width="700">
      <tbody>
        <tr>
          <td>
            <?php require("header.php"); ?>
          </td>
        </tr>
        <tr>
          <td>
            <table cellspacing="0" cellpadding="2" border="0" width="100%">
              <tbody>
                <tr>
                  <td valign="top">
                    <table cellspacing="0" cellpadding="0" border="0" width="105">
                      <tbody>
                        <tr>
                          <td>
                            <table class="dashedtable" cellspacing="0" cellpadding="2" width="100%">
                              <tbody>
                                <tr>
                                  <td align="right">
                                    <center>
                                      &nbsp;<br><a href="index.php">[ main ]</a>
                                      <p><a href="login.php">[ login ]</a>
                                      </p>
                                      <p><a href="register.php">[ register ]</a>
                                      </p>
                                      <p>
                                      </p>
                                    </center>
                                  </td>
                                </tr>
                              </tbody>
                            </table>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td width="595" valign="top">
                    <table class="bordertable" cellspacing="0" cellpadding="0" border="1" width="100%">
                      <tbody>
                        <tr>
                          <td>

                            <script language="JavaScript" type="text/javascript">
                              if (top != self) top.location.href = self.location.href;
                            </script>

                            &nbsp;<center>
                              <p class="title">[ Login ]</p>
                              <p>
                              </p>
                              <form method="post" action="login.php">
                                <table cellspacing="0" cellpadding="2" border="0">
                                  <tbody>
                                    <tr>
                                      <td>Email:</td>
                                      <td><input type="text" class="inputtext" name="email" id="email" value="" size="30"></td>
                                    </tr>
                                    <tr>
                                      <td>Password:</td>
                                      <td><input type="password" class="inputtext" name="password" id="pass" size="30"></td>
                                    </tr>
                                    <tr height="7">
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td><span style="color:red"><?php echo $login_status_text; ?></span></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <input type="submit" name="submit" value="   Login   " class="inputsubmit">&nbsp;&nbsp;
                                <input type="button" value="Register" class="inputsubmit" onclick="javascript:document.location='register.php';">
                              </form>
                              <p>&nbsp;<br>If you have forgotten your password, click <a href="reset.php">here</a> to reset it.<br>&nbsp;
                              </p>
                            </center>

                            <script type="text/javascript" language="JavaScript">
                              document.getElementById('email').focus()
                              if (document.getElementById('email').value) document.getElementById('pass').focus();
                            </script>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php require("footer.php"); ?><br>
          </td>
        </tr>
      </tbody>
    </table><br>
    <?php echo $login_status; ?>

  </center>
</body>

</html>