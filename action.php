<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';
    $error_message = '';

    // Basic validation
    if (empty($fullname) || empty($email) || empty($gender)) {
        $error_message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    }

    if ($error_message) {
        header("Location: index.php?error=" . urlencode($error_message));
        exit();
    } else {
        // Store data in a text file with timestamp
        $data = "Name: $fullname, Email: $email, Gender: $gender, Newsletter: $newsletter, Time: " . date("Y-m-d H:i:s") . "\n";
        file_put_contents("submissions.txt", $data, FILE_APPEND);

        // Redirect with success message
        header("Location: indexphp.html?success=1");
        exit();
    }
} else {
    header("Location: indexphp.html");
    exit();
}
