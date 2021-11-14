<?php
//conn.php
// ideally we wanna use this in the official deployment, but the code there is just too large to switch
// also, this is only for the open source release. Funny

// we assume you are hosting this locally. If you are using an SQL server elsewhere, use the server name, ie: sql.cleantalk.cf:69
$hostname = "localhost";
// sql username
$username = "root";
// sql password
$password = "root";
// database(default fuckbook)
$database = "fuckbook";

$conn = new mysqli($hostname,$username,$password,$database);

// Done! Now just include this file into every piece of shit :)
?>
<?php // these are to redirect people from this file?>