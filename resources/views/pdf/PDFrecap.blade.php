<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <h1 style="font-size:16px;">Récapitulatif de l'ensemble des factures de l'utilisateur {{$NDFvalidated[0]->Utilisateur}} pour {{$moisNDF}}</h1>

    <table style=" width:700px; background:#202020;">
        @foreach ($tableauImages as $tableauImage)
        <tr style="width:100%; height:600px;">
            <td style="width:30%; border:2px solid black; color:white;">
            Facture pour {{explode(':',$tableauImage)[0]}}
            </td>
            <td style="width:70%; border:2px solid black">
                <img src="./storage/{{explode(':',$tableauImage)[1]}}" style="border:4px solid #202020;">
            </td>
        </tr>
        @endforeach
    </table>



</body>
</html>
