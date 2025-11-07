<?php
date_default_timezone_set('Asia/Kolkata');


echo "<h3>Current Date & Time: " . date("d-m-Y H:i:s") . "</h3>";

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dob_raw = $_POST['dob'] ?? '';

    if (empty($dob_raw)) {
        $message = "<p style='color:red;'>Please enter your Date of Birth.</p>";
    } else {
       
        $birth = DateTime::createFromFormat('Y-m-d', $dob_raw);
        $errors = DateTime::getLastErrors();

        if ($birth === false || $errors['error_count'] || $errors['warning_count']) {
            $message = "<p style='color:red;'>Invalid date format. Please use the date picker (YYYY-MM-DD).</p>";
        } else {
            
            $today = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $currentYear = (int)$today->format('Y');

            $bMonth = (int)$birth->format('m');
            $bDay   = (int)$birth->format('d');

          
            if ($bMonth === 2 && $bDay === 29) {
                if (checkdate(2, 29, $currentYear)) {
                    $nextBirthday = DateTime::createFromFormat('Y-m-d', sprintf('%04d-02-29', $currentYear));
                } else {
                    
                    $nextBirthday = DateTime::createFromFormat('Y-m-d', sprintf('%04d-02-28', $currentYear));
                }
            } else {
                $nextBirthday = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $currentYear, $bMonth, $bDay));
            }

            
            if ($nextBirthday < $today) {
                $nextBirthday->modify('+1 year');
            }

            $interval = $today->diff($nextBirthday);
            $daysLeft = (int)$interval->days;
            $formattedNext = $nextBirthday->format('d-m-Y');
            $weekday = $nextBirthday->format('l');

            if ($daysLeft === 0) {
                $message = "<p style='color:green; font-weight:bold;'>Happy Birthday! 🎉 Your birthday is today ({$formattedNext}).</p>";
            } else {
                $message  = "<p>Your next birthday will be on <strong>{$formattedNext}</strong> ({$weekday}).<br>";
                $message .= "Days left until next birthday: <strong>{$daysLeft}</strong>.</p>";
            }
        }
    }
}
?>


<form method="post" style="margin-top:10px;">
    <label>Enter your Date of Birth (YYYY-MM-DD): </label>
    <input type="date" name="dob" required>
    <button type="submit">Check</button>
</form>

<hr>

<?php

if (!empty($message)) {
    echo $message;
}
?>

