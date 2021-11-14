<?php
// register made by ian
// edited by goom ("i decided to help finish this while ian's away") 
session_start();
// fixed mysql login -ian
include("includes/config.inc.php");
if (isset($_POST["submit"])) {
$post_name = $_POST['name'];
$post_email = $_POST['email'];
$post_status = $_POST['status'];
$post_password = $_POST['password'];
$post_ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
//"did the sha256 for u" -goom
$sha_password = password_hash($post_password, PASSWORD_DEFAULT);
// we store ip as long
$long_ip = ip2long($post_ip);

// check if email is used
$checkemailres = $conn->prepare("SELECT * FROM fuckbook_users WHERE email = ?");
$checkemailres->bind_param("s", $post_email); 
$checkemailres->execute();
$checkemailres2 = $checkemailres->get_result();
if ($checkemailres2){
	// now we know that email is not used
  // insert values
  $regsql = $conn->prepare("INSERT INTO fuckbook_users(username,password,email,status)VALUES(?,?,?,?)");
  $regsql->bind_param("ssss",$post_name,$sha_password,$post_email,$post_status);
  $regres = $regsql->execute();
  if ($regres === TRUE){
    // ultimate success - nycrite
    header("Location: login.php?fromregister=true");
    echo "Your account has been created! Wait for us to make the homepage";
  }
  else {
    // FUCK - nycrite
    echo "Your account has not been created.";
  }
  // we get the id of the user
  // might be used for future purposes!
  $getidsql = $conn->prepare("SELECT * FROM fuckbook_users WHERE email = ?");
  $getidsql->bind_param("s",$post_email);
  $getidsql->execute();
  $getidres = $getidsql->get_result();
  if ($getidres->num_rows > 0){
    while ($row = $getidres->fetch_assoc()){
      $getid = $row['id'];
    }
  }
  // we also create a new record for fuckbook_profiles
  $profilesql = $conn->prepare("INSERT INTO fuckbook_profiles(id,email) VALUES (?,?)");
  $profilesql->bind_param("is",$getid,$post_email);
  $profilesql->execute();
}
else{
  // oh shit someone stole your email
  // FUCK - nycrite
  echo "This email has been used. Try another email!";
}
}
?>
<html><head><title>Thefuckbook | Registration</title>
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
		 <input type="password" class="inputtext" name="password" size="20"><br>
                  <center><input type="submit" class="inputsubmit" value="login">&nbsp;
                          <input type="button" class="inputsubmit" value="register" onclick="javascript:document.location='register.php';"></center>
                  </form>
                  <!--<br>-->
              </td></tr></tbody></table>
                      </td></tr>

      
      </tbody></table>
      </td><td width="595" valign="top">
<table class="bordertable" cellspacing="0" cellpadding="0" border="1" width="100%"><tbody><tr><td>

	  <table cellspacing="0" cellpadding="2" border="0" width="100%">
<tbody><tr><td class="white" bgcolor="#3B5998">Registration</td></tr></tbody></table><center><table cellspacing="0" cellpadding="0" border="0" width="95%"><tbody><tr><td>
<center><table cellspacing="0" cellpadding="0" border="0" width="90%"><tbody><tr><td>
&nbsp;<br>
To register for thefuckbook.com, just fill in the four fields below.  You will
have a chance to enter additional information and submit a picture once you
have registered.
<p>
</p><center>
<form method="post" action="register.php">
<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td>
<table cellspacing="0" cellpadding="2" border="0">
  <tbody><tr><td>Name:</td>
      <td><input type="text" class="inputtext" required name="name" value="" size="30"></td></tr>
  <tr><td>Status:</td>
        <td><select class="inputtext" required name="status">
<option value="1">Student (Full-Time)
</option><option value="5">Grad Student
</option><option value="2">Alumnus/Alumna
</option><option value="3">Faculty
</option><option value="4">Staff
</option></select>
</td></tr>
  <tr><td>Email:</td>
      <td><input type="email" class="inputtext" name="email" required value="" size="30"></td></tr>
  <tr><td>Password*: (choose)&nbsp;</td>
      <td><input type="password" class="inputtext" required name="password" size="30"></td></tr>
  <!--<tr height=8><td></td><td></td></tr>-->
</tbody></table></td></tr><tr><td>
  <table cellspacing="0" cellpadding="3" border="0">
  <tbody><tr><td><input type="checkbox" required name="terms" value="1"></td><td>
  I have read and understood the <a href="terms.php">Terms of Use</a>,
  and I<br>agree to them.</td></tr>
  <tr><td valign="top" align="right">*</td><td>You can choose any password. <font color="red">It 
  should not be your password that you use frequently in other sites.</font></td></tr>
  </tbody></table></td></tr></tbody></table>
<p>
<input type="submit" name="submit" value="Register Now!" class="inputsubmit">
</p></form>
</center>
</td></tr></tbody></table>


</center></td></tr></tbody></table>  </center></td></tr></tbody></table>
  </td></tr></tbody></table>
<?php require("footer.php"); ?><br>
  </td></tr></tbody></table><br>

</center></body></html>