<?php
$connection = mysqli_connect('localhost', 'root',  '', 'lunch_box');

if($connection){
    echo "we are there";


} else {
    die("database conecttion failed");
}

?>