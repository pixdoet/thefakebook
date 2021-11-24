<?php
session_start();

$id = $_SESSION['userid'];
$gid = $_GET['id'];
if ($id != $gid)
{
    echo "GET id does not match Session id!";
}

$img = true;
$continue = true;
if(!isset($_FILES['picture']) || file_exists($_FILES['picture']))
{
    $file = $_FILES['picture'];
    $filename = $file . $pfp_dir;
    
    // check filetype
    $filetype = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    if(isset($_POST['submit']))
    {
        $check = getimagesize($file['tmp_name']);
        if($check)
        {
            echo "File is image";
            $img = true;
        }
        else
        {
            echo "File is not image";
            $img = false;
        }
    }
    else
    {
        $img = false;
    }
}
if($img)
{
    if(move_uploaded_file($file['tmp_name'], $filename))
    {
        echo htmlspecialchars("File {$filename} has been uploaded");
    }
    else
    {
        echo "File not uploaded";
    }
}
?>