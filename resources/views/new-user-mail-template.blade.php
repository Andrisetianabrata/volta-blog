<!DOCTYPE html>
<html>
<head>
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .welcome-header {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .volta-brand {
            color: #3498db;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .credentials-box {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 20px 0;
        }
        .login-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .login-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1 class="welcome-header">Welcome to <span class="volta-brand">VOLTA</span>, {{$name}}! 🎉</h1>
        
        <p>We're excited to have you join our community! Your account has been successfully created and is ready to use.</p>
        
        <div class="credentials-box">
            <h3>Your Login Credentials:</h3>
            <p><strong>Username:</strong> {{$username}}</p>
            <p><strong>Email:</strong> {{$email}}</p>
            <p><strong>Password:</strong> {{$password}}</p>
        </div>
        
        <p>For security reasons, we recommend changing your password after your first login.</p>
        
        <a href="{{$url}}" class="login-button">Access Your Profile →</a>
        
        <p style="margin-top: 20px;">If you have any questions or need assistance, don't hesitate to reach out to our support team.</p>
        
        <p>Best regards,<br>The VOLTA Team</p>
    </div>
</body>
</html>