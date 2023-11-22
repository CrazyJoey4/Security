<?php
// Add your PHP and MySQL configuration and initialization code here
// For example, you might use mysqli_connect to connect to your database

// Initialize variables
$isRecaptchaVerified = false;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify reCAPTCHA
    $recaptchaSecretKey = '6LdGKBgpAAAAANTTlv9EblGac0vE9TK2LTrSXH2h';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = [
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse,
    ];

    $options = [
        'http' => [
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'method' => 'POST',
            'content' => http_build_query($recaptchaData),
        ],
    ];

    $context = stream_context_create($options);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
    $recaptchaResult = json_decode($recaptchaResult, true);

    if ($recaptchaResult['success']) {
        // reCAPTCHA verification passed
        $isRecaptchaVerified = true;

        // Your further processing logic goes here (e.g., database interactions)
    } else {
        // reCAPTCHA verification failed
        echo '<script>alert("reCAPTCHA verification failed. Please try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <form method="post" action="">
        <div class="recaptcha" id="recaptcha-container" data-sitekey="6LdGKBgpAAAAAMsydD7B6MPDVDHnFF66JP31kovI"></div>

        <!-- Your other form fields go here -->

        <input type="submit" value="Submit">
    </form>

    <!-- Validation Script -->
    <script>
        // Validation
        var isRecaptchaVerified = <?php echo json_encode($isRecaptchaVerified); ?>;

        if (!isRecaptchaVerified) {
            alert('Please complete the reCAPTCHA.');
            // Handle the case where reCAPTCHA is not verified
        }
    </script>

</body>

</html>
