<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Conferma Ordine - Yari No Hanzo</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f1ec; font-family: Georgia, 'Times New Roman', serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f1ec; padding:30px 0;">
<tr>
<td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #e0dcd3; max-width:600px; width:100%;">

    {{-- HEADER --}}
    <tr>
        <td style="background-color:#0d0d0d; padding:32px 40px; text-align:center; border-bottom:3px solid #b8860b;">
            <div style="color:#f4f1ec; font-size:24px; letter-spacing:4px; font-weight:bold; text-transform:uppercase; font-family: Georgia, serif;">
                Yari No Hanzo
            </div>
            <div style="color:#b8860b; font-size:11px; letter-spacing:2px; text-transform:uppercase; margin-top:6px;">
                Katana &amp; Arti Marziali
            </div>
        </td>
    </tr>

    {{-- INTRO --}}
    <tr>
        <td style="padding:40px 40px 20px 40px;">
            <h1 style="margin:0 0 12px 0; font-size:20px; color:#1a1a1a; font-weight:normal;">
                Grazie per il tuo ordine, {{ $nome }}.
            </h1>
            <p style="margin:0; font-size:14px; line-height:1.6; color:#555555;">
                Il tuo pagamento &egrave; stato confermato con successo. Di seguito trovi il riepilogo completo del tuo ordine.
            </p>
        </td>
    </tr>

    {{-- SPEDIZIONE --}}
    <tr>
        <td style="padding:0 40px 20px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#faf9f6; border-left:3px solid #b8860b; padding:16px 20px;">
                <tr>
                    <td style="padding:16px 20px;">
                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#b8860b; font-weight:bold; margin-bottom:6px;">
                            Indirizzo di spedizione
                        </div>
                        <div style="font-size:14px; color:#333333; line-height:1.5;">
                            {{ $indirizzo }}
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    @if($customKatana)
    {{-- KATANA PERSONALIZZATA --}}
    <tr>
        <td style="padding:10px 40px 20px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#8b0000; font-weight:bold; border-bottom:1px solid #e0dcd3; padding-bottom:8px; margin-bottom:12px;">
                Katana Personalizzata
            </div>
            <p style="margin:0 0 10px 0; font-size:15px; color:#1a1a1a; font-weight:bold;">
                {{ $customKatana['info']['katana_name'] }}
            </p>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                @foreach($customKatana['dettagli_visibili'] as $componente => $scelta)
                <tr>
                    <td style="padding:6px 0; font-size:13px; color:#777777; border-bottom:1px solid #f0eee9; width:45%;">
                        {{ $componente }}
                    </td>
                    <td style="padding:6px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9; text-align:right;">
                        {{ $scelta }}
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
    @endif

    @if(!empty($cart))
    {{-- PRODOTTI --}}
    <tr>
        <td style="padding:10px 40px 20px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#8b0000; font-weight:bold; border-bottom:1px solid #e0dcd3; padding-bottom:8px; margin-bottom:12px;">
                Prodotti Ordinati
            </div>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                @foreach($cart as $item)
                <tr>
                    <td style="padding:8px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9;">
                        {{ $item['nome'] }}
                        <span style="color:#999999;">&times; {{ $item['quantity'] }}</span>
                    </td>
                    <td style="padding:8px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9; text-align:right; white-space:nowrap;">
                        {{ number_format($item['prezzo'] * $item['quantity'], 2, ',', '.') }}&euro;
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
    @endif

    {{-- TOTALE --}}
    <tr>
        <td style="padding:10px 40px 30px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#0d0d0d;">
                <tr>
                    <td style="padding:18px 24px; color:#f4f1ec; font-size:13px; letter-spacing:1px; text-transform:uppercase;">
                        Totale pagato
                    </td>
                    <td style="padding:18px 24px; color:#b8860b; font-size:18px; font-weight:bold; text-align:right;">
                        {{ number_format($totalPrice, 2, ',', '.') }}&euro;
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
        <td style="padding:24px 40px; background-color:#faf9f6; border-top:1px solid #e0dcd3; text-align:center;">
            <p style="margin:0 0 6px 0; font-size:12px; color:#999999;">
                Grazie per aver scelto Yari No Hanzo.
            </p>
            <p style="margin:0; font-size:12px; color:#999999;">
                Per qualsiasi domanda, rispondi direttamente a questa email.
            </p>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>