<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; color: #333;">
    <h2>Grazie per il tuo ordine, {{ $nome }}!</h2>
    <p>Il tuo pagamento è stato confermato con successo.</p>

    <h3>Indirizzo di spedizione</h3>
    <p>{{ $indirizzo }}</p>

    @if($customKatana)
        <h3>Katana Personalizzata</h3>
        <p><strong>{{ $customKatana['info']['katana_name'] }}</strong></p>
        <ul>
            @foreach($customKatana['dettagli_visibili'] as $componente => $scelta)
                <li>{{ $componente }}: {{ $scelta }}</li>
            @endforeach
        </ul>
    @endif

    @if(!empty($cart))
        <h3>Prodotti Ordinati</h3>
        <ul>
            @foreach($cart as $item)
                <li>{{ $item['nome'] }} — Quantità: {{ $item['quantity'] }} — {{ number_format($item['prezzo'] * $item['quantity'], 2, ',', '.') }}€</li>
            @endforeach
        </ul>
    @endif

    <h3>Totale pagato: {{ number_format($totalPrice, 2, ',', '.') }}€</h3>

    <p style="margin-top: 30px; color: #888; font-size: 0.9em;">
        Grazie per aver scelto YariNoHanzo. Per qualsiasi domanda, rispondi a questa email.
    </p>
</body>
</html>