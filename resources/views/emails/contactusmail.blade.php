<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>New Customer Enquiry - Rana Marble</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:ital,wght@0,400;0,500;1,400;1,500&display=swap"
        rel="stylesheet" />
    <style>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
            display: block;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #2a1206;
            font-family: 'Lora', Georgia, serif;
        }

        .email-wrapper {
            background-color: #2a1206;
            padding: 36px 16px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #3d1f0a;
            border: 1px solid #6b3a18;
            overflow: hidden;
        }

        .top-border {
            background: linear-gradient(90deg, #6b3a18, #c9973a, #e8b84b, #c9973a, #6b3a18);
            height: 3px;
        }

        .header {
            background-color: #2e1508;
            padding: 40px 48px 32px;
            text-align: center;
            border-bottom: 1px solid #5a2e0e;
        }

        .brand-name {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            font-weight: 700;
            color: #e8c96a;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0 0 8px;
            line-height: 1.15;
        }

        .body-section {
            padding: 40px 48px;
            background-color: #3d1f0a;
        }

        .greeting {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 600;
            color: #e8c96a;
            margin: 0 0 12px;
            text-align: center;
        }

        .details-box {
            background: rgba(201, 168, 76, 0.05);
            border: 1px solid rgba(201, 168, 76, 0.2);
            padding: 24px;
            margin: 20px 0 30px;
            border-radius: 4px;
        }

        .info-row {
            margin-bottom: 16px;
        }

        .info-label {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            color: #c9973a;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-val {
            font-family: 'Lora', serif;
            font-size: 15px;
            color: #e8c96a;
            font-weight: 500;
        }

        .message-title {
            font-family: 'Cinzel', serif;
            font-size: 13px;
            letter-spacing: 2px;
            color: #c9973a;
            margin-bottom: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid #5a2e0e;
            padding-bottom: 8px;
        }

        .message-content {
            font-family: 'Lora', serif;
            font-size: 14px;
            font-style: italic;
            color: #c49a6c;
            line-height: 1.9;
            background-color: #2e1508;
            padding: 24px;
            border-radius: 2px;
            border-left: 3px solid #6b3a18;
        }

        .footer {
            background-color: #2a1206;
            padding: 32px 48px;
            text-align: center;
            border-top: 1px solid #5a2e0e;
        }

        .footer-brand {
            font-family: 'Cinzel', serif;
            font-size: 13px;
            letter-spacing: 4px;
            color: #6b4020;
            text-transform: uppercase;
            margin: 0;
        }

        .bottom-border {
            background: linear-gradient(90deg, #6b3a18, #c9973a, #e8b84b, #c9973a, #6b3a18);
            height: 3px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <table class="email-container" role="presentation" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="top-border"></td>
            </tr>
            <tr>
                <td class="header">
                    <h1 class="brand-name">Rana Marble</h1>
                </td>
            </tr>
            <tr>
                <td class="body-section">
                    <p class="greeting">New Enquiry Received</p>
                    <p style="color: #c49a6c; font-style: italic; text-align: center; margin-bottom: 30px;">
                        Hello Admin, a new customer enquiry has been submitted via the contact form.
                    </p>

                    <div class="details-box">
                        <div class="info-row">
                            <div class="info-label">Customer Name</div>
                            <div class="info-val">{{ $contact['name'] }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email Address</div>
                            <div class="info-val">{{ $contact['email'] ?? 'Not provided' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Phone Number</div>
                            <div class="info-val">{{ $contact['mobile'] }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Inquiry About / Subject</div>
                            <div class="info-val">{{ $contact['inquiry_about'] }}</div>
                        </div>
                    </div>

                    <div class="message-title">Message Content</div>
                    <div class="message-content">
                        {!! nl2br(e($contact['message'])) !!}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p class="footer-brand">Rana Marble &amp; Home Marble Singhasan</p>
                </td>
            </tr>
            <tr>
                <td class="bottom-border"></td>
            </tr>
        </table>
    </div>
</body>

</html>
