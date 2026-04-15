<!DOCTYPE html>
<html>
<head>
    <title>New Lead Captured</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f8fafc; padding: 40px 20px; margin: 0;">
    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; padding: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="display: inline-block; background: linear-gradient(135deg, #f97316, #ea580c); width: 48px; height: 48px; border-radius: 12px; line-height: 48px; font-size: 24px; color: white;">🔑</div>
        </div>
        <h1 style="font-size: 22px; font-weight: 700; color: #0f172a; text-align: center; margin: 0 0 8px 0;">New Lead Captured</h1>
        <p style="font-size: 14px; color: #64748b; text-align: center; margin: 0 0 24px 0;">A new user has registered through the lead capture form.</p>

        <div style="background: #f1f5f9; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Name</td>
                    <td style="padding: 8px 0; font-size: 15px; color: #1e293b; font-weight: 500; text-align: right;">{{ $leadName }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; border-top: 1px solid #e2e8f0;">Email</td>
                    <td style="padding: 8px 0; font-size: 15px; color: #1e293b; font-weight: 500; text-align: right; border-top: 1px solid #e2e8f0;">
                        <a href="mailto:{{ $leadEmail }}" style="color: #f97316; text-decoration: none;">{{ $leadEmail }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; border-top: 1px solid #e2e8f0;">Date</td>
                    <td style="padding: 8px 0; font-size: 15px; color: #1e293b; font-weight: 500; text-align: right; border-top: 1px solid #e2e8f0;">{{ now()->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>

        <p style="font-size: 12px; color: #94a3b8; text-align: center; margin: 0;">This is an automated notification from Jarreva Creative.</p>
    </div>
</body>
</html>
