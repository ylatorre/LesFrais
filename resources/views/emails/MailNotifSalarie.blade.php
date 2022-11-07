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
            margin-bottom:10px;
        }
        footer{
            margin-top:10px;
        }
    </style>
        <h1>Bonjour {{$salarie[0]->name}} ,</h1>

        <p>Votre note de frais pour le mois de <em>{{$moisNDF}}</em> a été validée par <em>{{$moderator[0]->name}}</em> .</p>
        <p>Pour la consulter en ligne, rendez-vous sur le site de <a href="https://www.carpediem.pro/LesFrais/public/Mes-notes-de-frais">Carpe Diem</a> . </p><br>

        <footer style>
            Très cordialement,
        </footer>

</body>
</html>
