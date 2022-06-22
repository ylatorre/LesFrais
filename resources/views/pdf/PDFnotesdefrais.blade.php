<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>

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
    </style>
    <table class="tablepdf">
        <thead>
            <th class="TH-table">Jours</th>
            <th class="TH-table w-20">Client / Porspect</th>
            <th class="TH-table w-20">Ville</th>
            <th class="TH-table w-15">Code Postal</th>
            <th class="TH-table">Péage</th>
            <th class="TH-table">Parking</th>
            <th class="TH-table">Essence</th>
            <th class="TH-table">Divers (sauf hotel)</th>
            <th class="TH-table">Dt TVA (20%)</th>
            <th class="TH-table">Repas</th>
            <th class="TH-table">Hotels TTC</th>
            <th class="TH-table">KM / indémnité</th>
        </thead>
        <tbody>
            <tr>
                <td class="TD-table">1</td>
                <td class="TD-table">2</td>
                <td class="TD-table">3</td>
                <td class="TD-table">4</td>
                <td class="TD-table">5</td>
                <td class="TD-table">6</td>
                <td class="TD-table">7</td>
                <td class="TD-table">8</td>
                <td class="TD-table">9</td>
                <td class="TD-table">10</td>
                <td class="TD-table">11</td>
                <td class="TD-table">12</td>
            </tr>
        </tbody>








    </table>
    @foreach ($utilisateurs as $utilisateur)
        {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
    @endforeach


</body>

</html>
