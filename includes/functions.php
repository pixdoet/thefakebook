<?php
// list of commonly called functions to do stuff
session_start();
include("config.inc.php");

function request_users($id, $action)
{
    if (isset($id)) {
        $sql = "";
        switch ($action) {
            case "all":
                $sql = "SELECT * FROM `fuckbook_users` WHERE id = ?";
            case "username":
                $sql = "SELECT username FROM `fuckbook_users` WHERE id = ?";
            case "email":
                $sql = "SELECT email FROM `fuckbook_users` WHERE id = ?";
            case "password":
                $sql = "SELECT password FROM `fuckbook_users` WHERE id = ?";
            default:
                return false;
        }
        $do = $conn->prepare($sql);
        $do->bind_param("i", $id);
        $do->execute();
        if($do)
        {
            
        }
    }
}
