<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        font-family:'nunito',sans-serif;
        color:#002060;
    }
    em{
        font-style:normal;
        color:rgb(38, 38, 124);
        font-weight:bold;
    }
    h1{
        font-size:16px;
    }
    p{
        margin:0px;
    }

</style>
<body>
        <h1 style="font-size:16px; margin:0px; color:#002060;">Bonjour {{$salarie[0]->name}} ,</h1>

        <p style="margin:0px; color:#002060;">Votre note de frais pour le mois de <em>{{$moisNDF}}</em> a été validée .</p>
        <p style="margin:0px; color:#002060;">Pour la consulter en ligne, rendez-vous sur le site de <a href="https://www.carpediem.pro/LesFrais/public/Mes-notes-de-frais">Carpe Diem</a> . </p>
</body>
</html>
