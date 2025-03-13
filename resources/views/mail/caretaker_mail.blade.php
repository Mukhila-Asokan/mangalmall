<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($action == 'add')
        <title>Caretaker Assigned</title>
    @else
        <title>Updated Caretaker's Guest Details</title>
    @endif
</head>
<body>
    <div style="padding: 20px; font-family: Arial, sans-serif;">

        <h2>Dear {{ $caretaker['name'] }},</h2>

        <p>Your guests are updated for <strong>{{ auth()->user()->name }}</strong>'s event. Please find the below details</p>

        <h4>Guest Details:</h4>
        @foreach ($guestCaretakers as $guest)
            <p><strong>{{ $guest->contact['name'] }}</strong> - {{ $guest->contact['relationship'] }}</p>
            <p>Contact: {{ $guest->contact['mobile_number'] }}</p>
            <br>
        @endforeach
        <p>Thank you for your support!</p>

        <p>Regards,<br>Mangal Mall</p>
        <br>
        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" width="150">
    </div>
</body>
</html>
