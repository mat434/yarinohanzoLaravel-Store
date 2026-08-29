<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Richiesta di Reso Confermata</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f1ec; font-family: Georgia, 'Times New Roman', serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f1ec; padding:30px 0;">
<tr>
<td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #e0dcd3; max-width:600px; width:100%;">

    {{-- HEADER --}}
    <tr>
        <td style="background-color:#0d0d0d; padding:32px 40px; text-align:center; border-bottom:3px solid #b8860b;">
            <div style="color:#f4f1ec; font-size:24px; letter-spacing:4px; font-weight:bold; text-transform:uppercase;">
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
                Richiesta di reso ricevuta
            </h1>
            <p style="margin:0; font-size:14px; line-height:1.6; color:#555555;">
                Abbiamo ricevuto la tua richiesta di reso per l'ordine <strong>#{{ $returnRequest->order->id }}</strong>.
                Di seguito trovi il riepilogo e le istruzioni per completarla.
            </p>
        </td>
    </tr>

    {{-- METODO DI RESO --}}
    <tr>
        <td style="padding:0 40px 20px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#faf9f6; border-left:3px solid #b8860b;">
                <tr>
                    <td style="padding:16px 20px;">
                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#b8860b; font-weight:bold; margin-bottom:6px;">
                            Metodo di reso scelto
                        </div>
                        <div style="font-size:14px; color:#333333;">
                            @if($returnRequest->return_method === 'domicilio')
                                Ritiro a domicilio
                            @else
                                Consegna al punto postale più vicino
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- ARTICOLI IN RESO --}}
    <tr>
        <td style="padding:10px 40px 20px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#8b0000; font-weight:bold; border-bottom:1px solid #e0dcd3; padding-bottom:8px; margin-bottom:12px;">
                Articoli da restituire
            </div>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                @foreach($returnRequest->items as $returnItem)
                <tr>
                    <td style="padding:8px 0; font-size:13px; color:#1a1a1a; border-bottom:1px solid #f0eee9;">
                        {{ $returnItem->orderItem->nome }}
                    </td>
                    <td style="padding:8px 0; font-size:13px; color:#999999; border-bottom:1px solid #f0eee9; text-align:right;">
                        Quantit&agrave;: {{ $returnItem->quantity }}
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>

    @if($returnRequest->motivo)
    {{-- MOTIVO --}}
    <tr>
        <td style="padding:0 40px 20px 40px;">
            <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#8b0000; font-weight:bold; margin-bottom:8px;">
                Motivo indicato
            </div>
            <p style="margin:0; font-size:13px; color:#555555; line-height:1.5;">
                {{ $returnRequest->motivo }}
            </p>
        </td>
    </tr>
    @endif

    {{-- ISTRUZIONI + ETICHETTA --}}
    <tr>
        <td style="padding:10px 40px 30px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#0d0d0d;">
                <tr>
                    <td style="padding:20px 24px;">
                        <div style="color:#b8860b; font-size:11px; letter-spacing:1px; text-transform:uppercase; font-weight:bold; margin-bottom:10px;">
                            Come procedere
                        </div>
                        <p style="margin:0 0 16px 0; color:#f4f1ec; font-size:13px; line-height:1.6;">
                            Stampa l'etichetta di reso e applicala sul pacco. Ti contatteremo a breve per confermare i dettagli del ritiro o della consegna.
                        </p>
                        <a href="{{ $labelUrl ?? '#' }}" style="display:inline-block; background-color:#b8860b; color:#0d0d0d; text-decoration:none; padding:10px 22px; font-size:13px; font-weight:bold; letter-spacing:1px; text-transform:uppercase;">
                            Scarica Etichetta
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
        <td style="padding:24px 40px; background-color:#faf9f6; border-top:1px solid #e0dcd3; text-align:center;">
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