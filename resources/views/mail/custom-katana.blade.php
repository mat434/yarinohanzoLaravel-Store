<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordine Katana Personalizzata</title>
</head>
<body>
    <h1>Nuovo Ordine Katana Personalizzata</h1>
    <p>email: {{ $katanaMail['email'] }}</p>
    <p>nome katana: {{$katanaMail['name']}}</p>
    <p>lunghezza nagasa: {{ $katanaMail['nagasa_lenght'] }} cm</p>
    <p>Lunghezza Tsuka: {{ $katanaMail['tsuka_lenght'] }} cm</p>
    <p>curvatura sori: {{ $katanaMail['sori'] }} mm</p>
    <p>larghezza base: {{ $katanaMail['motohaba'] }} mm</p>
    <p>acciaio kitae: {{ $katanaMail['kitae'] }} </p>
    <p>Bohi: {{ $katanaMail['bohi'] }}</p>
    <p>Tipo tsuba: {{ $katanaMail['tsuba'] }}</p>
    <p>Fuchi e Kashira: {{ $katanaMail['fuchikashira'] }}</p>
    <p>Menuki: {{ $katanaMail['menuki'] }}</p>
    <p>Habaki : {{ $katanaMail['habaki'] }}</p>
    <p>Seppa : {{ $katanaMail['seppa'] }}</p>
    <p>Samegawa : {{ $katanaMail['samegawa'] }}</p>
    <p>Stile Tsuka : {{ $katanaMail['stile_tsuka'] }}</p>
    <p>Colore Tsuka : {{ $katanaMail['colore_tsuka'] }}</p>
    <p>Tipo Saya : {{ $katanaMail['tipo_saya'] }}</p>
    <p>Colore Sageo : {{ $katanaMail['colore_sageo'] }}</p>
</body>
</html>