<?php
    include("connect.php");
    session_start();

    $object = new Connect();

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
            $USER_id = $_POST['User_ID'];
            $USER_pwd = $_POST['User_pwd'];

            $query = "SELECT * FROM user_table WHERE User_ID = ?";
            $statement = mysqli_prepare($connected, $query);

            if ($statement) {
                mysqli_stmt_bind_param($statement, "s", $USER_id);
                mysqli_stmt_execute($statement);

                $result = mysqli_stmt_get_result($statement);

                // Check if a row exists for the given User_ID
                if ($row = mysqli_fetch_assoc($result)) {
                    // Verify the entered password against the hashed password in the database
                    if (password_verify($USER_pwd, $row['User_pwd'])) {
                        $_SESSION['User_ID'] = $row['User_ID'];
                        $DATETIME = $object->get_datetime();

                        mysqli_query($connected, "INSERT INTO `attendance_table` (`Staff_ID`, `LoginTime`) VALUES ('".$_SESSION['User_ID']."', '$DATETIME');");
                        header("location:Dashboard.php");
                    } else {
                        $_SESSION['message'] = "Login failed. Please check your ID and password.";
                        header("location:index.php?st=failure");
                    }
                } else {
                    $_SESSION['message'] = "Login failed. User not found.";
                    header("location:index.php?st=failure");
                }

                // Close the statement
                mysqli_stmt_close($statement);
            }
        } else {
            // reCAPTCHA verification failed
            $_SESSION['message'] = "reCAPTCHA verification failed. Please try again.";
            header("location:index.php?st=failure");
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
            <input type="text" name="User_ID" placeholder="User ID" required>
            <input type="password" name="User_pwd" placeholder="Password" required>

            <input type="submit" name="Sign" value="Submit">
        </form>

    </body>

</html>
