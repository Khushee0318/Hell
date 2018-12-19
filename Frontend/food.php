<?php
require_once "connect.php";
$stt = $db->prepare("INSERT INTO food(id,username,food) VALUES (?,?,?)");
$data = array(NULL,$_POST['user'],$_POST['food']);
if($stt->execute($data)){
    echo "Added successfully";
}else{
    echo "Failed to add";
}