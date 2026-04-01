<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Your Verification Code - Rana Marble</title>
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
            text-align: center;
        }

        .greeting {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: 600;
            color: #e8c96a;
            margin: 0 0 18px;
        }

        .body-text {
            font-family: 'Lora', serif;
            font-size: 14px;
            font-style: italic;
            color: #c49a6c;
            line-height: 1.9;
            margin: 0 0 24px;
        }

        .otp-box {
            display: inline-block;
            background-color: #2e1508;
            border: 1px solid #c9973a;
            color: #e8c96a;
            font-family: 'Cinzel', serif;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 12px;
            padding: 20px 40px;
            border-radius: 4px;
            margin: 10px 0 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
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
            margin: 0 0 14px;
        }

        .footer-text {
            font-family: 'Lora', serif;
            font-size: 11px;
            font-style: italic;
            color: #5a3218;
            line-height: 1.8;
            margin: 14px 0;
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
                    <p class="greeting">Security Verification</p>
                    <p class="body-text">
                        You have requested to reset your password. Please use the following One-Time Password (OTP) to
                        proceed. This code is valid for 10 minutes.
                    </p>
                    <div class="otp-box">
                        {{ $otp }}
                    </div>
                    <p class="body-text">
                        If you did not request this, please ignore this email or contact support if you have concerns
                        about your account security.
                    </p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p class="footer-brand">Rana Marble &amp; Home Marble Singhasan</p>
                    <p class="footer-text">
                        Bagnan, Howrah, West Bengal<br>
                        Contact: +917364957139
                    </p>
                </td>
            </tr>
            <tr>
                <td class="bottom-border"></td>
            </tr>
        </table>
    </div>
</body>

</html>
