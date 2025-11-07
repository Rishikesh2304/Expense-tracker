<?php
// Q10: Send an Email with an Attachment (using mail())
// Note: mail() must be configured on the server
$sent = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = trim($_POST['to'] ?? '');
    $subject = trim($_POST['subject'] ?? 'No subject');
    $messageText = trim($_POST['message'] ?? '');
    $from = trim($_POST['from'] ?? 'noreply@example.com');
    $headers = "From: $from";
    if (isset($_FILES['attach']) && $_FILES['attach']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['attach']['tmp_name'];
        $fileName = basename($_FILES['attach']['name']);
        $data = file_get_contents($fileTmp);
        $base64 = chunk_split(base64_encode($data));
        $separator = md5(time());
        $eol = PHP_EOL;
        $headers .= $eol . "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"utf-8\"" . $eol;
        $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
        $body .= $messageText . $eol;
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $fileName . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment; filename=\"" . $fileName . "\"" . $eol . $eol;
        $body .= $base64 . $eol;
        $body .= "--" . $separator . "--";
        if (mail($to, $subject, $body, $headers)) {
            $sent = true;
        } else {
            $error = "Mail failed (mail() returned false).";
        }
    } else {
        if (mail($to, $subject, $messageText, $headers)) {
            $sent = true;
        } else {
            $error = "Mail failed (mail() returned false).";
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q10 - Send Email</title></head>
<body>
    <h1>Q10: Send Email with Attachment</h1>
    <?php if ($sent): ?><p style="color:green;">Mail sent successfully.</p><?php elseif ($error): ?><p style="color:red;"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data" action="Q10_send_email_attachment.php">
        <label>To: <input type="email" name="to" required></label><br><br>
        <label>From: <input type="email" name="from" value="noreply@example.com" required></label><br><br>
        <label>Subject: <input type="text" name="subject" value="Test Email"></label><br><br>
        <label>Message:<br><textarea name="message" rows="6" cols="60"></textarea></label><br><br>
        <label>Attachment: <input type="file" name="attach"></label><br><br>
        <button type="submit">Send</button>
    </form>
    <p>Note: server must be configured to send mail.</p>
</body>
</html>
