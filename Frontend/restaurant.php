<?php
require_once "connect.php";

$stt = $db->prepare("INSERT INTO restaurants(id,username,restaurant) VALUES (?,?,?)");
$data = array(NULL,$_POST['user'],$_POST['res']);
if($stt->execute($data)){
    echo "Added successfully";
}else{
    echo "Failed to add";
}