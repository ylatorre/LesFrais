<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <>{{ config('app.name', 'Laravel') }}</>

    <!-- Fonts -->


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>


</head>

<body>
    <img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">
    <style>
        .TH-table{
            font-size:10px;
            border:2px solid black;
            padding:2px;
            height:40px;
        }
        .TD-table{
            font-size:8px;
            border:2px solid black;
            padding:2px;
        }
        .tablepdf{
            border:collapse
        }
        .BGjour{
            background : rgba(255, 187, 0, 0.7);
        }
        .BGhotel{
            background : rgb(255, 251, 0, 0.7);
        }

    </style>
    <table class="tablepdf">
        <thead>
            <th class="TH-table BGjour">Jours</th>
            <th class="TH-table w-20">Client / Porspect</th>
            <th class="TH-table w-20">Ville</th>
            <th class="TH-table w-15">Code Postal</th>
            <th class="TH-table">Péage</th>
            <th class="TH-table">Parking</th>
            <th class="TH-table">Essence</th>
            <th class="TH-table">Divers (sauf hotel)</th>
            <th class="TH-table">Dt TVA (20%)</th>
            <th class="TH-table">Repas</th>
            <th class="TH-table BGhotel">Hotels TTC</th>
            <th class="TH-table">KM / indémnité</th>
        </thead>
        <tbody>
            @foreach ($utilisateurs as $utilisateur)
            <tr>
                <td class="TD-table BGjour">{{$utilisateur->start}} à {{$utilisateur->end}}</td>
                <td class="TD-table">{{$utilisateur->title}}</td>
                <td class="TD-table">{{$utilisateur->ville}}</td>
                <td class="TD-table">{{$utilisateur->code_postal}}</td>
                <td class="TD-table">{{$utilisateur->peage}}</td>
                <td class="TD-table">{{$utilisateur->parking}}</td>
                <td class="TD-table">{{$utilisateur->essence}}</td>
                <td class="TD-table">{{$utilisateur->divers}}</td>
                <td class="TD-table">Dt TVA (20%)</td>
                <td class="TD-table">{{$utilisateur->repas}}</td>
                <td class="TD-table">{{$utilisateur->hotel}}</td>
                <td class="TD-table">{{$utilisateur->kilometrage}}</td>
            </tr>
    @endforeach

        </tbody>








    </table>
    @foreach ($utilisateurs as $utilisateur)
        {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
    @endforeach


</body>

</html>
