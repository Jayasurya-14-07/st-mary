<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Biopico Poster Download</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
        }
        .wrapper {
            width: 100%;
            padding: 60px 0;
            background-color: #f4f7f6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(123, 31, 162, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #7b1fa2 0%, #4a148c 100%);
            padding: 60px 40px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        .content p {
            margin-bottom: 24px;
            font-size: 16px;
            color: #4b5563;
        }
        .download-btn {
            display: inline-block;
            background-color: #39ff14;
            color: #000000;
            padding: 18px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 900;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(57, 255, 20, 0.3);
            transition: all 0.3s ease;
        }
        .footer {
            padding: 30px;
            text-align: center;
            background-color: #f9fafb;
            border-top: 1px solid #f3f4f6;
        }
        .footer p {
            font-size: 12px;
            color: #9ca3af;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Poster Download</h1>
            </div>
            <div class="content">
                <p>Thank you for your interest in Biopico Systems. Your high-resolution poster is ready for download.</p>
                <a href="{{ $downloadUrl }}" class="download-btn">Download PDF Poster</a>
                <p style="margin-top: 30px; font-size: 14px; color: #9ca3af;">If the button above doesn't work, copy and paste this link into your browser:</p>
                <p style="font-size: 13px; color: #7b1fa2; word-break: break-all;">{{ $downloadUrl }}</p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Biopico Systems. All rights reserved.</p>
                <p>Advancing Human-Relevant Multiorgan Models</p>
            </div>
        </div>
    </div>
</body>
</html>
