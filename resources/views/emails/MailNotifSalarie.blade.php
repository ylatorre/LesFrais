<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            font-family:'nunito',sans-serif;
        }
        em{
            font-style:normal;
            color:rgb(38, 38, 124);
            font-weight:bold;
        }
        h1{
            font-size:16px;
        }
    </style>
        <h1>Bonjour {{$salarie[0]->name}} ,</h1><br>
        <p>Votre note de frais pour le mois de <em>{{$moisNDF}}</em> a été validée par <em>{{$moderator[0]->name}}</em> .</p> <br>
        <p>Pour la consulter en ligne, rendez-vous sur le site de <a href="https://www.carpediem.pro/LesFrais/public">Carpe Diem</a> . </p><br><br>

        <footer>
            Très cordialement,
        </footer>

</body>
</html>
