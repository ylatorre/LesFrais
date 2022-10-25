<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <x-slot name="header">
    </x-slot>
    @if (Auth::user()->admin == 1 && $utilisateurs[0]->admin == 0)


        <div class="flex flex-row justify-around">
            <form method="POST" action="{{ route('supprimerNDF') }}">
                @csrf
                <input type="hidden" name="moisndf" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="username" value="{{ $utilisateurs[0]->name }}">
                <button type="submit" class="supprimerNDF">supprimer la note de frais</button>
            </form>
            <form method="POST" action="{{ route('validerNDF') }}">
                @csrf
                <input type="hidden" name="moisndf" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="username" value="{{ $utilisateurs[0]->name }}">
                <button type="submit" class="validerNDF">Valider la note de frais</button>
            </form>


        </div>

    @elseif(Auth::user()->salarie == 1 || (Auth::user()->admin == 1 && Auth::user()->superadmin != 1))
        <div class="flex flex-row items-center justify-around w-full h-20 px-4 font-bold">
            <a href="{{ route('dashboard') }}"><button type="submit" class="validerNDF">retourner à mon
                    calendrier</button></a>
        </div>
    @elseif(Auth::user()->superadmin == 1)
        @if (explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre')
            <div class="w-full h-20 px-4 font-bold text-center">
            @else
                <div class="w-full h-20 px-4  font-bold text-center">
        @endif
        <div class="flex flex-row justify-around items-center mt-6">
            <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}" id="formndf" target="_blank">
                @csrf
                <input id="inputdate" type="hidden" name="selectedMonth" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="idUser" value="{{ $utilisateurs[0]->idUser }}">


                <button type="submit" class="validerNDF" target="_blank">Valider et générer la note de
                    frais</button>
            </form>

            <a href="{{ route('dashboard') }}"><button type="submit" class="validerNDF">retourner à mon
                    calendrier</button></a>


        </div>
        </div>
    @endif

    @php
        // initialisation des variables
        $totalPeage = 0;
        $totalEssence = 0;
        $totalDivers = 0;
        $totalParking = 0;
        $totalRepas = 0;
        $totalHotels = 0;
        $totalKilometres = 0;
        $SousTotalTransport = 0;
        $SousTotalRepasHotels = 0;
        $totalaEmporter = 0;
        $totalTVA20 = 0;
        $totalTVA10 = 0;
        $totalTVA55 = 0;
    @endphp
    <style>
        .TH-table {
            font-size: 15px;
            border: 1px solid black;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            padding-left: 10px;
            padding-right: 10px;
            height: 40px;
        }

        .TD-table {
            play: flex;
            */ font-size: 13px;
            border: 2px solid black;
            padding-left: 2px;
            padding-right: 2px;
            white-space: nowrap;
        }

        .TD-table-3 {
            font-size: 13px;
            border: 2px solid black;

            padding-top: 6px;
            padding-bottom: 6px;
            white-space: nowrap;
        }

        .col-table {
            font-size: 13px;
            border: 1px solid black;
            padding-left: 2px;
            padding-right: 2px;
        }

        .tablepdf {
            border-collapse: collapse;
        }

        .th-peages {
            padding-left: 40px;
            padding-right: 40px;
        }

        .BGjour {
            background: rgba(255, 187, 0, 0.7);
        }

        .BGyellow {
            background: rgb(255, 251, 0, 0.7);
        }

        .BGblue {
            background: rgba(0, 183, 255, 0.7);
        }

        .BGgreen {
            background: rgba(179, 255, 0, 0.7);
        }

        .BGgris {
            background: rgba(157, 157, 157, 0.7);
        }

        .BGgrisclair {
            background: rgb(190, 190, 190);
        }


        .BGnuit {
            background: rgba(157, 157, 157, 0.7);
        }

        .BGred {
            background: rgba(255, 0, 0, 0.3);
        }


        .td-top-table {
            border: 2px solid black;
            padding: 2px;
            text-align: center;
            font-size: 12px;
        }

        .validerNDF {
            padding: 0.7rem;
            margin-bottom:5px;
            border: 4px solid black;
            border-radius: 0.75rem;
            background: #17458a;
            color:white;
            font-family: 'nunito', sans-serif;
            font-weight: bold;
            font-size: 16px;
            transition: 100ms ease-in;
        }

        .supprimerNDF {
            padding: 0.7rem;
            margin-bottom:5px;
            border: 4px solid black;
            border-radius: 0.75rem;
            background: #a51818;
            color:white;
            font-family: 'nunito', sans-serif;
            font-weight: bold;
            font-size: 16px;
            transition: 100ms ease-in;
        }

        .validerNDF:hover {

            background: rgb(64, 61, 233);
        }

        .supprimerNDF:hover {

            background: #ca3e3e;
        }

        .disparait {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 300px;
            height: 300px;
            background: rgb(39, 39, 39);
            border: 6px solid rgb(39, 39, 39);
            display: none;
            cursor: pointer;
            transition: 200ms ease;
        }

        .disparait:hover {
            border: 6px solid rgb(122, 16, 16);
        }

        /* -- Responsive du site */
        @media screen and (max-width:1400px) {

            /* responsive sous les 1400px*/
            .mission-effectuees {
                font-size: 10px;
            }

            .td-top-table {
                font-size: 12px;
            }

            .TH-table {
                font-size: 10px;
                padding-left: 4px;
                padding-right: 4px;
            }

            .TD-table {
                font-size: 8px;
                padding: 1px;
            }

            .td-sous-total {
                font-size: 11px;
            }
        }

        @media screen and (max-width:1200px) {

            /* responsive sous les 1200px*/
            .TD-table-3 {
                font-size: 10px;

            }

            .phrases {
                font-size: 8px;
            }

            .mission-effectuees {
                font-size: 10px;
            }

            .td-top-table {
                font-size: 12px;
            }

            .TH-table {
                font-size: 10px;
                padding-left: 4px;
                padding-right: 4px;
            }

            .TD-table {
                font-size: 8px;
                padding: 1px;
            }

            .td-sous-total {
                font-size: 11px;
            }
        }

        @media screen and (max-width:960px) {

            /*responsive sous-les 960px*/
            .mission-effectuees {
                font-size: 8px;
            }

            .td-top-table {
                font-size: 7px;
            }

            .TH-table {
                font-size: 7px;
            }

            .TD-table-3 {
                font-size: 8px;
            }

            .TD-table {
                font-size: 6px;
            }

            .td-sous-total {
                font-size: 9px;
            }




        }

        @media screen and (max-width:700px) {

            /*responsive sous-les 700px*/

            .phrases {
                font-size: 6px;
            }

            .mission-effectuees {
                font-size: 7px;
            }

            .td-top-table {
                font-size: 9px;
            }

            .TD-table-tot {
                font-size: 7px;
            }

            .TH-table {
                font-size: 6px;
                padding-left: 2px;
                padding-right: 2px;
            }

            .TD-table-3 {
                font-size: 5px;

            }

            .TD-table {
                font-size: 4px;

            }

            .td-sous-total {
                font-size: 7px;
            }

            .validerNDF {
                font-size: 10px;
            }

            .supprimerNDF {
                font-size: 10px;
        }
        }

        @media screen and (max-width:560px) {
            .TH-table {
                font-size: 5px;

            }
        }

        @media screen and (max-width:500px) {

            /* responsive sous le seuil des 500px*/
            .TH-description {
                width: 40px;
            }

            .TD-description {
                max-width: 40px;
            }

            .mission-effectuees {
                font-size: 6px;
            }

            .td-top-table {
                font-size: 8px;
            }

            .TD-table-3 {
                font-size: 4px;
            }

            .TD-table-tot {
                font-size: 6px;
            }

            .TH-table {
                font-size: 4px;

            }

            .TD-table {
                font-size: 4px;

            }

            .td-sous-total {
                font-size: 6px;
            }

            .validerNDF {
                font-size: 8px;
            }

            .supprimerNDF {
                font-size: 8px;
            }


        }

        @media screen and (max-width:400px) {

            .phrases {
                font-size: 3px;
            }

            /* responsive sous le seuil des 400px*/
            .mission-effectuees {
                font-size: 2px;
            }

            .td-top-table {
                font-size: 3px;
            }

            .TD-table-tot {
                font-size: 2px;
            }

            .TD-table {
                font-size: 2px;
                padding: 0;
            }

            .TH-table {
                font-size: 4px;
                padding: 0;
            }

            .td-sous-total {
                font-size: 3px;
            }

            .validerNDF {
                font-size: 8px;
            }

            .supprimerNDF {
                font-size: 8px;
            }



            .button-image {
                background: url('./images/iconDL.png');
            }
        }
    </style>
    <div class="w-full flex flex-row justify-around py-5 " style="border:4px solid black;">
        <div class="w-full">
            <div class="w-full flex items-center justify-around text-center ">
                <div class="flex flex-row mb-5">
                    <img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">


                    @if (explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre')
                        <div class="flex flex-col justify-around px-4 font-bold text-center">
                            <h1>Prévisualisation de la note de
                                frais de {{ $utilisateurs[0]->name }} pour le mois
                                d'{{ $dateNDFpourPDFetVISU }} (les valeurs sont exprimées en euros)</h1>
                        </div>
                    @else
                        <div class="flex flex-col justify-around px-4 font-bold text-center">
                            <h1>Prévisualisation de la note de
                                frais de {{ $utilisateurs[0]->name }} pour le mois
                                de {{ $dateNDFpourPDFetVISU }} (les valeurs sont exprimées en euros)</h1>
                        </div>
                    @endif





                </div>
            </div>

            {{--    <h1 class="">dawd</h1> --}}
            <div class="w-full flex flex-row justify-around items-center">
                <div>
                    <table class="tablepdf">
                        <thead>
                            <th class="TH-table text-center BGjour" style="border-left: 2px solid black">Jours</th>
                            <th class="TH-table text-center " style="border-left: 2px solid black">Client / Prospect
                            </th>
                            <th class="TH-table text-center ">Code Postal</th>
                            <th class="TH-table text-center ">Ville</th>
                            <th class="TH-table text-center TH-description"
                                style=" overflow:hidden; border-left: 2px solid black;border-right: 2px solid black">
                                Description</th>
                            {{--            <tr colspan="4">TTC            </tr> --}}


                            <th colspan="4" class="TH-table text-center BGblue th-peages"
                                style=" border-left: 2px solid black;">Péages</th>
                            <th class="TH-table text-center BGblue">Parking</th>
                            <th class="TH-table text-center BGblue">Essence</th>
                            <th class="TH-table text-center BGblue">Divers</th>
                            <th class="TH-table text-center BGblue" style="border-left: 2px solid black">TVA
                                (20%)
                            </th>
                            <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Petit
                                déjeuner</th>
                            <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Déjeuner</th>
                            <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Dîner</th>

                            <th class="TH-table text-center BGyellow">Hotels</th>
                            <th class="TH-table text-center BGyellow">TVA (10%)</th>
                            <th class="TH-table text-center BGred">A emporter</th>
                            <th class="TH-table text-center BGred">TVA (5,5%)</th>

                            <th class="TH-table text-center BGgreen" style="border-left: 2px solid black">
                                km
                            </th>

                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($utilisateurs as $utilisateur)
                                <tr>
                                    @php
                                        // - formatage de la date de début
                                        $dateFormatedStart = explode('-', $utilisateur->start);
                                        $dayStart = explode(' ', $dateFormatedStart[2]);
                                        $datedebut = $dayStart[0] . '-' . $dateFormatedStart[1] . '-' . $dateFormatedStart[0] . ' ' . $dayStart[1];

                                        // - formatage de la date de fin
                                        $dateFormatedEnd = explode('-', $utilisateur->end);
                                        $dayEnd = explode(' ', $dateFormatedEnd[2]);
                                        $datefin = $dayStart[0] . '-' . $dateFormatedEnd[1] . '-' . $dateFormatedEnd[0] . ' ' . $dayEnd[1];
                                    @endphp
                                    @php

                                        $totalPeage = $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $totalPeage;
                                        $totalParking = $utilisateur->parking + $totalParking;
                                        $totalEssence = $utilisateur->essence + $totalEssence;
                                        $totalDivers = $utilisateur->divers + $totalDivers;
                                        $totalRepas = $utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $totalRepas;
                                        $totalHotels = $utilisateur->hotel + $totalHotels;
                                        $totalaEmporter = $utilisateur->aEmporter + $totalaEmporter;
                                        $totalKilometres = $utilisateur->kilometrage + $totalKilometres;
                                        $totalTVA20 = round((($utilisateur->divers + $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) + $totalTVA20;
                                        $totalTVA10 = round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) + $totalTVA10;
                                        $totalTVA55 = round(($utilisateur->aEmporter / 1.055) * 0.055, 2) + $totalTVA55;
                                        $totaltot = 0;
                                        $totalTVAtot = round(($totalRepas + $totalHotels) * 0.1, 2);

                                        /* régler le probleme de la tva et du total tva içi*/

                                    @endphp
                                    <td class="TD-table text-center BGjour pl-1 pr-1">du {{ $datedebut }}<br> au
                                        {{ $datefin }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->title }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->code_postal }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->ville }}</td>
                                    <td class="TD-table col-table text-center TD-description"
                                        style="white-space:nowrap; overflow:hidden; border-bottom:2px solid black">
                                        {{ $utilisateur->description }}</td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->peage }}
                                            @if ($utilisateur->pathPeage != '0')
                                                <button class="buttonsImage" id="button{{ $utilisateur->pathPeage }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathPeage }}').style.display = 'block'; "><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->peage2 }}
                                            @if ($utilisateur->pathPeage2 != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathPeage2 }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathPeage2 }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->peage3 }}
                                            @if ($utilisateur->pathPeage3 != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathPeage3 }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathPeage3 }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->peage4 }}
                                            @if ($utilisateur->pathPeage4 != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathPeage4 }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathPeage4 }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->parking }}
                                            @if ($utilisateur->pathParking != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathParking }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathParking }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->essence }}
                                            @if ($utilisateur->pathEssence != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathEssence }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathEssence }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->divers }}
                                            @if ($utilisateur->pathDivers != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathDivers }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathDivers }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center BGgrisclair">
                                        {{ round((($utilisateur->divers + $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) }}
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->petitDej }}
                                            @if ($utilisateur->pathPetitDej != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathPetitDej }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathPetitDej }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->dejeuner }}
                                            @if ($utilisateur->pathDejeuner != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathDejeuner }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathDejeuner }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->diner }}
                                            @if ($utilisateur->pathDiner != '0')
                                                <button class="buttonsImage" id="button{{ $utilisateur->pathDiner }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathDiner }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->hotel }}
                                            @if ($utilisateur->pathHotel != '0')
                                                <button class="buttonsImage" id="button{{ $utilisateur->pathHotel }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathHotel }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center BGgrisclair">
                                        {{ round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) }}

                                    </td>
                                    <td class="TD-table text-center">
                                        <div class="flex flex-row justify-center">{{ $utilisateur->aEmporter }}
                                            @if ($utilisateur->pathAemporter != '0')
                                                <button class="buttonsImage"
                                                    id="button{{ $utilisateur->pathAemporter }}"
                                                    onclick="$('.disparait').hide(); document.getElementById('{{ $utilisateur->pathAemporter }}').style.display = 'block';"><img
                                                        src="./images/iconDL.png" alt='iconDL'></button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="TD-table text-center BGgrisclair">
                                        {{ round(($utilisateur->aEmporter / 1.055) * 0.055, 2) }} </td>

                                    <td class="TD-table col-table text-center" style="border-left: 2px solid black">
                                        {{ $utilisateur->kilometrage }} </td>



                                </tr>
                                {{-- modale d'affichage des images --}}

                                @if ($utilisateur->pathPeage != '0')
                                    <div id="{{ $utilisateur->pathPeage }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathPeage }}').style.display = 'none'  ; ">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathPeage) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathPeage2 != '0')
                                    <div id="{{ $utilisateur->pathPeage2 }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathPeage2 }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathPeage2) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathPeage3 != '0')
                                    <div id="{{ $utilisateur->pathPeage3 }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathPeage3 }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathPeage3) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathPeage4 != '0')
                                    <div id="{{ $utilisateur->pathPeage4 }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathPeage4 }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathPeage4) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathParking != '0')
                                    <div id="{{ $utilisateur->pathParking }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathParking }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathParking) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathEssence != '0')
                                    <div id="{{ $utilisateur->pathEssence }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathEssence }}').style.display = 'none'">
                                        <img src="{{ Storage::url($utilisateur->pathEssence) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathDivers != '0')
                                    <div id="{{ $utilisateur->pathDivers }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathDivers }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathDivers) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathPetitDej != '0')
                                    <div id="{{ $utilisateur->pathPetitDej }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathPetitDej }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathPetitDej) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathDejeuner != '0')
                                    <div id="{{ $utilisateur->pathDejeuner }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathDejeuner }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathDejeuner) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathDiner != '0')
                                    <div id="{{ $utilisateur->pathDiner }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathDiner }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathDiner) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathHotel != '0')
                                    <div id="{{ $utilisateur->pathHotel }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathHotel }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathHotel) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif
                                @if ($utilisateur->pathAemporter != '0')
                                    <div id="{{ $utilisateur->pathAemporter }}" class="disparait"
                                        onclick="document.getElementById('{{ $utilisateur->pathAemporter }}').style.display = 'none'">
                                        <img src="/LesFrais/public{{ Storage::url($utilisateur->pathAemporter) }}" alt="facture"
                                            class="w-full h-full" style="object-fit:contain;"></div>
                                @endif



                                <script>
                                    buttonsImage{{ $i }} = document.querySelectorAll('.buttonsImage');


                                    const peage{{ $i }} = document.getElementById('{{ $utilisateur->pathPeage }}');
                                    const peage2{{ $i }} = document.getElementById('{{ $utilisateur->pathPeage2 }}');
                                    const peage3{{ $i }} = document.getElementById('{{ $utilisateur->pathPeage3 }}');
                                    const peage4{{ $i }} = document.getElementById('{{ $utilisateur->pathPeage4 }}');
                                    const parking{{ $i }} = document.getElementById('{{ $utilisateur->pathParking }}');
                                    const essence{{ $i }} = document.getElementById('{{ $utilisateur->pathEssence }}');
                                    const divers{{ $i }} = document.getElementById('{{ $utilisateur->pathDivers }}');
                                    const petitDej{{ $i }} = document.getElementById('{{ $utilisateur->pathPetitDej }}');
                                    const dejeuner{{ $i }} = document.getElementById('{{ $utilisateur->pathDejeuner }}');
                                    const diner{{ $i }} = document.getElementById('{{ $utilisateur->pathDiner }}');
                                    const hotel{{ $i }} = document.getElementById('{{ $utilisateur->pathHotel }}');
                                    const aEmporter{{ $i }} = document.getElementById('{{ $utilisateur->pathAemporter }}');

                                    const buttonPeage{{ $i }} = document.getElementById('button{{ $utilisateur->pathPeage }}');
                                    const buttonPeage2{{ $i }} = document.getElementById('button{{ $utilisateur->pathPeage2 }}');
                                    const buttonPeage3{{ $i }} = document.getElementById('button{{ $utilisateur->pathPeage3 }}');
                                    const buttonPeage4{{ $i }} = document.getElementById('button{{ $utilisateur->pathPeage4 }}');
                                    const buttonParking{{ $i }} = document.getElementById('button{{ $utilisateur->pathParking }}');
                                    const buttonEssence{{ $i }} = document.getElementById('button{{ $utilisateur->pathEssence }}');
                                    const buttonDivers{{ $i }} = document.getElementById('button{{ $utilisateur->pathDivers }}');
                                    const buttonPetitDej{{ $i }} = document.getElementById('button{{ $utilisateur->pathPetitDej }}');
                                    const buttonDejeuner{{ $i }} = document.getElementById('button{{ $utilisateur->pathDejeuner }}');
                                    const buttonDiner{{ $i }} = document.getElementById('button{{ $utilisateur->pathDiner }}');
                                    const buttonHotel{{ $i }} = document.getElementById('button{{ $utilisateur->pathHotel }}');
                                    const buttonAemporter{{ $i }} = document.getElementById('button{{ $utilisateur->pathAemporter }}');

                                </script>
                                @php
                                    $i++;
                                @endphp
                                {{-- <img src="{{Storage::url($utilisateur->pathParking) }}"> --}}
                            @endforeach
                            <script>
                                image = document.querySelectorAll('.disparait');
                                tailleImage = image.arraylenght;
                                console.log(tailleImage);
                            </script>
                            @php
                                $SousTotalTransport = $totalDivers + $totalEssence + $totalPeage + $totalParking;
                                $SousTotalRepasHotels = $totalRepas + $totalHotels;
                                $DtTotalTVAHotelRepasKM = $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux - $totalTVAtot;
                                $total = round($SousTotalTransport + $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux, 2);
                            @endphp
                            <tr>
                                <td class="BGyellow pl-1 text-center phrases" style="border:2px solid black;"
                                    colspan="2" rowspan="2">Puissance fiscale de
                                    {{ $utilisateurs[0]->chevauxFiscaux }} ch. fiscaux <br> pour un taux de
                                    {{ $utilisateurs[0]->taux }} € / km</td>

                                <td class="BGyellow pl-1 text-center phrases" colspan="3" rowspan="2"
                                    style="border:2px solid black;">Cette note de frais n'a pas encore été soumise à
                                    inspection</td>




                                <td colspan="4" class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalPeage }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalParking }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalEssence }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalDivers }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalTVA20 }} </td>
                                <td colspan="3" class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalRepas }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalHotels }} </td>

                                <td class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important; border-bottom:2px solid black;">
                                    {{ $totalTVA10 }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalaEmporter }} </td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalTVA55 }} </td>
                                <td class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important; border-bottom:2px solid black;">
                                    {{ $totalKilometres }} </td>


                                {{--        <td class="TD-table">{{$totalParking}}</td> --}}
                                {{--        <td class="TD-table">{{$totalEssence}}</td> --}}
                                {{--        <td class="TD-table">{{$totalDivers}}</td> --}}
                            </tr>
                            <tr>
                                <td class="TD-table-3 text-center" rowspan="2" colspan="5">Total HT :
                                    {{ $SousTotalTransport - $totalTVA20 + ($SousTotalRepasHotels - $totalTVA10) + ($totalaEmporter - $totalTVA55) }}
                                    €</td>
                                <td class="TD-table-3 text-center" rowspan="2" colspan="3">Total TVA :
                                    {{ $totalTVA20 + $totalTVA10 + $totalTVA55 }} €</td>
                                <td class="TD-table-3 text-center" rowspan="2" colspan="3"
                                    style="border-right:2px solid black">Total TTC :
                                    {{ $SousTotalRepasHotels + $SousTotalTransport + $totalaEmporter }} € </td>
                                <td class="TD-table-3 text-center" rowspan="2" colspan="3"
                                    style="border:2px solid black">
                                    Indemn. Km : {{ round($totalKilometres * $utilisateurs[0]->taux, 2) }} €</td>
                                <td class="TD-table-3 text-center font-bold" rowspan="2" colspan="2"
                                    style="border:2px solid black">
                                    Total dû :
                                    {{ $SousTotalRepasHotels + $SousTotalTransport + $totalaEmporter + $totalKilometres * $utilisateurs[0]->taux }}
                                    €
                                </td>
                            </tr>



                        </tbody>


                    </table>
                    @foreach ($utilisateurs as $utilisateur)
                        {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
                    @endforeach


                    {{-- <table class="pt-4 mt-5">

                        <tbody>
                            <tr>
                                <td class="TD-table text-center">Taux : {{ $utilisateurs[0]->taux }} € / km</td>
                            </tr>
                            <tr>
                                <td class="TD-table text-center">Dt TVA : {{ $totalTVA20 + $totalTVA10 }} €</td>
                            </tr>
                            <tr>
                                <td class="TD-table text-center">Dt TOTAL HT:
                                    {{ $total - ($totalTVA10 + $totalTVA20) }} €</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
            </div>
            {{-- <script>
                const disparait = document.querySelectorAll('.disparait');

                 disparait.addEventListener('click',()=>{
                            disparait.style.display = 'none'
                 });


            </script> --}}


</x-app-layout>
