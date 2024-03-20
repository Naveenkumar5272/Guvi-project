<?php
session_start();
// MongoDB Connection
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Fetch user data based on email
$filter = ['email' => $_SESSION['email']]; // Assuming email is stored in session after login
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('user_profiles.users', $query);

// Display user data
foreach ($cursor as $document) {
    echo '<p><strong>Name:</strong> ' . $document->name . '</p>';
    echo '<p><strong>Email:</strong> ' . $document->email . '</p>';
    echo '<p><strong>Age:</strong> ' . $document->age . '</p>';
    echo '<p><strong>Gender:</strong> ' . $document->gender . '</p>';
    echo '<p><strong>Contact:</strong> ' . $document->contact . '</p>';
    echo '<p><strong>Date of Birth:</strong> ' . $document->dob . '</p>';
}
?>
