<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Order Confirmation - Rana Marble</title>
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
            padding: 40px 48px;
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
            margin: 0;
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
            margin-bottom: 12px;
        }

        .order-meta {
            background: rgba(201, 168, 76, 0.05);
            border: 1px solid rgba(201, 168, 76, 0.2);
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .meta-item {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            color: #c9973a;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .meta-val {
            font-family: 'Lora', serif;
            font-size: 15px;
            color: #e8c96a;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .item-table th {
            text-align: left;
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 2px;
            color: #c9973a;
            border-bottom: 1px solid #5a2e0e;
            padding: 12px 0;
            text-transform: uppercase;
        }

        .item-table td {
            padding: 16px 0;
            border-bottom: 1px solid #4a2810;
        }

        .product-name {
            font-family: 'Lora', serif;
            font-size: 14px;
            color: #e8c96a;
            font-weight: 500;
        }

        .product-attr {
            font-size: 11px;
            color: #8a5c38;
            margin-top: 4px;
        }

        .item-price {
            font-family: 'Lora', serif;
            font-size: 14px;
            color: #c49a6c;
            text-align: right;
        }

        .summary-row td {
            padding: 8px 0;
            border: none;
        }

        .summary-label {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            color: #c9973a;
            text-align: right;
            padding-right: 20px !important;
        }

        .summary-val {
            font-family: 'Lora', serif;
            font-size: 14px;
            color: #e8c96a;
            text-align: right;
        }

        .total-row td {
            padding-top: 15px;
            border-top: 1px solid #5a2e0e;
        }

        .total-label {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            font-weight: 700;
            color: #e8c96a;
            text-align: right;
            padding-right: 20px !important;
        }

        .total-val {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 700;
            color: #e8b84b;
            text-align: right;
        }

        .address-box {
            background-color: #2e1508;
            padding: 24px;
            border-radius: 4px;
            margin-top: 40px;
        }

        .address-title {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            letter-spacing: 2px;
            color: #c9973a;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .address-text {
            font-family: 'Lora', serif;
            font-size: 13px;
            color: #c49a6c;
            line-height: 1.6;
            font-style: italic;
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
                    <h2 class="greeting">
                        @if($isAdmin)
                        New Order Received
                        @else
                        Order Confirmed
                        @endif
                    </h2>
                    <p style="color: #c49a6c; font-style: italic; margin-bottom: 30px;">
                        @if($isAdmin)
                        Hello Admin, a new order has been placed on the website. Here are the details:
                        @else
                        Dear {{ $order->customer->name }}, thank you for choosing Rana Marble. We are pleased to confirm
                        that your order has been received and is being processed.
                        @endif
                    </p>

                    <div class="order-meta">
                        <div class="meta-item">Order Number</div>
                        <div class="meta-val">#{{ $order->order_number }}</div>
                        <div class="meta-item">Order Date</div>
                        <div class="meta-val">{{ $order->created_at->format('d M, Y') }}</div>
                    </div>

                    <table class="item-table" role="presentation" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Details</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="product-name">{{ $item->product_name }}</div>
                                    <div class="product-attr">
                                        {{ $item->size ? 'Size: '.$item->size : '' }}
                                        {{ $item->color ? ' · Color: '.$item->color : '' }}
                                    </div>
                                </td>
                                <td style="text-align: center; color: #e8c96a;">{{ $item->quantity }}</td>
                                <td class="item-price">₹{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="summary-row">
                                <td colspan="2" class="summary-label">Subtotal</td>
                                <td class="summary-val">₹{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr class="summary-row">
                                <td colspan="2" class="summary-label">Shipping</td>
                                <td class="summary-val">₹{{ number_format($order->shipping_fees, 2) }}</td>
                            </tr>
                            <tr class="total-row">
                                <td colspan="2" class="total-label">Grand Total</td>
                                <td class="total-val">₹{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="address-box">
                        <div class="address-title">Shipping Address</div>
                        <div class="address-text">
                            {{ $order->shipping_address }}<br>
                            @if($order->shipping_landmark) {{ $order->shipping_landmark }}, @endif
                            {{ $order->shipping_city }}, {{ $order->shipping_state }} - {{ $order->pincode }}<br>
                            Phone: {{ $order->phone }}
                        </div>
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
