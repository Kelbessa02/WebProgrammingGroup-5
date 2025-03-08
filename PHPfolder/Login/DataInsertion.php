<?php
// Set up database credentials 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Group5DB";

// Create a connection 
$conn= new mysqli($servername, $username, $password,$dbname); 

// Prepare the SQL statement
$sql = "Insert into Student(Fname, Lname, Sex,Email,  password) VALUES(?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);//those querry is used to take many input at a time

// Bind parameters
$stmt->bind_param("sssss", $Fname, $Lname, $Sex,$Email,$password);

// Set parameters and execute
$Fname = "Sena";
$Lname = "Nifthalem";
$Sex = "Female";
$Email = "Sena@gmail.com";
$password = "123qw";
$stmt->execute();


$Fname = "Addisu";
$Lname = "Teshome";
$Sex = "Male";
$Email = "Addisu@gmail.com";
$password = "12345";
$stmt->execute();

$Fname = "Robsan";
$Lname = "H/Mikael";
$Sex = "Male";
$Email = "Robsan@gmail.com";
$password = "54321";

$stmt->execute();

$Fname = "Seifu";
$Lname = "Debebe";
$Sex = "Male";
$Email = "Seifu@gmail.com";
$password = "12123";
$stmt->execute();

    

// Check for errors
if ($stmt->error) {
    echo "Error inserting data: " . $stmt->error;
} else {
    echo "Data inserted successfully.";
}

// Close the statement and connection
$stmt->close();
mysqli_close($conn);
?>