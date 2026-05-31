<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
            line-height: 1.6;
            color: var(--color-primary);
        }
        p {
            text-align: justify;
            text-align-last: auto;
            text-justify: inter-word;
            hyphens: auto;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: var(--color-bg);
        }
        .header {
            background-color: var(--color-accent);
            color: var(--color-surface);
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: var(--color-surface);
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: var(--color-accent);
        }
        .footer {
            text-align: center;
            color: var(--color-muted);
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

            <p style="color: var(--color-muted); font-size: 12px;">
                This message was sent from the contact form at {{ config('app.name') }}
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
