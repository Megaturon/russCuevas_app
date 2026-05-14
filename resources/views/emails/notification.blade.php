<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title }}</title>
    <style type="text/css">
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #000000; }

        @media screen and (max-width: 600px) {
            .container { width: 100% !important; }
            .content-padding { padding-left: 20px !important; padding-right: 20px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #000000; color: #ffffff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #000000;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="500" class="container" style="max-width: 500px;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding-bottom: 40px;">
                            <h1 style="color: #ffffff; letter-spacing: 5px; margin: 0; text-transform: uppercase; font-weight: 700; font-size: 24px; line-height: 1.4;">
                                {!! str_replace(' ', '<br>', e($title)) !!}
                            </h1>
                        </td>
                    </tr>
                    
                    <!-- Greeting -->
                    <tr>
                        <td style="padding: 0 45px 20px 45px;" class="content-padding">
                            <p style="font-size: 16px; font-weight: 500; color: #ffffff; margin: 0;">Dear {{ $name }},</p>
                        </td>
                    </tr>

                    <!-- Intro -->
                    <tr>
                        <td style="padding: 0 45px 30px 45px;" class="content-padding">
                            <p style="font-size: 16px; color: #ffffff; line-height: 1.5; margin: 0;">
                                {!! $intro !!}
                            </p>
                        </td>
                    </tr>

                    <!-- Details Box -->
                    @if(isset($details) && count($details) > 0)
                    <tr>
                        <td style="padding: 0 45px;" class="content-padding">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #1a1a1a; border: 1px solid #333333; border-radius: 4px;">
                                <tr>
                                    <td style="padding: 30px 30px;">
                                        @foreach($details as $key => $value)
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="{{ !$loop->last ? 'margin-bottom: 18px;' : '' }}">
                                            <tr>
                                                <td width="40%" style="font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 2px; color: #8e9194; vertical-align: top; padding-top: 2px;">
                                                    {{ $key }}:
                                                </td>
                                                <td style="font-size: 14px; font-weight: 500; color: #ffffff; vertical-align: top;">
                                                    {{ $value }}
                                                </td>
                                            </tr>
                                        </table>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    <!-- Outro -->
                    <tr>
                        <td style="padding: 40px 45px 40px 45px;" class="content-padding">
                            <p style="font-size: 16px; color: #ffffff; line-height: 1.5; margin: 0;">
                                {!! $outro !!}
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Action Buttons -->
                    @if(isset($actions) && count($actions) > 0)
                    <tr>
                        <td align="center" style="padding-bottom: 60px; padding-left: 45px; padding-right: 45px;" class="content-padding">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                @foreach($actions as $action)
                                                <td align="center" bgcolor="{{ $action['color'] ?? '#ffffff' }}" style="border-radius: 2px; {{ !$loop->last ? 'margin-right: 15px;' : '' }}">
                                                    <a href="{{ $action['url'] }}" target="_blank" style="display: inline-block; padding: 15px 30px; color: {{ isset($action['color']) && $action['color'] != '#ffffff' ? '#ffffff' : '#000000' }}; text-decoration: none; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                                                        {{ $action['label'] }}
                                                    </a>
                                                </td>
                                                @if(!$loop->last)
                                                <td width="15">&nbsp;</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td align="center" style="padding-bottom: 60px;">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" bgcolor="#ffffff" style="border-radius: 2px;">
                                        <a href="{{ url('/') }}" target="_blank" style="display: inline-block; padding: 18px 45px; color: #000000; text-decoration: none; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px;">VISIT OUR WEBSITE</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif
                    
                    <!-- Footer Divider -->
                    <tr>
                        <td style="padding: 0 45px;">
                            <hr style="border: 0; border-top: 1px solid #333333; margin: 0;">
                        </td>
                    </tr>

                    <!-- Footer Content -->
                    <tr>
                        <td align="center" style="padding-top: 30px; color: #737373; font-size: 11px; line-height: 1.8; letter-spacing: 0.5px;">
                            &copy; {{ date('Y') }} Russ Cuevas Atelier. All rights reserved.<br />
                            Handcrafted Elegance & Bespoke Tailoring.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>