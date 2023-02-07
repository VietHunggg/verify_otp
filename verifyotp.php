<?php
session_start();
include_once("connect.php");
//include_once("session_check.php");

header('Content-Type: text/html; charset=UTF-8');
function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verify"])) {
    $email = addslashes($_POST["email"]);
    $otp   = addslashes($_POST["otp"]);


    if (!$otp) {
        echo "Please enter your OTP !";
        exit;
    }

    $connecttion = mysqli_connect('localhost', 'root', '', 'socialnet');
    if (mysqli_num_rows(mysqli_query($connecttion, "SELECT email and otp FROM users WHERE email='$email' and otp = '$otp'")) > 0) {
        Function_alert("Thank you for register !");
        header("Refresh:1; url=index.html");
    }
    else {
        Function_alert("Please enter your OTP again ! <a href = 'verifyotp.php'>Enter OTP again</a>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <form class="login-form" action="" method="POST">
                <h2>Verify OTP</h2>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your Email" required />
                </div>
                <div class="form-group">
                    <label>Verify OTP</label>
                    <input type="otp" name="otp" class="form-control" placeholder="Enter your OTP sent in email" required />
                </div>
                <div class="form-group">
                    <input type="submit" name="verify" class="btn btn-primary btn-lg btn-block" value="Verify">
                </div>
            </form>
        </div>
    </div>
</body>

</html>