<?php
session_start();
?>
<table class="dashedtable" width="100%" cellspacing="0" cellpadding="2">
              <tbody><tr><td align="right">
  <p style="text-align:Left;"><a style="text-align:Left" href="profile.php?id=2">My profile</a><span style="text-align:Right"><?php if (isset($_SESSION['id']){echo "<a href='edit_profile.php?id=".$_GET['id']."'> [ Edit ]</a></span>";}else{echo "";}?>
                  </p>
                  <!--<br>-->
              </td></tr></tbody></table>