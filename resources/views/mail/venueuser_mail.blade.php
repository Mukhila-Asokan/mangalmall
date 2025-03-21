<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="padding: 20px; font-family: Arial, sans-serif;">

        <h2>Dear {{ $venueUser->name }},</h2>

        <p>Thanks for Regsitering in Mangal Mall!</p>

        <p>You are invited to Mangal Mall from <strong>{{ \Session::get('username') }}</strong></p>

        <p>Please click the button below to verify your account:</p>
        
        <p>
            <a href="{{ route('verify-account', ['id' => $venueUser->id]) }}" 
               style="display: inline-block; padding: 12px 20px; font-size: 16px; color: #ffffff; background-color: #58111A; text-decoration: none; border-radius: 5px;">
               Verify Your Account
            </a>
        </p>

        <p>If you did not request this, please ignore this email.</p>

        <p>Regards,<br>Mangal Mall</p>
        <br>
        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" width="150">
    </div>
</body>
</html>
