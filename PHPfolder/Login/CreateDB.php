<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Group5DB";

// Create a connection 
$conn= new mysqli($servername, $username, $password,$dbname ); 
// Check connection 
if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 
//$sql = "DROP database Group5DB";
//$sql = "create database Group5DB";
$sql = "CREATE TABLE Register(Id Varchar(30) primary key,
                               Fname Varchar(30) NOT NULL,
                               Lname Varchar(30) NOT NULL,
                               Sex Varchar(6) NOT NULL,
                               Email Varchar(30) NOT NULL,
                               password Varchar(30) NOT NULL )";
//$sql = "create table Student(
    // Id int(6) unsigned auto_increment primary key,
    // Fname Varchar(30)not null,   
    // Lname varchar (30),
    // Sex varchar(5) not null,
    // Email varchar(50) not null,
    // Password Varchar(50) not null
    // )";
    // $sql = "drop table student";
   //$sql ="insert into Student(Fname,Lname, Sex, password, Email) values('Kelbe','Adugna','Male', '1q2w3e', 'kelbessaadugna@gmail.com')";


    
if(mysqli_query($conn,$sql)){
    echo "table is added succesfully";
}else{
echo "Error craeting database".mysqli_error($conn);
}
mysqli_error($conn);
?>