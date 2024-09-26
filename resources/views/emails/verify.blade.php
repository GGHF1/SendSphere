<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - SendSphere</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: black;
            text-align: center;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: justify;
        }
        .btn {
            display: block;
            width: 200px;
            text-align: center;
            background: linear-gradient(45deg, #A16DF2, #56CCF2);
            color: white !important;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 auto 20px auto;
            transition: background 0.3s ease;
            font-size: 16px;
        }
        .btn:hover {
            background: linear-gradient(45deg, #9160DC, #4DBBD1); /* Darker hover effect */
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Welcome to SendSphere!</h1>
        <p>Thank you for registering with us. Please verify your email address by clicking the button below:</p>
        
        <a href="{{ $url }}" class="btn">Verify Email Address</a>

        <p>If you did not create this account, no further action is required.</p>
        <p>Best regards,<br>SendSphere Team</p>

        <div class="footer">
            <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;">

            <p>If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {{ $url }}</p>
            <p>© 2024 SendSphere. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
