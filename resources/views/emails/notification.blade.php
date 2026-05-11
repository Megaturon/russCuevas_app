<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #000000;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #e5e5e5;
        }
        .header {
            padding: 40px 0;
            text-align: center;
            background-color: #000000;
        }
        .header img {
            width: 80px;
            height: auto;
        }
        .content {
            padding: 40px;
            line-height: 1.6;
        }
        .content h1 {
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-align: center;
        }
        .details-box {
            background-color: #f9f9f9;
            padding: 25px;
            border: 1px solid #eeeeee;
            margin: 30px 0;
        }
        .details-row {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .label {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
            color: #666666;
        }
        .value {
            font-size: 14px;
        }
        .footer {
            padding: 30px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }
        .button {
            display: inline-block;
            padding: 15px 35px;
            background-color: #000000;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Replace with absolute URL to your logo if hosted -->
            <h2 style="color: #ffffff; letter-spacing: 4px; margin: 0;">RUSS CUEVAS</h2>
        </div>
        <div class="content">
            <h1>{!! $title !!}</h1>
            <p>Dear {{ $name }},</p>
            <p>{!! $intro !!}</p>
            
            @if(isset($details))
            <div class="details-box">
                @foreach($details as $label => $value)
                <div class="details-row">
                    <span class="label">{{ $label }}:</span>
                    <span class="value">{{ $value }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <p>{!! $outro !!}</p>
            
            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="button">Visit Our Website</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Russ Cuevas Couture Artelier. All rights reserved.<br>
            Quality work tailored to your needs.
        </div>
    </div>
</body>
</html>
