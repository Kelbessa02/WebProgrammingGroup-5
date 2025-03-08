<?php
require "DatabaseConnection.php";
$sql = "create database Group5DB";
if(mysqli_query($conn,$sql)){
    echo "database is created succesfully";
}else{
echo "Error craeting database".mysqli_error($conn);
}
mysqli_error($conn);
?>