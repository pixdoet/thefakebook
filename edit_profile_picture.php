<?php
// user checking
session_start();

$id = $_GET['id'];
if (isset($_SESSION['userid'])){
    if ($_SESSION['userid'] !== $id){
        //for now, we'll show a little debug message
        //later on when error messages are added to edit_profile we'll do that
        echo "Error! User ID does not match request's GET id";
    }
    else{
        $currentid = $_SESSION['userid'];
        //now for uploading and <shit class="shit"></shit>
        //yeah
        if(isset($_FILE['image'])){
            $img = $_FILE['image'];
            //check file type
            $allowedfiles = array('image/jpeg','image/png');
            if(in_array($img['type'],$allowedfiles)){
                $dir = "./images/profiles";
                $changename = $currentid . "." . $img['type'];

                $go = $dir . $changename;
                // we are funny!
                if(move_uploaded_file($dir['tmp_name'],$go)){
                    echo "Profile picture was uploaded";
                    print_r($img);
                }
                
            }
            else{
                echo "File not supported! Must be in .jpg, .jpeg or .png format";
            }
        }
        else{
            echo "You need to provide an image!";
        }
    }
}
else{
    header("Location: 404.php");
}
?>