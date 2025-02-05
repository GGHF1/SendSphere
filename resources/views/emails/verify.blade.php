<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Required: Verify Your Email for SendSphere</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        p {
            font-size: 16px;
            margin: 20px 0;
        }
        a.btn {
            display: inline-block;
            background: linear-gradient(45deg, #A16DF2, #56CCF2);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }
        a.btn:hover {
            background: linear-gradient(45deg, #9160DC, #4DBBD1);
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
        .footer a {
            color: #A16DF2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Welcome to SendSphere!</h1>
        <p>Hello, {{ $fname }}! Thank you for signing up! To start using SendSphere, please verify your email address by clicking the button below:</p>
        <a href="{{ $url }}" class="btn">Verify Email Address</a>
        <p>If you did not create this account, you can safely ignore this email.</p>
        <p>Thank you,<br>The SendSphere Team</p>
        <div class="footer">
            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
            <p>If the button above doesn’t work, copy and paste this link into your browser:</p>
            <p><a href="{{ $url }}">{{ $url }}</a></p>
            <p>Sent by SendSphere | <a href="mailto:spheresend@gmail.com">Contact Us</a></p>
        </div>
    </div>
</body>
</html>
