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
        body {
            font-family: 'nunito', sans-serif;
            color:#002060;
        }

        em {
            font-style: normal;
            color: rgb(38, 38, 124);
            font-weight: bold;
        }

        h1 {
            font-size: 16px;
        }
        p{
            margin:0px;
        }

    </style>
    <h1 style="font-size:16px; margin:0px; color:#002060;" >Bonjour {{ $superadmin[0]->name }},</h1>

    <p style="margin:0px; color:#002060;"> L'utilisateur <em>{{ $actualUser }}</em> a demandé la validation de sa note de frais de
        <em>{{ $monthNDF }}.</em></p>
    <p style="margin:0px; color:#002060;"> Pour valider cette note de frais, merci de bien vouloir vous connecter à <a
            href="https://www.carpediem.pro/LesFrais/public">Carpe Diem</a> afin de la valider dans votre espace
        Administration.</p>
</body>
</html>
