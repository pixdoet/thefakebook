<?php
session_start();
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
      </td><td width="595" valign="top">
        <table class="bordertable" cellspacing="0" cellpadding="0" border="1" width="100%"><tbody><tr><td>

<table cellspacing="0" cellpadding="2" border="0" width="100%">
<tbody><tr><td class="white" bgcolor="#3B5998">Admin Panel</td></tr></tbody></table><center><p class="title">[ Admin Panel ]<br>&nbsp;<table cellspacing="0" cellpadding="0" border="0" width="95%"><tbody><tr><td class="larger">

<?php
include('../includes/config.inc.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM fuckbook_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $user_id = $row["id"];
?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width:100%}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-l6li{border-color:inherit;font-size:10px;text-align:left;vertical-align:top}
.tg .tg-h2xt{border-color:inherit;font-family:Arial, Helvetica, sans-serif !important;;font-size:10px;text-align:left;
  vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
  <th class="tg-wgsn">id</th>
    <th class="tg-wgsn">username</th>
    <th class="tg-0pky">email</th>
    <th class="tg-0pky">status</th>
    <th class="tg-0pky">db options</th>
  </tr>
</thead>
<tbody>
  <tr>
  <td class="tg-0pky"><?php echo htmlspecialchars($row["id"]); ?></td>
    <td class="tg-0pky"><?php echo htmlspecialchars($row["username"]); ?></td>
    <td class="tg-0pky"><?php echo htmlspecialchars($row["email"]); ?></td>
    <th class="tg-0pky"><?php echo htmlspecialchars($row['status']);?></td>
    <td class="tg-0pky"><a class="red" href="delete.php?id=<?php echo $user_id;?>">Delete [ X ]</a><a href="makedev.php?id=<?php echo $user_id;?>">Make Dev</a></td>
  </tr>
</tbody>
</table>

<?php } } ?>

&nbsp;&nbsp;<input class="inputs"<br>&nbsp;</center></td></tr></tbody></table>  </p></center></td></tr></tbody></table>
  </td></tr></tbody></table><br><br>
  </td></tr></tbody></table><br>

</center></body></html>