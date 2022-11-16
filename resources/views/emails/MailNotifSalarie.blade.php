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
        margin-bottom:20px;
    }
    footer{
        margin-top:20px;
    }
    .table-footer {
        width: 40%;
        border: 2px solid #870b26;
    }

    .table-footer td {
        text-align: center;
        height: 76px;
        font-family: 'nunito', sans-serif;
        font-weight: bold;
        color: #870b26;
    }

    .table-footer th {
        width: 230px;
        color: #870b26;
    }
    a img{
        width:24px;
        height:24px;
    }
</style>
<body>

        <h1 style="font-size:16px;">Bonjour {{$salarie[0]->name}} ,</h1>

        <p>Votre note de frais pour le mois de <em>{{$moisNDF}}</em> a été validée .</p>
        <p>Pour la consulter en ligne, rendez-vous sur le site de <a href="https://www.carpediem.pro/LesFrais/public/Mes-notes-de-frais">Carpe Diem</a> . </p><br>




</body>
</html>
