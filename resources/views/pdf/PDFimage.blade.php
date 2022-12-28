<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="width:800px; height:800px;">
        <h1 style="font-family: 'nunito',sans-serif ; font-size:18px;">Facture de {{$titre}} de l'utilisateur {{$NDFvalidated[0]->Utilisateur}} pour son déplacement chez {{$client}}</h1>
        <img src="./storage/{{$image}}"  style="border:4px solid #202020;">
    </div>
</body>
</html>
