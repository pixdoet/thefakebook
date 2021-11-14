<?php
//gbasic
// for slow computers
// basically removes everything
// beta release, other boards will be added soon -ian

//redirect to login if not logged in(duh)
if (!isset($_SESSION['userid'])){
    header("Location: login.php?next=forum");
}
?>
<html>
    <head>
        <title>Thefuckbook Forums(alpha)</title>
        <link rel="shortcut icon" href="../favicon.ico">
        <!-- affc meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="Retro Video Games - Thefuckbook Forums">
        <meta property="og:description" content="Thefuckbook forums are an extension of theFuckbook social platform. Join the discussion now!">
        <meta property="og:url" content="https://thefuckbook.ml/forums/retrov">
        <meta property="og:type" content="website">
        <!-- end of affc meta -->
    </head>
    <body>
        <?php
            if(isset($_POST["submit"]))
            {
                // doing the sql thingy - nycrite
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fuckrums";

                $conn = new mysqli($servername, $username, $password, $dbname);
                $fb_conn = new mysqli("localhost","root","","fuckbook");
                $user_post = $_POST['affc_usertextarea'];
                $id = $_SESSION['userid'];
                // get user data because why not
                $get_user_info = $fb_conn->prepare("SELECT name FROM fuckbook_users WHERE id = ?");
                $get_user_info->bind_param("i","")

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                    $name = $_POST['name'];
                    if (is_null($name)){
                        $name = "annonymous";
                    }
                    $post = $conn->prepare("INSERT INTO fuckrums_rv (content, content_author) VALUES (?, ?)");
                    $post->bind_param("ss", $user_post, $name);
    
                    $post->execute();
        ?>
        <div class="main">
            <?php include('../header.php'); ?>
            
            <strong>Welcome to Thefuckbook forums! This is the <?php echo "Retro video games";?>board.</strong>
            <br>
            <form method="post">
                <textarea name="affc_usertextarea" class="userpostcontent"></textarea>
                <div class="belowtx">
                    <input type="submit" name="submit" value="Post!"/>
                    <br>
                </div>
            </form>
                <?php  
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;

                // Check connection
                if (mysqli_connect_errno()){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    die();
                }

                $total_pages_sql = "SELECT COUNT(*) FROM fuckrums_rv";
                $result = mysqli_query($conn,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                // did the statements for ya -ian
                $sql = $conn->prepare("SELECT content, content_author, post_id FROM fuckrums_rv ORDER BY post_id DESC LIMIT ?,?");
                $sql->bind_param("ii",$offset,$no_of_records_per_page); //ii means integers -ian
                $sql->execute();
                
                $res_data = $sql->get_result();
                while($row = $res_data->fetch_assoc()){
                    // do your output code here -ian
                    $sql_content = $row['content'];
                    $sql_author = $row['content_author'];
                    $sql_id = $row['post_id'];
                    // tHIS IS NOT SEX............................... yet - nycrite
                    echo "<p>".$sql_id.": From ".htmlspecialchars($sql_author).": ".htmlspecialchars($sql_content)."</p>";
                }
                ?>
                <?php  ?>
            <ul class="pag">
                <li class="pag"><a href="?pageno=1">First</a><br></li>
                <li class="pag <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a><br>
                </li>
                <li class="pag <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a><br>
                </li>
                <li class="pag"><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </div>
    </body>
</html>