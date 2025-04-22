<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Invoice</title>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                line-height: 1.5;
                color: #333;
                padding: 40px;
            }

            .header,
            .footer {
                text-align: center;
            }

            .header h1 {
                margin-bottom: 5px;
            }

            .info-table {
                width: 100%;
                margin-bottom: 30px;
                border-collapse: collapse;
            }

            .info-table td {
                padding: 8px;
            }

            .section-title {
                margin-top: 30px;
                margin-bottom: 10px;
                font-weight: bold;
                border-bottom: 1px solid #ccc;
                padding-bottom: 5px;
            }

            .amount {
                font-size: 20px;
                font-weight: bold;
                color: #1a8f3c;
            }

            .text-right {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Invoice</h1>
            <p><strong>Date Issued:</strong> {{ \Carbon\Carbon::parse($issued_at)->format('F j, Y') }}</p>
        </div>

        <table class="info-table">
            <tr>
                <td><strong>Client Name:</strong></td>
                <td>{{ $clientName }}</td>
            </tr>
            <tr>
                <td><strong>Project:</strong></td>
                <td>{{ $project_name }}</td>
            </tr>
            <tr>
                <td><strong>Hourly Rate:</strong></td>
                <td>${{ number_format($hourly_rate, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total Hours:</strong></td>
                <td>{{ number_format($total_hours, 2) }} Hours</td>
            </tr>
        </table>

        <div class="section-title">Total Amount Due</div>
        <p class="amount">${{ number_format($total, 2) }}</p>

        <div
            class="footer"
            style="margin-top: 100px;"
        >
            <p>Thank you for your business!</p>
        </div>
    </body>

</html>
