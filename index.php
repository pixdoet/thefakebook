<?php
session_start();
?>
<html>

<head>
  <title>Thefuckbook | Welcome to Thefuckbook!</title>
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
                            <?php include("sidebar.php");?>
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

                            <table cellspacing="0" cellpadding="2" border="0" width="100%">
                              <tbody>
                                <tr>
                                  <td class="white" bgcolor="#3B5998">Welcome to Thefuckbook!</td>
                                </tr>
                              </tbody>
                            </table>
                            <center>
                              <p class="title">[ Welcome to Thefuckbook ]<br>&nbsp;
                              <table cellspacing="0" cellpadding="0" border="0" width="95%">
                                <tbody>
                                  <tr>
                                    <td class="larger">Thefuckbook is an online directory that connects people through social networks at homes.<p>You can use Thefuckbook to:<br>&nbsp;<b>•</b>&nbsp; Search for people at your homes<br>&nbsp;<b>•</b>&nbsp; Find out who is in your classes<br>&nbsp;<b>•</b>&nbsp; Look up your friends' friends<br>&nbsp;<b>•</b>&nbsp; See a visualization of your social network</p>
                                      <p>To get started, click below to register. If you have already registered, you can log in.</p>
                                      <center><input class="inputsubmit" type="button" value="Register" onclick="javascript:document.location=register.php;">&nbsp;&nbsp;<input class="inputsubmit" type="button" value=" Login " onclick="javascript:document.location=&quot;login.php&quot;;"><br>&nbsp;</center>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
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
            <?php require("footer.php"); ?><br>
          </td>
        </tr>
      </tbody>
    </table><br>
  </center>
</body>

</html>