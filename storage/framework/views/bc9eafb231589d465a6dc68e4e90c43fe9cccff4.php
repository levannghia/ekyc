<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: "Garamond";
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .content {
        padding: 40px;
        background: white;
        border-radius: 13px;
    }
</style>

<body>
    <div class="container">
        <div class="content">
            <div class="logo">
                <img src="<?php echo e(asset('images/logo-kyc.png')); ?>" alt="">
            </div>

            <h4 style="color:#0098A2;">
                Dear e-KYC VERTIFICATION
            </h4>
            <br>
            <p>We are happy to notify that you OTP KYC vertification </p>
            <br>
            <p>Your OTP : <b style="font-weight: bold;color:black;"><?php echo e($otp); ?></b></p>
            <br>
            Thank you so much!.
        </div>

    </div>

</body>

</html><?php /**PATH D:\wamp64\www\ekyc\app\Modules/Sites/Views/email/send_mail.blade.php ENDPATH**/ ?>