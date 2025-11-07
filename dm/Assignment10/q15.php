<?php
// Q15: Feedback Form with Session and Email
session_start();
$_SESSION['user'] = $_SESSION['user'] ?? 'Guest';
$sent = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = trim($_POST['feedback'] ?? '');
    $name = $_SESSION['user'] ?? 'Guest';
    if ($feedback === '') {
        $error = 'Feedback cannot be empty.';
    } else {
        $msg = "Feedback from $name: " . $feedback;
        if (mail('admin@vit.ac.in', 'Student Feedback', $msg, 'From: noreply@vit.ac.in')) {
            $sent = true;
        } else {
            $error = 'Failed to send feedback (mail not configured).';
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Q15 - Feedback</title></head>
<body>
    <h1>Q15: Feedback Form</h1>
    <p>Logged in as: <?php echo htmlspecialchars($_SESSION['user']); ?></p>
    <?php if ($sent): ?><p style="color:green;">Thank you, <?php echo htmlspecialchars($_SESSION['user']); ?>. Feedback sent!</p><?php elseif ($error): ?><p style="color:red;"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="post" action="Q15_feedback.php">
        <label>Feedback:<br><textarea name="feedback" rows="6" cols="60" required></textarea></label><br><br>
        <button type="submit">Send Feedback</button>
    </form>
</body>
</html>
