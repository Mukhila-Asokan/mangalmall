<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="padding: 20px; font-family: Arial, sans-serif;">

        <h2>Dear {{ $collaborate['name'] }},</h2>

        <p>You are collaborate with <strong>{{ auth()->user()->name }}</strong>'s event. Please login to our site using below link</p>
        <p>
            <a href="{{ config('app.project_url') }}" 
               style="display: inline-block; padding: 12px 20px; font-size: 16px; color: #ffffff; background-color: #58111A; text-decoration: none; border-radius: 5px;">
               Login
            </a>
        </p>
        <p>Thank you for your support!</p>

        <p>Regards,<br>Mangal Mall</p>
        <br>
        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" width="150">
    </div>
</body>
</html>
