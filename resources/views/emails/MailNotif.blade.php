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
            color:#002060;
        }
        em{
            font-style: normal;
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



<br>
    <h1 style="font-size:16px;">Bonjour {{$modo->name}},</h1>

    <p>     L'utilisateur <em>{{$actualUser}}</em> a demandé la validation de sa note de frais de <strong>{{$monthNDF}}.</strong></p>
    <p>     Pour valider cette note de frais, merci de bien vouloir vous connecter à  <a href="https://www.carpediem.pro/LesFrais/public">Carpe Diem</a> afin de la valider dans votre espace Administration.</p>








</body>
</html>
