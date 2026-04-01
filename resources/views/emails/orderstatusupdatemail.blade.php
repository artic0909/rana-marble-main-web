<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Order Status Update - Rana Marble</title>
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
            margin: 0 0 12px;
        }

        .status-badge {
            display: inline-block;
            background: linear-gradient(135deg, #c9973a, #e8b84b, #c9973a);
            color: #2a1206;
            font-family: 'Cinzel', serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 10px 30px;
            border-radius: 20px;
            margin: 10px 0 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .body-text {
            font-family: 'Lora', serif;
            font-size: 14px;
            font-style: italic;
            color: #c49a6c;
            line-height: 1.9;
            margin: 0 0 20px;
        }

        .cta-button {
            display: inline-block;
            background: transparent;
            border: 1px solid #c9973a;
            color: #e8c96a !important;
            text-decoration: none;
            font-family: 'Cinzel', serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 14px 40px;
            margin-top: 10px;
            border-radius: 2px;
            transition: all 0.3s;
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
                    <p class="greeting">Update on Your Order</p>
                    <p class="body-text">
                        Hello {{ $order->customer->name }}, we are writing to inform you that the status of your order
                        <strong>#{{ $order->order_number }}</strong> has been updated to:
                    </p>
                    <div class="status-badge">
                        {{ ucfirst($order->status) }}
                    </div>
                    <p class="body-text">
                        @if($order->status == 'processing')
                        Our artisans are currently preparing your order with the utmost care and devotion.
                        @elseif($order->status == 'shipped')
                        Your order has left our facility and is on its way to your doorstep.
                        @elseif($order->status == 'delivered')
                        Your order has been successfully delivered. We hope it brings divine beauty to your home.
                        @elseif($order->status == 'cancelled')
                        Your order has been cancelled. If you have any questions, please reach out to our support team.
                        @else
                        We are currently processing your request.
                        @endif
                    </p>
                    <a href="{{ route('customer.orders') }}" class="cta-button">View Order Details</a>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p class="footer-brand">Rana Marble &amp; Home Marble Singhasan</p>
                    <p class="footer-text">
                        Bagnan, Howrah, West Bengal<br>
                        Support: +917364957139
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
