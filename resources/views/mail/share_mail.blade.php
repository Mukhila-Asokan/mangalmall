<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Shared Notification</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #f8f9fa; color: #333;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        
        <h2 style="color: #58111A;">Dear {{ $guest->name }},</h2>

        <p><strong>{{ auth()->user()->name }}</strong> has shared an event with you!</p>
        
        <h3 style="color: #333;">Event: {{ $event->occasion_name }}</h3> 
        <p>Date: <strong>{{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }}</strong></p>

        <p>Here is the agenda for the event:</p>

        <!-- Event Itinerary Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="background-color: #58111A; color: #fff;">
                    <th style="padding: 8px; text-align: left;">Itinerary</th>
                    <!-- <th style="padding: 8px; text-align: left;">Description</th> -->
                    <th style="padding: 8px; text-align: left;">Date</th>
                    <th style="padding: 8px; text-align: left;">Start Time</th>
                    <th style="padding: 8px; text-align: left;">End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventItinerary as $item)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 8px;">{{ $item->label }}</td>
                    <!-- <td style="padding: 8px;">{{ $item->description }}</td> -->
                    <td style="padding: 8px;">{{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}</td>
                    <td style="padding: 8px;">{{ $item->start_time_value.' '. $item->start_time_label }}</td>
                    <td style="padding: 8px;">{{ $item->end_time_value.' '. $item->end_time_label }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 20px;">We appreciate your support and look forward to your presence!</p>

        <p style="margin-top: 20px;">Regards,<br><strong>Mangal Mall</strong></p>

        <br>

        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" width="150" style="display: block; margin-top: 20px;">
    </div>
</body>
</html>