<?php
$Fname = $Lname = $email = $Sex = $pass1 = $pass2 = "";
$err = array();
$congra = "";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "group5db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['SIGNUP'])) {

    $Fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $Lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $Sex = mysqli_real_escape_string($conn, $_POST['gender']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);

    // Validation
    if (empty($Fname)) { // Fixed: Added missing closing parenthesis
        array_push($err, "First name is required");
    } elseif (!preg_match("/^[a-zA-Z]+$/", $Fname)) {
        $err="First name must contain only letters";
    }

    if (empty($Lname)) {
        array_push($err, "Last name is required");
    } elseif (!preg_match("/^[a-zA-Z]+$/", $Lname)) {
        $err="Last name must contain only letters";
    }

    if (empty($email)) {
        $err ="Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err= "Invalid email format";
    }

    if (empty($pass1)) {
       $err="Password is required";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $pass1)) {
        $err = "Password must contain at least one letter, one number, and one special character";
    }

    if ($pass1 !== $pass2) {
        $err= "The two passwords do not match";
    }

    // Check if email or username exists
    $student_check_query = "SELECT * FROM student WHERE Fname='$Fname' OR Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $student_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['Fname'] === $Fname) {
            $err= "Username already exists!";
        }
        if ($user['Email'] === $email) {
            $err= "Email already exists";
        }
    }

    // If no errors, proceed with registration

        $stmt = $conn->prepare("INSERT INTO student (Fname, Lname, Sex, Email, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Fname, $Lname, $Sex, $email, $pass1);

        if ($stmt->execute()) {
            $err = "You are registered successfully. Please LOGIN now.";
        } else {
          $err= "Error: " . mysqli_error($conn);
        }

        $stmt->close();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register System</title>
    <link rel="stylesheet" href="Css/SignupStyle.css">
</head>
<body>
  
    <div class="box2">
        <h1>Signup Here</h1>
        <div class="err">
            <?php
            if (!empty($err) && is_array($err)) { // Check if $err is an array
                foreach ($err as $error) {
                    echo "<p>$error</p>";
                }
            }
            ?>
            
        </div>
        <form action="SignupForm.php" method="post">
            <input type="text" name="firstname" placeholder="Enter firstname" required>
            <input type="text" name="lastname" placeholder="Enter lastname" required>
            <input type="email" name="email" placeholder="Enter email" required>
            <label style="display: flex;">
                Gender:
                <input type="radio" name="gender" value="Male" required>Male
                <input type="radio" name="gender" value="Female" required>Female
            </label>
            <input type="password" name="pass1" placeholder="Enter password" required>
            <input type="password" name="pass2" placeholder="Confirm password" required>
            <input type="submit" value="SIGNUP" name="SIGNUP">
            Already a member? <a href="LoginForm.php" style="color:#ffc107">LOGIN</a>
        </form>
    </div> 
</body>
</html>
