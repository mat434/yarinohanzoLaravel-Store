<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Nuova Richiesta Katana Personalizzata</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f1ec; font-family: Georgia, 'Times New Roman', serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f1ec; padding:30px 0;">
<tr>
<td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #e0dcd3; max-width:600px; width:100%;">

    {{-- HEADER --}}
    <tr>
        <td style="background-color:#0d0d0d; padding:28px 40px; border-bottom:3px solid #8b0000;">
            <div style="color:#f4f1ec; font-size:12px; letter-spacing:2px; text-transform:uppercase;">
                Yari No Hanzo &mdash; Pannello Ordini
            </div>
            <div style="color:#ffffff; font-size:20px; font-weight:bold; margin-top:6px;">
                Nuova Richiesta: Katana Personalizzata
            </div>
        </td>
    </tr>

    {{-- CLIENTE --}}
    <tr>
        <td style="padding:24px 40px 10px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#faf9f6; border-left:3px solid #8b0000;">
                <tr>
                    <td style="padding:14px 20px;">
                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#8b0000; font-weight:bold; margin-bottom:4px;">
                            Contatto cliente
                        </div>
                        <div style="font-size:14px; color:#1a1a1a;">
                            {{ $katanaMail['email'] }}
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- NOME KATANA --}}
    <tr>
        <td style="padding:20px 40px 0 40px;">
            <p style="margin:0; font-size:16px; color:#1a1a1a; font-weight:bold;">
                {{ $katanaMail['name'] }}
            </p>
        </td>
    </tr>

    {{-- SPECIFICHE TECNICHE --}}
    <tr>
        <td style="padding:16px 40px 6px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#b8860b; font-weight:bold; border-bottom:1px solid #e0dcd3; padding-bottom:8px;">
                Specifiche Tecniche
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding:0 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                @php
                    $specifiche = [
                        'Lunghezza Nagasa' => $katanaMail['nagasa_lenght'] . ' cm',
                        'Lunghezza Tsuka' => $katanaMail['tsuka_lenght'] . ' cm',
                        'Curvatura Sori' => $katanaMail['sori'] . ' mm',
                        'Larghezza base (Motohaba)' => $katanaMail['motohaba'] . ' mm',
                        'Acciaio (Kitae)' => $katanaMail['kitae'],
                        'Bohi' => $katanaMail['bohi'],
                    ];
                @endphp
                @foreach($specifiche as $label => $valore)
                <tr>
                    <td style="padding:7px 0; font-size:13px; color:#777777; border-bottom:1px solid #f0eee9; width:50%;">
                        {{ $label }}
                    </td>
                    <td style="padding:7px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9; text-align:right;">
                        {{ $valore }}
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>

    {{-- COMPONENTI ESTETICI --}}
    <tr>
        <td style="padding:22px 40px 6px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#b8860b; font-weight:bold; border-bottom:1px solid #e0dcd3; padding-bottom:8px;">
                Componenti &amp; Finiture
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding:0 40px 24px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                @php
                    $componenti = [
                        'Tipo Tsuba' => $katanaMail['tsuba'],
                        'Fuchi e Kashira' => $katanaMail['fuchikashira'],
                        'Menuki' => $katanaMail['menuki'],
                        'Habaki' => $katanaMail['habaki'],
                        'Seppa' => $katanaMail['seppa'],
                        'Samegawa' => $katanaMail['samegawa'],
                        'Stile Tsuka' => $katanaMail['stile_tsuka'],
                        'Colore Tsuka' => $katanaMail['colore_tsuka'],
                        'Tipo Saya' => $katanaMail['tipo_saya'],
                        'Colore Sageo' => $katanaMail['colore_sageo'],
                    ];
                @endphp
                @foreach($componenti as $label => $valore)
                <tr>
                    <td style="padding:7px 0; font-size:13px; color:#777777; border-bottom:1px solid #f0eee9; width:50%;">
                        {{ $label }}
                    </td>
                    <td style="padding:7px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9; text-align:right;">
                        {{ $valore }}
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
        <td style="padding:18px 40px; background-color:#0d0d0d; text-align:center;">
            <p style="margin:0; font-size:11px; color:#999999; letter-spacing:1px;">
                Notifica automatica &mdash; Yari No Hanzo Custom Orders
            </p>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>