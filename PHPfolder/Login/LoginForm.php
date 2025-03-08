<?php
// $servername = "localhost"; 
// $username = "root"; 
// $password = ""; 
// $dbname = "Group5DB";
// $err ="";

// // Create a connection 
// $conn= new mysqli($servername, $username, $password,$dbname); 

//  if(isset($_POST['LOGIN'])){
//     $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);


//     $password = mysqli_real_escape_string($conn, $_POST['password']);


//     $sql ="select * from user where Fname ='".$Fname."' and password = '".$password."' limit 1";
    
//     $result = mysqli_query($conn, $sql);

//     if (empty($Fname)){
//         $err = "username is mandatory";
//     }elseif(empty($password)){
//         $err = "password is required"; 
    
//     }elseif(mysqli_num_rows($result) ==1){
//         header('location: home.php');
//     }else{
//         $err = "username or not is incorrect";
//     }
//  }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="css/LoginStyle.css">
</head>
<body>
    <div class="box">
        <h1>LOGIN HERE</h1>
         <div class="err">
           <?php echo $err; ?> 
        </div>
        <form action="Login.php" method="post">
            <input type="text" name="Fname" id="" placeholder="Please enter username">
            <input type="password" name="password" id="" placeholder="please inter your password">
            <input type="submit" value="LOGIN" name="LOGIN">
            Not yet Member? <a href="Signup.php" style="color: #ffc107;">Signup</a>
        </form>

    </div>
 
</body>
</html>