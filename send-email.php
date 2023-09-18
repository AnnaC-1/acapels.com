session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the Form Data
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
