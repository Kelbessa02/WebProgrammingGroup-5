<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Group5DB";

$conn= new mysqli($servername, $username, $password,$dbname); 

$sql = "select Id, Fname, Lname, Email From Student";
$result =mysqli_query($conn, $sql);
// outpu data for each row

echo "<table border =1 ";
echo "<tr> <td> ID </td> <td> Fname </td>  <td> Lname </td> <td> Email</td </tr> ";
while($row=mysqli_fetch_assoc($result)){
    echo "<tr>  <td>{$row["Id"]}</td>  <td>{$row["Fname"]}</td>  <td>{$row["Lname"]}</td>  <td>{$row["Email"]}</td>  </tr>";
}



echo "</table>";
mysqli_close($conn);
?>