<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <h1 style="font-size:16px; color:rgb(50, 50, 204); font-family:Arial, Helvetica, sans-serif;">Récapitulatif de l'ensemble des factures de l'utilisateur {{$NDFvalidated[0]->Utilisateur}} pour {{$moisNDF}}</h1>
    <h1 style="font-size:16px; color:rgb(50, 50, 204); font-family:Arial, Helvetica, sans-serif;">Afin de consulter cette note de frais, merci de vous connecter à <a target="_blank" href="https://www.carpediem.pro/LesFrais/public/gestionaireUser" >Carpe Diem</a></h1>

    <table style=" width:700px; background:#eeeeee;">
        @foreach ($tableauImages as $tableauImage)
        <tr style="width:100%; height:600px;">
            <td style="width:30%; border:2px solid black; color:black;">
            Facture pour {{explode(':',$tableauImage)[0]}}
            </td>
            <td style="width:70%;">
                <img src="./storage/{{explode(':',$tableauImage)[1]}}" >
            </td>
        </tr>
        @endforeach
    </table>



</body>
</html>
