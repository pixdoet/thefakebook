<?php
// edit_profile.php by ian 
// this contains the least amount of php code
session_start();
include("includes/config.inc.php");
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
  //status 7
  if ($statusid == 7){
    return "✓ Staff";
  }
  else{
    return "Status error";
  }
}
// get user id
$id = $_GET['id'];
if (!isset($id)){
  header("Location: 404.php");
}
else{
  if (!isset($_SESSION['userid'])){
    header("Location: 404.php");
  }
  else{
  $uid = $_GET['id'];
  if ($uid == $_SESSION['userid']){
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
  $getbasicinfo = $conn->prepare("SELECT * FROM fuckbook_profiles WHERE id = ?");
  $getbasicinfo->bind_param("i",$uid);
  $getbasicinfo->execute();
  $getbasicres = $getbasicinfo->get_result();

  if ($getbasicres->num_rows > 0){
    while($row = $getbasicres->fetch_assoc()){
      if (is_null($row['school'])){
        $get_school = "N/A";
      }
      else{
        $get_school = $row['school'];
      }
      if (is_null($row['sex'])){
        $get_sex = "N/A";
      }
      else{
        $get_sex = $row['sex'];
      }
      if (is_null($row['birthday'])){
        $get_bday = "N/A";
      }
      else{
        $get_bday = $row['birthday'];
      }
      if (is_null($row['hometown'])){
        $get_hometown = "N/A";
      }
      else{
        $get_hometown = $row['hometown'];
      }
      if (is_null($row['highschool'])){
        $get_highschool = "N/A";
      }
      else{
        $get_highschool = $row['highschool'];
      }
    }
  }
  // get contact info
  $getcontactinfo = $conn->prepare("SELECT * FROM fuckbook_profiles WHERE id = ?");
  $getcontactinfo->bind_param("i",$uid);
  $getcontactinfo->execute();
  $getcontactres = $getcontactinfo->get_result();

  if ($getcontactres->num_rows > 0){
    while($row = $getcontactres->fetch_assoc()){
      if (is_null($row['screenname'])){
        $get_school = "N/A";
      }
      else{
        $get_screenname = $row['screenname'];
      }
    }
    if (is_null($row['mobile'])){
      $get_mobile = "N/A";
    }
    else{
      $get_mobile = $row['mobile'];
    }
  }
}
else{header("Location: 404.php");}
}
}
?>
<html><head><title>Thefuckbook | Welcome to Thefuckbook!</title>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="favicon.ico">

</head><body><center>
<table class="bordertable" width="700" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr><td>
      <?php require("header.php");?> </td></tr>
  <tr><td><table width="100%" cellspacing="0" cellpadding="2" border="0">
      <tbody><tr><td valign="top">
      <table width="105" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr><td>
                            <table class="dashedtable" width="100%" cellspacing="0" cellpadding="2">
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
      </td><td width="595" valign="top">
        <table class="bordertable" width="100%" cellspacing="0" cellpadding="0" border="1"><tbody><tr><td>

<table width="100%" cellspacing="0" cellpadding="2" border="0">
<tbody><tr><td class="white" bgcolor="#3B5998">Edit profile.</td></tr></tbody></table><center><p class="title">[ Edit Profile ]<br>&nbsp;<table width="95%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td>
										<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody>
</tbody></table>

<table class="bordertable" width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <td>
      <table cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <?php //this for image upload and funny ?>  
        <tr>
          <td>
            <b>Upload/edit profile picture</b>
            <form class="upload_image" encoding="multipart/form-data" method="post" action="edit_profile_picture.php?id=<?php echo $_SESSION['userid'];?>">
            <input type="file" name="picture">
            <input type="submit" name="submit" value="Upload">
</form>
</td>
</tr>
        <tr>
          <td>
            <table cellspacing="0" cellpadding="2" border="0">
              <tbody><tr>
                <td colspan="2">
                  <b>Account Info:</b>
                </td>
                <form method="post" action="edit_basic_info.php?id=<?php echo $id;?>" name="edit_basic_info">
              </tr>
              <tr>
                <td style="width:104px">
                  Name:
                </td>
                <td style="width:187px">
                  <?php echo htmlspecialchars($user_name);?>                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Member&nbsp;Since:
                </td>
                <td>
                  <?php echo $user_date;?>                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Last&nbsp;Update:
                </td>
                <td>
                  N/A
                </td>
              </tr><tr>
              </tr><tr>

                <td>
                  <b>Basic Info:</b>
                </td>
                <td style="color:#538ae2" align="right">
                  <input class="inputsubmit" type="submit" value="Save"></input>
                </td>
              </tr>
              <tr>
                <td>
                  School:
                </td>
<td><input type="text" name="school" value="<?php echo htmlspecialchars($get_school);?>"></td>
                

              </tr><tr>
              </tr><tr>
                <td>
                  Status:
                </td>
                <td>
                  <?php echo htmlspecialchars(checkstatusid($user_status));?></td>
              </tr><tr>
              </tr><tr>
                <td>
                  Sex:
                </td>
<td><select class="inputtext" name="sexoptions" value="$get_sex">
  <option value="0">Select</option>
  <option value="1">Male</option>
  <option value="2">Female</option>
  <option value="3">Not Specified</option>
  </select></td>
                


              </tr><tr>
              </tr><tr>
                <td>
                  Birthday:
                </td>
                <td><input type="date" name="date" value="<?php echo htmlspecialchars($get_bday);?>"></td>
              </tr><tr>
              </tr><tr>
                <td>
                  Home&nbsp;Town:
                </td>
                <td>
                  <input type="text" name="hometown" value="<?php echo htmlspecialchars($get_hometown);?>">
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Highschool:
                </td>
                <td>
                  <input type="text" name="highschool" value="<?php echo htmlspecialchars($get_highschool);?>">
                </td>
              </tr><tr>
              </tr><tr>
            </form>
            <form method="post" action="edit_contact_info.php?id=<?php echo $uid;?>">
                <td>
                  <b>Contact Info:</b>
                </td>
                <td style="color:#538ae2" align="right">
                <input class="inputsubmit" type="submit" value="Save"></input>
                </td>

              </tr>
              <tr>
                <td>
                  Email:
                </td>
                <td>
                  pixdo.et@gmail.com                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Screenname:
                </td>
                <td>
                  <input type="text" name="screenname" value="<?php echo htmlspecialchars($user_name);?>">
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Mobile:
                </td>
                <td>
                  <input type="text" name="mobile" value="<?php echo htmlspecialchars($get_mobile);?>">
                </td>
              </tr><tr>
              </tr><tr>
              </form>
                <td>
                  <b>Personal Info:</b>
                </td>
                <td style="color:#538ae2" align="right">
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
              </tr><tr>
              </tr><tr>
                <td>
                  Interested&nbsp;In:
                </td>
                <td>
                 N/A
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Relationship&nbsp;Status:
                </td>
                <td>
                 N/A
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Political&nbsp;Views:
                </td>
                <td>
                 N/A
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Interests:
                </td>
                <td>
                 N/A
                </td>
              </tr><tr>
              </tr><tr>
                <td>
                  Music:
                </td>
                <td>
                 N/A
                </td>
              </tr>
              </tbody></table>
          </td>
        </tr>
      </tbody></table>
    </form></td>
  </tr>
</tbody></table>
										</td></tr></tbody></table>  </p></center></td></tr></tbody></table>
  </td></tr></tbody></table>
  <center>
  <p><a href="about.php">about</a>&nbsp;&nbsp;
  <a href="contact.php">contact</a>&nbsp;&nbsp;
  <a href="faq.php">faq</a>&nbsp;&nbsp;
  <a href="#">advertise</a>&nbsp;&nbsp;
  <a href="terms.php">terms</a>&nbsp;&nbsp;
  <a href="policy.php">privacy</a>
  <br>a Fuck production
  <br>Thefuckbook © 2005
  </p></center><br>
  </td></tr></tbody></table><br>

</center></body></html>