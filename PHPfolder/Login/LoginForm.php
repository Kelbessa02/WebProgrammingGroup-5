<?php
$Fname = "";
$password = "";
$err ="";
 //database connection
 $conn = mysqli_connect("localhost", "root",
 "","db");

 if(isset($_POST['LOGIN'])){
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql ="select * from Student where Fname ='".$Fname."' and password = '".$password."' limit 1";
    $result = mysqli_query($conn, $sql);

    if (empty($Fname)){
        $err = "username is mandatory";
    }elseif(empty($password)){
        $err = "password is required"; 
    
    }elseif(mysqli_num_rows($result) ==1){
        header('location: home.php');
    }else{
        $err = "username or not is incorrect";
    }
 }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="Css/loginStyle.css">
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
</html><?php
$Fname = "";
$password = "";
$err ="";
 //database connection
 $conn = mysqli_connect("localhost", "root",
 "","login");

 if(isset($_POST['LOGIN'])){
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql ="select * from Register where Fname ='".$Fname."' and password = '".$password."' limit 1";
    $result = mysqli_query($conn, $sql);

    if (empty($Fname)){
        $err = "username is mandatory";
    }elseif(empty($password)){
        $err = "password is required"; 
    
    }elseif(mysqli_num_rows($result) ==1){
        header('location: Home.php');
    }else{
        $err = "username or not is incorrect";
    }
 }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="Css/loginStyle.css">
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
            Not yet Member? <a href="SignupForm.php" style="color: #ffc107;">Signup</a>


        </form>

    </div>
</body>
</html>