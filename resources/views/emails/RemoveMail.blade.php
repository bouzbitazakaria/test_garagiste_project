
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Removal Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 10px;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Removal Notification</h1>
        <p>Dear {{ $mailData['firstName'] }} {{ $mailData['lastName'] }},</p>
        <p>We regret to inform you that your account with username <span class="highlight">{{ $mailData['username'] }}</span> has been removed from our system.</p>
        <p>If you believe this action was taken in error, or if you have any questions, please feel free to contact our support team.</p>
        <p>Thank you for your understanding.</p>
    </div>
    <div class="footer">
        <p><em>This is an automated email, please do not reply.</em></p>
    </div>
</body>
</html>
