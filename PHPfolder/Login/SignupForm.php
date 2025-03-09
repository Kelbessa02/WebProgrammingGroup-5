<?php 
$Fname= "";
$Lname= "";
$email = "";
$Sex ="";
$pass1 = "";
$pass2 ="";
$err = array();
$congra ="";

//db connection
$conn = mysqli_connect("localhost","root", "","Group5DB");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['SIGNUP'])){

    $Fname= mysqli_real_escape_string($conn,$_POST['Fname']);
    $Lname=  mysqli_real_escape_string($conn,$_POST['Lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $Sex = mysqli_real_escape_string($conn,$_POST['Sex']);
    $pass1 = mysqli_real_escape_string($conn,$_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn,$_POST['pass2']);

    //validation 
    if($pass1 != $pass2){
        array_push($err, "The two passwords do not match");   
    }

    $Register_check_query = "SELECT * FROM Register WHERE Fname='$Fname' OR Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $Register_check_query);
    $Register = mysqli_fetch_assoc($result);
    
    if($Register){
        if($Register['Fname'] === $Fname){
            array_push($err, "Username already exists!");
        }
        if($Register['Email'] === $email){
            array_push($err, "Email already exists");
        }
    }

    //finally register
    if(count($err) === 0){
        $pass1 === $pass1; 
        $query = "INSERT INTO Register(Fname, Lname, Sex, Email, Password) VALUES('$Fname','$Lname','$Sex', '$email', '$pass1')";
        if(mysqli_query($conn, $query)){
            $congra = "You are registered successfully. Please LOGIN now.";
        } else {
            array_push($err, "Error: " . mysqli_error($conn));
        }
    }
}
?>

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
    <title>Signup System</title>
    <link rel="stylesheet" href="css/SignupStyle.css">
</head>
<body>
    <div class="box1">
        <h1>Signup Here</h1>
        <div class="err">
            <?php 
            if (!empty($err)) {
                foreach ($err as $error) {
                    echo "<p>$error</p>";
                }
            }
            echo $congra;
            ?>
        </div>
        <form action="Signup.php" method="post">
            <input type="text" name="Fname" placeholder="Please enter First Name" required>
            <input type="text" name="Lname" placeholder="Please enter Last Name" required>
            <input type="email" name="email" placeholder="Please enter your Email" required>
             <label for="Sex">Sex:</label>
            <input type="checkbox" name="Sex" value="Sex">Male
            <input type="checkbox" name="Sex" value="Sex">Female
            <input type="password" name="pass1" placeholder="Please enter your password" required>
            <input type="password" name="pass2" placeholder="Please confirm your password" required>
            <input type="submit" value="SIGNUP" name="SIGNUP">
            Already a Member? <a href="LoginForm.php" style="color: #ffc107;">LOGIN</a>
        </form>
    </div>
</body>
</html>