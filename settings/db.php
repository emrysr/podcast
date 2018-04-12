<?php
//local 
$db = new mysqli("localhost", "root", "", "podcasts");
//live
$db = new mysqli("213.171.200.88", "arfondav", "NXha@9*yxd2zA&@I", "podcasts");

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>