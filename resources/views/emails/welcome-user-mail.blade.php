<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Welcome to Rana Marble</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet" />
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; display: block; }
        body { margin: 0; padding: 0; background-color: #2a1206; font-family: 'Lora', Georgia, serif; }

        .email-wrapper { background-color: #2a1206; padding: 36px 16px; }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #3d1f0a;
            border: 1px solid #6b3a18;
            overflow: hidden;
        }

        /* TOP BORDER */
        .top-border {
            background: linear-gradient(90deg, #6b3a18, #c9973a, #e8b84b, #c9973a, #6b3a18);
            height: 3px;
        }

        /* HEADER */
        .header {
            background-color: #2e1508;
            padding: 40px 48px 32px;
            text-align: center;
            border-bottom: 1px solid #5a2e0e;
        }
        .label-row { text-align: center; margin-bottom: 14px; }
        .label-quote { color: #c9973a; font-size: 13px; margin-right: 8px; }
        .label-text {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            font-weight: 400;
            letter-spacing: 5px;
            color: #c9973a;
            text-transform: uppercase;
        }
        .brand-name {
            font-family: 'Cinzel', serif;
            font-size: 32px;
            font-weight: 700;
            color: #e8c96a;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0 0 8px;
            line-height: 1.15;
        }
        .brand-tagline {
            font-family: 'Lora', serif;
            font-size: 13px;
            font-style: italic;
            color: #c49a6c;
            margin: 0;
        }

        /* HERO */
        .hero {
            background: linear-gradient(160deg, #4a2510 0%, #3d1f0a 50%, #2e1508 100%);
            padding: 44px 48px 40px;
            text-align: center;
            border-bottom: 1px solid #5a2e0e;
        }
        .hero-heading {
            font-family: 'Cinzel', serif;
            font-size: 26px;
            font-weight: 700;
            color: #e8c96a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 14px;
            line-height: 1.35;
        }
        .hero-divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #c9973a, transparent);
            margin: 0 auto 18px;
        }
        .hero-sub {
            font-family: 'Lora', serif;
            font-size: 14px;
            font-style: italic;
            color: #c49a6c;
            margin: 0;
            line-height: 1.7;
        }

        /* BODY */
        .body-section { padding: 40px 48px; background-color: #3d1f0a; }
        .greeting {
            font-family: 'Cinzel', serif;
            font-size: 16px;
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
            margin: 0 0 16px;
        }
        .body-text strong { font-style: normal; font-weight: 500; color: #e8c96a; }

        /* QUOTE CARD */
        .quote-card {
            background-color: #2e1508;
            border: 1px solid #5a2e0e;
            border-radius: 6px;
            padding: 28px 30px;
            margin: 28px 0;
        }
        .stars { font-size: 14px; color: #e8c96a; letter-spacing: 4px; margin: 0 0 14px; }
        .quote-text {
            font-family: 'Lora', serif;
            font-size: 14px;
            font-style: italic;
            color: #c9a87c;
            line-height: 1.85;
            margin: 0 0 20px;
        }
        .author-name-el {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            font-weight: 600;
            color: #e8c96a;
            margin: 0 0 3px;
            letter-spacing: 1px;
        }
        .author-loc {
            font-family: 'Lora', serif;
            font-size: 11px;
            font-style: italic;
            color: #8a5c38;
            margin: 0;
        }

        /* FEATURES */
        .features-section {
            background-color: #2e1508;
            padding: 36px 48px;
            border-top: 1px solid #5a2e0e;
            border-bottom: 1px solid #5a2e0e;
        }
        .features-label {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            font-weight: 400;
            letter-spacing: 5px;
            color: #c9973a;
            text-transform: uppercase;
            text-align: center;
            margin: 0 0 28px;
        }
        .feature-icon-wrap {
            width: 44px;
            height: 44px;
            border: 1px solid #c9973a;
            border-radius: 50%;
            margin: 0 auto 12px;
            text-align: center;
            line-height: 44px;
            color: #c9973a;
            font-size: 16px;
        }
        .feature-title {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            font-weight: 600;
            color: #e8c96a;
            margin: 0 0 6px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-align: center;
        }
        .feature-desc {
            font-family: 'Lora', serif;
            font-size: 11px;
            font-style: italic;
            color: #8a5c38;
            margin: 0;
            line-height: 1.6;
            text-align: center;
        }

        /* CTA */
        .cta-section {
            padding: 40px 48px;
            text-align: center;
            background: linear-gradient(160deg, #4a2510 0%, #3d1f0a 100%);
        }
        .cta-heading {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 700;
            color: #e8c96a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 8px;
            line-height: 1.3;
        }
        .cta-sub {
            font-family: 'Lora', serif;
            font-size: 13px;
            font-style: italic;
            color: #c49a6c;
            margin: 0 0 24px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #c9973a, #e8b84b, #c9973a);
            color: #2a1206 !important;
            text-decoration: none;
            font-family: 'Cinzel', serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 15px 40px;
            border-radius: 2px;
        }

        /* FOOTER */
        .footer {
            background-color: #2a1206;
            padding: 32px 48px;
            text-align: center;
            border-top: 1px solid #5a2e0e;
        }
        .footer-divider {
            width: 50px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #c9973a, transparent);
            margin: 0 auto 20px;
        }
        .footer-brand {
            font-family: 'Cinzel', serif;
            font-size: 13px;
            letter-spacing: 4px;
            color: #6b4020;
            text-transform: uppercase;
            margin: 0 0 14px;
        }
        .footer-link {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 3px;
            color: #6b4020 !important;
            text-decoration: none;
            text-transform: uppercase;
            margin: 0 10px;
        }
        .footer-address {
            font-family: 'Lora', serif;
            font-size: 11px;
            font-style: italic;
            color: #5a3218;
            line-height: 1.8;
            margin: 14px 0;
        }
        .footer-unsub {
            font-family: 'Lora', serif;
            font-size: 10px;
            font-style: italic;
            color: #4a2810;
            margin: 0;
        }
        .footer-unsub a { color: #6b4020 !important; }

        .bottom-border {
            background: linear-gradient(90deg, #6b3a18, #c9973a, #e8b84b, #c9973a, #6b3a18);
            height: 3px;
        }

        @media only screen and (max-width: 480px) {
            .header, .hero, .body-section, .features-section, .cta-section, .footer {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
            .brand-name { font-size: 24px !important; }
            .hero-heading { font-size: 20px !important; }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
<table class="email-container" role="presentation" cellpadding="0" cellspacing="0" width="100%">

    {{-- TOP GOLD BORDER --}}
    <tr><td class="top-border"></td></tr>

    {{-- HEADER --}}
    <tr>
        <td class="header">
            <div class="label-row">
                <span class="label-quote">❝</span>
                <span class="label-text">Welcome Letter</span>
            </div>
            <h1 class="brand-name">Rana Marble</h1>
            <p class="brand-tagline">Thousands of homes across India now carry a piece of our devotion.</p>
        </td>
    </tr>

    {{-- HERO --}}
    <tr>
        <td class="hero">
            <h2 class="hero-heading">Welcome to Our<br>Sacred Family</h2>
            <div class="hero-divider"></div>
            <p class="hero-sub">We are honoured to have you with us.<br>Your journey into timeless craftsmanship begins today.</p>
        </td>
    </tr>

    {{-- BODY --}}
    <tr>
        <td class="body-section">
            <p class="greeting">Dear Customer Name,</p>
            <p class="body-text">
                We warmly welcome you to <strong>Rana Marble</strong> — a home for those who seek the finest in natural stone, sacred craftsmanship, and timeless beauty. Your account has been created and you are now part of a family that takes immense pride in every piece we deliver.
            </p>
            <p class="body-text">
                From exquisitely carved mandirs to premium flooring and decorative stone, each of our creations carries the soul of artisans who have honed their craft across generations in Rajasthan.
            </p>
        </td>
    </tr>

    {{-- FEATURES --}}
    <tr>
        <td class="features-section">
            <p class="features-label">Why Rana Marble</p>
            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="33%" style="text-align:center; padding:0 10px; vertical-align:top;">
                        <div class="feature-icon-wrap">◆</div>
                        <p class="feature-title">Premium Quality</p>
                        <p class="feature-desc">Sourced from the finest quarries, verified for grade &amp; finish</p>
                    </td>
                    <td width="33%" style="text-align:center; padding:0 10px; vertical-align:top;">
                        <div class="feature-icon-wrap">◈</div>
                        <p class="feature-title">Expert Carving</p>
                        <p class="feature-desc">Generational artisans with decades of sacred stone mastery</p>
                    </td>
                    <td width="33%" style="text-align:center; padding:0 10px; vertical-align:top;">
                        <div class="feature-icon-wrap">◇</div>
                        <p class="feature-title">Safe Delivery</p>
                        <p class="feature-desc">Carefully packed &amp; delivered to your doorstep across India</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- CTA --}}
    <tr>
        <td class="cta-section">
            <h3 class="cta-heading">Ready to Bring the<br>Divine Home?</h3>
            <p class="cta-sub">Explore our sacred collections — crafted to perfection.</p>
            <a href="https://ranamarble.info/" class="cta-button">Explore Collections</a>
        </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
        <td class="footer">
            <div class="footer-divider"></div>
            <p class="footer-brand">Rana Marble</p>
            <div style="margin:0 0 16px;">
                <a href="#" class="footer-link">Collections</a>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Contact</a>
            </div>
            <p class="footer-address">
                Rana Marble &amp; Granites Pvt. Ltd.<br>
                Industrial Area, Kishangarh, Rajasthan — 305 801<br>
                +91 98765 43210 &nbsp;·&nbsp; info@ranamarble.com
            </p>
            <p class="footer-unsub">
                You received this because you created an account with us.<br>
                <a href="{{ $unsubscribeUrl ?? '#' }}">Unsubscribe</a> &nbsp;·&nbsp;
                <a href="{{ $privacyUrl ?? '#' }}">Privacy Policy</a>
            </p>
        </td>
    </tr>

    {{-- BOTTOM GOLD BORDER --}}
    <tr><td class="bottom-border"></td></tr>

</table>
</div>
</body>
</html>