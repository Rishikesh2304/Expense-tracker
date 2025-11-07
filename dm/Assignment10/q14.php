<?php
// Q14: Simple Contact Form with mail()
$sent = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'example@domain.com';
    $subject = 'Contact Form Message';
    $message = trim($_POST['message'] ?? '');
    $from = trim($_POST['from'] ?? 'user@domain.com');
    $headers = "From: " . $from;
    if (!empty($message)) {
        if (mail($to, $subject, $message, $headers)) {
            $sent = true;
        } else {
            $error = 'Mail failed (ensure mail() is configured).';
        }
    } else {
        $error = 'Message cannot be empty.';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q14 - Contact Form</title></head>
<body>
    <h1>Q14: Contact Form</h1>
    <?php if ($sent): ?><p style="color:green;">Mail Sent!</p><?php elseif ($error): ?><p style="color:red;"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="post" action="Q14_contact.php">
        <label>Your Email: <input type="email" name="from" required></label><br><br>
        <label>Message:<br><textarea name="message" rows="6" cols="60" required></textarea></label><br><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>
