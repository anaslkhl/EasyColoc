<body style="margin:0; padding:0; font-family: 'Helvetica', Arial, sans-serif; background-color: #f4f4f7; color: #333333;">
    <table role="presentation" width="100%" style="border-collapse: collapse; background-color: #f4f4f7; padding: 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" style="border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #DD2D4A; padding: 20px; text-align: center; color: #ffffff;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: bold;">Colocation Invitation</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; margin-bottom: 16px;">
                                Hello,
                            </p>
                            <p style="font-size: 16px; margin-bottom: 16px;">
                                <strong>{{ $inviter->name ?? 'Someone' }}</strong> invited you to join a colocation.
                            </p>
                            <p style="font-size: 16px; margin-bottom: 24px;">
                                <strong>Colocation:</strong> {{ $colocation->name ?? 'N/A' }}
                            </p>

                            <!-- Buttons -->
                            <table role="presentation" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center" style="padding: 5px;">
                                        <a href="{{ route('invite.accept', $invitation->token) }}"
                                            style="background-color: #28a745; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                            Accept
                                        </a>
                                    </td>
                                    <td align="center" style="padding: 5px;">
                                        <a href="{{ route('invite.decline', $invitation->token) }}"
                                            style="background-color: #dc3545; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                            Decline
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #666666; margin-top: 30px;">
                                This invitation is valid until <strong>{{ $invitation->expires_at->format('d M Y H:i') }}</strong>.
                                Please respond before it expires.
                            </p>

                            <p style="font-size: 16px; margin-top: 30px;">
                                Thanks,<br>
                                <strong>{{ config('app.name') }}</strong> 🚀
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f4f4f7; text-align: center; padding: 20px; font-size: 12px; color: #999999;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>