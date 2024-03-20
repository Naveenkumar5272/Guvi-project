<?php
session_start(); 
// Check if email and password are provided
if(isset($_POST['email']) && isset($_POST['password'])) {
    // MySQL Connection
    $mysqli = new mysqli("localhost", "root", "", "guvi");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if email exists and fetch stored password
    $stmt = $mysqli->prepare("SELECT password FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) { // If email exists
        $stored_password = $row['password'];
        if (password_verify($password, $stored_password)) { // Verify password
            $_SESSION['email'] = $email;
            echo "Login successful!";
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found!";
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Email and password are required!";
}
?>
