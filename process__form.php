<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mobile = filter_var(trim($_POST["mobile"]), FILTER_SANITIZE_STRING);
    $query = filter_var(trim($_POST["query"]), FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?status=error"); // Redirect wit error
        exit;
    }

    // Your email address where you want to receive messages
    $recipient = "simarjeet352tax@gmail.com"; // <-- IMPORTANT: Change this to your actual email

    // Subject of the email
    $email_subject = "New Contact Form Submission from Your Website";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Mobile: " . ($mobile ? $mobile : "N/A") . "\n";
    $email_content .= "Query:\n$query\n";

   // Build the email headers
    $email_headers = "From: " . $name . " <" . $email . ">\r\n";
    $email_headers .= "Reply-To: " . $email . "\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Success: Redirect back to the form page with a success message
        header("Location: contact.html?status=success");
        exit;
   } else {
        // Error: Redirect back to the form page with an error message
        header("Location: contact.html?status=error");
        exit;
    }

} else {
    // Not a POST request, redirect to the contact form
    header("Location: contact.html");
    exit;
}
?>
