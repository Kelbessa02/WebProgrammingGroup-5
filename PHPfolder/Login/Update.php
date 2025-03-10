<?php
session_start(); // Start session at the beginning

// Check if user is logged in
if (isset($_SESSION['Id'])) {  
    die("Unauthorized access.");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Group5DB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user_id = $_SESSION['Id'];
$sql = "SELECT Fname, Lname, Email FROM Register WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_fname = trim($_POST['Fname']);
    $new_lname = trim($_POST['Lname']);
    $new_email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $new_password = trim($_POST['Password']);

    // Validate input
    if (empty($new_fname) || empty($new_lname) || empty($new_email)) {
        $_SESSION['error'] = "First name, last name, and email are required.";
        header("Location: Update.php");
        exit();
    }

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {  
        $_SESSION['error'] = "Invalid email format.";
        header("Location: Update.php");
        exit();
    }

    // Prepare SQL statement
    if (!empty($new_password)) {  
        if (strlen($new_password) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters long.";
            header("Location: Update.php");
            exit();
        }
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE Register SET Fname = ?, Lname = ?, Email = ?, Password = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $new_fname, $new_lname, $new_email, $hashed_password, $user_id);
    } else {
        $sql = "UPDATE Register SET Fname = ?, Lname = ?, Email = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $new_fname, $new_lname, $new_email, $user_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: Update.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Your Profile</title>
    <link rel="stylesheet" href="css/update.css">
</head>
<body>
    <h1 style="background-color: aqua; color: aliceblue; text-align: center;">Update Your Information</h1>
    
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <div class="update">
        <form method="POST" action="" class="update-form">
            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" value="" required><br><br>

            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" value="" required><br><br>

            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" value="" required><br><br>

            <label for="Password">New Password (optional):</label>
            <input type="password" id="Password" name="Password"><br><br>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</body>
</html>
