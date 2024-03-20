<?php
// MySQL Connection
$mysqli = new mysqli("localhost", "root", "", "guvi");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare and bind parameters
$stmt = $mysqli->prepare("INSERT INTO register (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);

// Set parameters and execute
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($stmt->execute() === TRUE) {
    // MongoDB Connection
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = [
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'contact' => $_POST['contact'],
        'dob' => $_POST['dob']
    ];
    $bulk->insert($document);
    $manager->executeBulkWrite('user_profiles.users', $bulk);

    echo "Signup successful! Redirecting to login page...";
    // Redirect to login page after 2 seconds
    echo "<script>setTimeout(function(){ window.location.href = 'login.html'; }, 2000);</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
