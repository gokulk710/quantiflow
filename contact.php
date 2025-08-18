<?php
$to = "quantiflow@outlook.com";
$subject_prefix = "[Quantiflow Contact] ";
if (!empty($_POST['__hp'])) { http_response_code(400); echo "Bad Request."; exit; }
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
if ($name === '' || $email === '' || $message === '') { http_response_code(422); echo "Please complete all fields."; exit; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { http_response_code(422); echo "Please provide a valid email address."; exit; }
$subject = $subject_prefix . substr($name, 0, 120);
$body = "Name: " . $name . "\n" . "Email: " . $email . "\n" . "Message:\n" . $message . "\n" . "-----\nSent from Quantiflow website form.";
$headers = "From: gokulk7100@gmail.com\r\n" . "Reply-To: " . $email . "\r\n" . "Content-Type: text/plain; charset=UTF-8\r\n";
$sent = @mail($to, $subject, $body, $headers);
if ($sent) { header("Location: thank-you.html"); exit; } else { http_response_code(500); echo "Sorry, we couldn't send your message right now."; exit; }
?>