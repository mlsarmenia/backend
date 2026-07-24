<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
</head>
<body style="margin:0;padding:0;background:#f3f5f7;color:#20262d;font-family:Arial,'Noto Sans Armenian',sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f3f5f7;padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background:#ffffff;border:1px solid #dfe3e8;">
                <tr>
                    <td style="padding:22px 28px;background:#20262d;color:#ffffff;font-size:20px;font-weight:700;">
                        {{ config('app.name') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding:32px 28px;">
                        <h1 style="margin:0 0 18px;font-size:24px;line-height:1.35;color:#20262d;">{{ $title }}</h1>
                        <div style="font-size:16px;line-height:1.65;color:#3d4650;">{!! nl2br(e($body)) !!}</div>

                        @if ($actionText && $actionUrl)
                            <div style="margin-top:28px;">
                                <a href="{{ $actionUrl }}" style="display:inline-block;padding:12px 20px;background:#19724c;color:#ffffff;text-decoration:none;font-size:16px;font-weight:700;">
                                    {{ $actionText }}
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:18px 28px;border-top:1px solid #e8ebee;color:#69727d;font-size:13px;line-height:1.5;">
                        Այս նամակն ուղարկվել է {{ config('app.name') }} համակարգից։
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
