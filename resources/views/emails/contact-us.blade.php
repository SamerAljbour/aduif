<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: white;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #4CAF50;
        }
        .footer {
            text-align: center;
            color: #777;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Message</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Name:</span>
                <p>{{ $contactUs->name }}</p>
            </div>

            <div class="field">
                <span class="label">Email:</span>
                <p><a href="mailto:{{ $contactUs->email }}">{{ $contactUs->email }}</a></p>
            </div>

            <div class="field">
                <span class="label">Subject:</span>
                <p>{{ $contactUs->subject }}</p>
            </div>

            <div class="field">
                <span class="label">Message:</span>
                <p>{!! nl2br(e($contactUs->message)) !!}</p>
            </div>

            <hr>

            <p style="color: #777; font-size: 12px;">
                This message was sent from the contact form at {{ config('app.name') }}
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
