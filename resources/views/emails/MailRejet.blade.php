<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Refus de note de frais</title>
</head>

<body>
    <style>
        body{
            font-family: 'arial',sans-serif;
        }
        .textRejet{
            width:80%;
            border: 2px solid rgb(124, 10, 10);
            padding-top: 1rem;
            padding-bottom: 1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            color:red;
        }
        h4{
            font-style: normal;
            font-family:'nunito',sans-serif;
            font-weight: bold;
        }
        p{
            padding-left:1rem;
        }
        .paragrapheRejet{
            /* permet au paragraphe de fit avec son conteneur */
            word-wrap: break-word;
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
    <h4>Bonjour {{$rejetUser[0]->name}},</h4><br><p>votre note de frais pour le mois de {{$moisNDF}} a été rejetée pour la raison suivante : </p>


    <div class="textRejet"><p class="paragrapheRejet">{{$dernierRejet->TextRejet}}<p></div>
    <p>Merci de bien vouloir apporter les modifications nécessaires dans vos déplacements en vous connectant à votre espace <a href="https://www.carpediem.pro/LesFrais/public">Frais - Carpe Diem.</a></p>
    <br><br>

    <div class="footer">
        <p>Très cordialement,</p>
    </div>


</body>
</html>
