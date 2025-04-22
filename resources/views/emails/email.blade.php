<!DOCTYPE html>
<html>

    <head>
        <title>Invoice Created</title>
    </head>

    <body>
        <h1>Invoice Created</h1>
        <p>Dear {{ $clientName }},</p>
        <p>Your invoice for the project {{ $project_name }} has been generated.</p>
        <p>Invoice details:</p>
        <ul>
            <li>Hourly Rate: ${{ number_format($hourly_rate, 2) }}</li>
            <li>Total Hours: {{ number_format($total_hours, 2) }}</li>
            <li>Total: ${{ number_format($total, 2) }}</li>
        </ul>
        <p>The PDF invoice is attached to this email.</p>
    </body>

</html>
