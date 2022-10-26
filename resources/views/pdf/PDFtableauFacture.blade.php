<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Note de frais </title>
</head>
<style>
    body{
        font-family: 'nunito',sans-serif
    }





    .table-top-PDF h2{
        padding-left:50px;
    }
</style>
<body>

    <table class="table-top-PDF">
        <tr class="w-full">
            <th><img src="./images/logoCDIT.png" alt="logoCDIT"></th>
            <th><h2>Ensemble des factures de l'utilisateur {{$concernedUser[0]->name}}<br>pour le mois {{$concernedEvents[0]->mois}}</h2></th>
        </tr>
    </table>
@if($PDFpathParking == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>parking</h1>
        <img src="./storage/{{$PDFpathParking}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathPeage == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Péage</h1>
        <img src="./storage/{{$PDFpathPeage}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathPeage2 == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Péage 2</h1>
        <img src="./storage/{{$PDFpathPeage2}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathPeage3 == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Péage 3</h1>
        <img src="./storage/{{$PDFpathPeage3}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathPeage4 == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Péage 4</h1>
        <img src="./storage/{{$PDFpathPeage4}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathDivers == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Divers</h1>
        <img src="./storage/{{$PDFpathDivers}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathPetitDej == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Petit dejeuner</h1>
        <img src="./storage/{{$PDFpathPetitDej}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathDejeuner == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Dejeuner</h1>
        <img src="./storage/{{$PDFpathDejeuner}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathDiner == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Diner</h1>
        <img src="./storage/{{$PDFpathDiner}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathAemporter == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Repas à emporter</h1>
        <img src="./storage/{{$PDFpathAemporter}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathHotel == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Hôtel</h1>
        <img src="./storage/{{$PDFpathHotel}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif
@if($PDFpathEssence == '0')
    <div style="display:none;"></div>
    @else
    <div style="page-break-after:always;">
        <h1>Essence</h1>
        <img src="./storage/{{$PDFpathEssence}}" width="700px" height="700px" style="border:4px solid #202020;">
    </div>
@endif



</body>
