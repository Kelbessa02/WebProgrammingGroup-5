<?php
$Fname = $Lname = $email = $Sex = $pass1 = $pass2 = "";
$err = array(); // Initialize error array
$congra = "";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "group5db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['SIGNUP'])) {
    // Clear previous errors
    $err = array();

    $Fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $Lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $Sex = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : "";
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);

    // Validation
    if (empty($Fname)) {
        array_push($err, "First name is required");
    } elseif (!preg_match("/^[a-zA-Z]+$/", $Fname)) {
        array_push($err, "First name must contain only letters");
    }

    if (empty($Lname)) {
        array_push($err, "Last name is required");
    } elseif (!preg_match("/^[a-zA-Z]+$/", $Lname)) {
        array_push($err, "Last name must contain only letters");
    }

    if (empty($email)) {
        array_push($err, "Email is required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($err, "Invalid email format");
    }

    if (empty($Sex)) {
        array_push($err, "Gender is required");
    }

    if (empty($pass1)) {
        array_push($err, "Password is required");
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $pass1)) {
        array_push($err, "Password must contain at least one letter, one number, one special character, and be at least 8 characters long");
    }

    if ($pass1 != $pass2) {
        array_push($err, "Passwords do not match");
    }

    // Check if email exists
    $Register_check_query = "SELECT * FROM Register WHERE Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $Register_check_query);
    
    if (!$result) {
        array_push($err, "Database error: " . mysqli_error($conn));
    } else {
        $Register = mysqli_fetch_assoc($result);
        if ($Register) {
            array_push($err, "Email already exists");
        }
    }

    // If no errors, proceed with registration
    if (empty($err)) {
        // **No password hashing as per your request**
        $stmt = $conn->prepare("INSERT INTO Register (Fname, Lname, Sex, Email, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Fname, $Lname, $Sex, $email, $pass1);

        if ($stmt->execute()) {
            $congra = "You are registered successfully. Please LOGIN now.";
        } else {
            array_push($err, "Error: " . $stmt->error);
        }

        $stmt->close();
    }
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
            if (!empty($err)) {
                foreach ($err as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }
            }
            if (!empty($congra)) {
                echo "<p style='color:green;'>$congra</p>";
            }
            ?>
        </div>
        <form action="SignupForm.php" method="post">
            <input type="text" name="firstname" placeholder="Enter firstname" value="<?php echo htmlspecialchars($Fname); ?>" required>
            <input type="text" name="lastname" placeholder="Enter lastname" value="<?php echo htmlspecialchars($Lname); ?>" required>
            <input type="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label style="display: flex;">
                Gender:
                <input type="radio" name="gender" value="Male" <?php echo ($Sex == "Male") ? "checked" : ""; ?> required>Male
                <input type="radio" name="gender" value="Female" <?php echo ($Sex == "Female") ? "checked" : ""; ?> required>Female
            </label>
            <input type="password" name="pass1" placeholder="Enter password" required>
            <input type="password" name="pass2" placeholder="Confirm password" required>
            <input type="submit" value="SIGNUP" name="SIGNUP">
            Already a member? <a href="LoginForm.php" style="color:#ffc107">LOGIN</a>
        </form>
    </div>
</body>
</html>
