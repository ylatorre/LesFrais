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
        font-family: 'nunito',sans-serif;
        font-weight: normal
    }
    h1{
        font-size: 20px;
    }
    h2{
        font-size: 16px;
    }
    p{
        margin:0px;
    }
</style>
<body>
    <br>
    <h1 style="margin:0px; color:#002060;">Bonjour,</h1><br>
    <h2 style="margin:0px; color:#002060;">Ci-joints l'ensemble des factures de l'utilisateur {{$username}} pour {{$mois}}.<br> Le fichier "recap ..." est un fichier au format PDF contenant l'ensemble des factures de cet utilisateur pour {{$mois}}.</h2>
</body>
</html>


