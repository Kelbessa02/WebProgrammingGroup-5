<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Group5DB";

$conn= new mysqli($servername, $username, $password,$dbname); 

$sql = "select
          Id, 
          Fname, 
          Lname, 
          Email 
          FROM Student";


$result =mysqli_query($conn, $sql);

// output data for each row
echo "<p style='text-align: center; font-size: 30px;'>Display Table On Browser</p>";



echo "<table border='1' style='margin: auto; border-collapse: collapse; width: 50%; text-align: center;font-size:20px;'>";

echo "<tr> 

        <td> ID </td> 
        <td> Fname </td>  
        <td> Lname </td> 
        <td> Email</td 
</tr> ";

while($row=mysqli_fetch_assoc($result)){
    echo "<tr> 
            <td>{$row["Id"]}</td> 
             <td>{$row["Fname"]}</td> 
             <td>{$row["Lname"]}</td> 
             <td>{$row["Email"]}</td>
         </tr>";
}

echo "</table>";



mysqli_close($conn);
?>