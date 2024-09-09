<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['contact-phone'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['contact-email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['contact-message'], FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare email
    $to = "arjunrose2005@gmail.com"; // Replace with your email address
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    $full_subject = "Contact Form Submission: $subject";
    $body = "Name: $name\nPhone: $phone\nEmail: $email\n\nMessage:\n$message";

    // Send email
    if (mail($to, $full_subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request method.";
}
?>
