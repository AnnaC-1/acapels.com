<?php
session_start();

// Step 1: Generate CSRF Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 2: Validate CSRF Token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Invalid CSRF token. Handle accordingly (e.g., show an error message)
        header('Location: error.html');
        exit();
    }

    // Step 3: Process the Form Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create email headers
    $headers = 'From: '.$email."\r\n".
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Compose email body
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage:\n$message";

    // Send email
    if (mail('annacapels@gmail.com', 'New message from your personal website', $body, $headers)) {
        // Email sent successfully
        header('Location: thank-you.html');
        exit();
    } else {
        // Email failed to send
        header('Location: error.html');
        exit();
    }
}
?>
