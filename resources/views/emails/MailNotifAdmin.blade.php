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


<br>
    <h1>Bonjour {{$superadmin[0]->name}},</h1><br>

    <p>    L'utilisateur <em>{{$actualUser}}</em> à demandé la validation de sa note de frais de <em>{{$monthNDF}}.</em></p><br>

    <p>    Pour valider cette note de frais, merci de bien vouloir vous connecter à  <a href="https://www.carpediem.pro/LesFrais/public">Carpe Diem</a> afin de la valider dans votre espace Administration.</p><br>

    <footer>
    <p>Très cordialement.</p><br>
    </footer>




</body>
</html>
