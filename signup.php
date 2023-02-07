<?php
session_start();
include_once("connect.php");
//include_once("session_check.php");

header('Content-Type: text/html; charset=UTF-8');
function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $email = addslashes($_POST["email"]);
    $pass    = addslashes($_POST["password"]);

    if (!$email || !$pass) {
        echo "Fill in full information please !";
        exit;
    }

    //encrypt password
    $encrypt_password = md5($pass);
    $connecttion = mysqli_connect('localhost', 'root', '', 'socialnet');
    if (mysqli_num_rows(mysqli_query($connecttion, "SELECT email FROM users WHERE email='$email'")) > 0) {
        echo "This username is already in use ! <a href = 'signup.php'>Try again</a>";
        exit;
    }
    else {
        $from ="vhungpmpx@gmail.com";
        $to=$email;
        $subject="OTP verification from VietHung";
         // Generating otp with php rand variable
        $otp=rand(100000,999999);
        $message= "Your OTP: " .strval($otp);
        $headers ="From:" .$from;
        $success = mail($to,$subject,$message,$headers);
        $str_otp = strval($otp);
        if($success == true){
            function_alert("Send email successfully");
            @$add_user = mysqli_query($connecttion, "INSERT INTO users (
                email,
                password,
                otp
                ) 
                VALUE (
                '$email',
                '$pass',
                '$str_otp'
                )");
            if ($add_user) {
                header("Refresh:1; url=verifyotp.php");
            } else {
                echo "Register failed ! <a href = 'signup.php'>Try again</a>";
            }
        }
        else {
            echo "Register failed ! <a href = 'signup.php'>Try again</a>";
            function_alert("Error sending email");
        }
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
                <h2>Sign up</h2>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your Email" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="signup" class="btn btn-primary btn-lg btn-block" value="Signup">
                </div>
                <p>Already have account ?<a href="index.php">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>
