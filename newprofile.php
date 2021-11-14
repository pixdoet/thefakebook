<?php
session_start();
// profile.php
// php first edited by ian
$conn = new mysqli("localhost:420","root","","fuckbook");

// we do function for checking the status id
function checkstatusid($statusid){
  if ($statusid == 1){
    return "Student (Full-time)";
  }
  if ($statusid == 2){
    return "Grad Student";
  }
  if ($statusid == 3){
    return "Alumnus/Alumna";
  }
  if ($statusid == 4){
    return "Faculity";
  }
  if ($statusid == 5){
    return "Staff";
  }
  if ($statusid == 6){
    return "✓ Developer";
  }
  //status 7(not implemented, need some working)
  if ($statusid == 7){
    return "✓ Staff";
  }
  else{
    return "Status error";
  }
}
if(isset($_GET['id'])){
  $uid = $_GET['id'];
  // check see if id is valid
  $checkvalidid = $conn->prepare("SELECT * FROM fuckbook_users WHERE id = ?");
  $checkvalidid->bind_param("i",$uid);
  $checkvalidid->execute();
  $checkidres = $checkvalidid->get_result();

  if($checkidres->num_rows > 0){
    // now id is valid
    // set vars for stuff below
    while ($row = $checkidres->fetch_assoc()){
      $user_name = $row['username'];
      $user_email = $row['email'];
      $user_status = $row['status'];
      $user_date = $row['date'];
    }
  }
  else{
    //redirect to 404(temp)
    header("Location: 404.php");
  }
}
else{
  // nothing was set in the id field
  // putting this here first, later will redirect to user's own page
  header("Location: 404.php");
}
?>
<html><head><title>Thefuckbook | Welcome to Thefuckbook!</title>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="favicon.ico">

</head><body><center>
<table class="bordertable" cellspacing="0" cellpadding="0" border="0" width="700">
  <tbody><tr><td>
<?php require("header.php"); ?>
  </td></tr>
  <tr><td><table cellspacing="0" cellpadding="2" border="0" width="100%">
      <tbody><tr><td valign="top">
      <table cellspacing="0" cellpadding="0" border="0" width="105">
        <tbody><tr><td>
                            <table class="dashedtable" cellspacing="0" cellpadding="2" width="100%">
              <tbody><tr><td align="right">
                  <p>
                  </p><form method="post" action="login.php">
                  Email:<br> <input type="text" class="inputtext" name="email" value="" size="20"><br>                  Password:<br> 
		 <input type="password" class="inputtext" name="pass" size="20"><br>
                  <center><input type="submit" class="inputsubmit" value="login">&nbsp;
                          <input type="button" class="inputsubmit" value="register" onclick="javascript:document.location='register.php';"></center>
                  </form>
                  <!--<br>-->
              </td></tr></tbody></table>
                      </td></tr>

      
      </tbody></table>
      </td>       <td width="595" valign="top">
                    <table class="bordertable" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tbody>
                        <tr>
                          <td>
                            <table width="100%" cellspacing="0" cellpadding="2" border="0">
                              <tbody>
                                <tr>
                                  <td class="white" bgcolor="#3B5998">
                                  Profile (This is you)
                                  </td>
                                  <table width="100%" cellspacing="2" cellpadding="2" border="0">
                                    <tbody>
                                      <tr>
                                        <td valign=top>
                                        <table class='bordertable' cellspacing=0 cellpadding=0 width=100%>
  <tr>
    <td>
      <table cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td class='white' bgcolor=#3B5998 colspan=2>
            Picture
          </td>
          <td align=right class='white' bgcolor=#3B5998>
            [ <a href="edit_picture.php" class=menu>edit</a> ]
          </td>
        </tr>
      </table>
      <br>
      <center>
        <table cellspacing=0 cellpadding=2 border=0 width=95%>
          <tr>
            <td align=center>
            <p>N/A</p>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<br>
                                        <table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
  <tr>
    <td>
      <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td>
            <a href="friends.php">View My Friends</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td>
            <a href="edit_profile.php">Edit your profile</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td>
            <a href="account.php">My account preferences</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td>
            <a href="privacy.php">My privacy preferences</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
  <tr>
    <td>
      <table cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td class='white' bgcolor=#3B5998>
            Connection
          </td>
        </tr>
      </table>
      <table cellspacing=0 cellpadding=2 border=0 width=95% align=center>
        <tr>
          <td align=center>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
  <tr>
    <td>
      <table cellspacing=0 cellpadding=2 border=0 width=100%>
        <tr>
          <td class='white' bgcolor=#3B5998 colspan=2>
            Friends at crack house
          </td>
        </tr>
      </table>
      &nbsp;<br>
      <center>
    </td>
  </tr>
</table>
                                        </td>
                                        <td>
										<table cellspacing=0 cellpadding=2 border=0 width=100%>
  <tr>
    <td class='white' bgcolor=#3B5998 colspan=2>
      Information
    </td>

    <td align=right class='white' bgcolor=#3B5998>
      [ <a href="edit_profile.php" class=menu>edit</a> ]
    </td>

  </tr>
</table>

<table class='bordertable' cellspacing=0 cellpadding=2 border=0 width=100%>
  <tr>
    <td>
      <table cellspacing=0 cellpadding=0 border=0>
        <tr>
          <td>
            <table cellspacing=0 cellpadding=2 border=0>
              <tr>
                <td colspan=2>
                  <b>Account Info:</b>
                </td>

              </tr>
              <tr>
                <td style="width:104px">
                  Name:
                </td>
                <td style="width:187px">
                  <?php echo htmlspecialchars($user_name);?>
                </td>
              <tr>
              <tr>
                <td>
                  Member&nbsp;Since:
                </td>
                <td>
                  <?php echo htmlspecialchars($user_date);?>
                </td>
              <tr>
              <tr>
                <td>
                  Last&nbsp;Update:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>

                <td>
                  <b>Basic Info:</b>
                </td>
                <td align=right style="color:#538ae2">
                  [ <a href="edit_profile.php?s=basic">edit</a> ]
                </td>
              </tr>
              <tr>
                <td>
                  School:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  Status:
                </td>
                <td>
                  <?php echo htmlspecialchars(checkstatusid($user_status));?>
                </td>
              <tr>
              <tr>
                <td>
                  Sex:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  Birthday:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  Home&nbsp;Town:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  Highschool:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>

                <td>
                  <b>Contact Info:</b>
                </td>
                <td align=right style="color:#538ae2">
                  [ <a href="edit_profile.php?s=contact">edit</a> ]
                </td>

              </tr>
              <tr>
                <td>
                  Email:
                </td>
                <td>
                  <?php echo htmlspecialchars($user_email);?>
                </td>
              <tr>
              <tr>
                <td>
                  Screenname:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  Mobile:
                </td>
                <td>
                  N/A
                </td>
              <tr>
              <tr>
                <td>
                  <b>Personal Info:</b>
                </td>
                <td align=right style="color:#538ae2">
                  [ <a href="edit_profile.php?s=personal">edit</a> ]
                </td>
              </tr>
              <tr>
                <td>
                  Looking&nbsp;For:
                </td>
                <td>
                 N/A
                </td>
              <tr>
              <tr>
                <td>
                  Interested&nbsp;In:
                </td>
                <td>
                 N/A
                </td>
              <tr>
              <tr>
                <td>
                  Relationship&nbsp;Status:
                </td>
                <td>
                 N/A
                </td>
              <tr>
              <tr>
                <td>
                  Political&nbsp;Views:
                </td>
                <td>
                 N/A
                </td>
              <tr>
              <tr>
                <td>
                  Interests:
                </td>
                <td>
                 N/A
                </td>
              <tr>
              <tr>
                <td>
                  Music:
                </td>
                <td>
                 N/A
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
										</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
					<?php require("footer.php"); ?><br>
                  </td></tr></tbody></table>

  </td></tr></tbody></table>
  
<br>
  </td></tr></tbody></table><br>

</center></body></html>