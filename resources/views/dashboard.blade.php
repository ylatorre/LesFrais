<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css" />

    <title>Carpe Diem IT - Note de frais</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <script src="{{ asset('/js/jquery-clock-timepicker.js') }}"></script>







    {{-- Script permettant l'implémentation des inputs horloge --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.standard').clockTimePicker({
                colors: {
                    selectorColor: "#2563eb",
                },
                // fonts :{
                //     fontFamily : "https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
                // },
                alwaysSelectHoursFirst: true,
                onChange: function() {
                    var val = $(this).val();
                    $('.fin').clockTimePicker({
                        minimum: val,
                        alwaysSelectHoursFirst: true
                    })
                    $('.clock-timepicker').css({
                        'display': '',
                        'position': ''
                    });
                }
            });
            $('.fin').clockTimePicker({
                alwaysSelectHoursFirst: true,
                colors: {
                    selectorColor: "#2563eb",
                },
                // fonts :{
                //     fontFamily : "https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
                // },
            });
            $('.clock-timepicker').css({
                'display': '',
                'position': ''
            });

        });
    </script>
    <style>
        /* responsive du titre du calendrier .fc-toolbar-title et .fc-toolbar-pretitle */

        /* - Toutes les classes commencants par fc- sont des classe appartenant au calendrier (fc = fullcalendar)*/
        .fc-toolbar-title {
            font-family: 'nunito', 'Arial', sans-serif;
            font-size: 20px !important;
            font-weight: bold;
            margin-left: 5px !important;
            transition: 100ms;
            color: #AE0B30;
        }
        .fc-day-today{
            background:rgb(221, 220, 255) !important;
        }

        .fc-toolbar-pretitle {
            font-family: 'nunito', 'Arial', sans-serif;
            font-size: 20px !important;
            font-weight: bold;
            margin-bottom: 0px !important;
            margin-left: 2px !important;
            transition: 100ms;
        }
        .fc-daygrid-day-number{
            font-family:'nunito','Arial',sans-serif;
        }
        .fc-col-header-cell-cushion{
            font-family:'nunito','Arial',sans-serif;
        }

        .fc-toolbar-chunk {
            text-align: center;
        }
        .fc-view-harness {

            border: 1px solid #11306e !important;
        }
        .fc-daygrid-event{
            background:#7068da !important;
            border-radius:0.50rem !important;
            color:white !important;
            font-family:'nunito','Arial',sans-serif;
            border:2px solid black !important;
            transition:60ms ;
        }
        .fc-daygrid-event:hover{
            transform: scale(1.050);
            background:#5148d3 !important;

        }
        .fc-daygrid-event-dot{
            border:4px solid black !important;
        }

        .divInput {
            padding: 4px;
        }
        .dashboard-buttons:hover{
            opacity:0.9;
            transform: scale(1.05);
        }

        @media screen and (max-width:800px) {
            .fc-toolbar-title {
                font-size: 15px !important;
            }

            .fc-toolbar-pretitle {
                font-size: 15px !important;
            }
        }

        @media screen and (max-width:600px) {
            .fc-toolbar-title {
                font-size: 12px !important;
            }

            .fc-toolbar-pretitle {
                font-size: 12px !important;
            }
        }

        @media screen and (max-width:400px) {
            .fc-toolbar-title {
                font-size: 8px !important;
            }

            .fc-toolbar-pretitle {
                font-size: 8px !important;
            }
        }

        @media screen and (max-width:320px) {
            .fc-toolbar-title {
                font-size: 6px !important;
            }

            .fc-toolbar-pretitle {
                font-size: 6px !important;
            }

            input {
                font-size: 6px;
                padding: 0px;
            }

            .divInput {
                padding: 4px;
                margin-bottom: 8px !important;
            }

        }

        /*permet de cacher les petites fleches présent sur les inpout type number*/

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Chrome */
        input::-webkit-inner-spin-button,
        input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Opéra*/
        input::-o-inner-spin-button,
        input::-o-outer-spin-button {
            -o-appearance: none;
            margin: 0
        }
    </style>

    {{-- ensembles des erreurs possibles lorceque l'utilisateur admin ou employé soumet sa note de frais pour inspection --}}
    @if (Session::has('emptyInput'))
        <div style="width:90%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('emptyInput') }}</div>
    @endif
    @if (Session::has('noPathParking'))
        <div style="width:90%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathParking') }}</div>
    @endif
    @if (Session::has('noPathPeage'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPeage') }}</div>
    @endif
    @if (Session::has('noPathPeage2'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPeage2') }}</div>
    @endif
    @if (Session::has('noPathPeage3'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPeage3') }}</div>
    @endif
    @if (Session::has('noPathPeage4'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPeage4') }}</div>
    @endif
    @if (Session::has('noPathDivers'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathDivers') }}</div>
    @endif
    @if (Session::has('noPathPetitDej'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPetitDej') }}</div>
    @endif
    @if (Session::has('noPathDejeuner'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathDejeuner') }}</div>
    @endif
    @if (Session::has('noPathDiner'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathDiner') }}</div>
    @endif
    @if (Session::has('noPathAemporter'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathPAemporter') }}</div>
    @endif
    @if (Session::has('noPathHotel'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathHotel') }}</div>
    @endif
    @if (Session::has('noPathEssence'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPathEssence') }}</div>
    @endif

    @if (Session::has('noParking'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noParking') }}</div>
    @endif
    @if (Session::has('noPeage'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPeage') }}</div>
    @endif
    @if (Session::has('noPeage2'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPeage2') }}</div>
    @endif
    @if (Session::has('noPeage3'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPeage3') }}</div>
    @endif
    @if (Session::has('noPeage4'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPeage4') }}</div>
    @endif
    @if (Session::has('noDivers'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noDivers') }}</div>
    @endif
    @if (Session::has('noPetitDej'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noPetitDej') }}</div>
    @endif
    @if (Session::has('noDejeuner'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noDejeuner') }}</div>
    @endif
    @if (Session::has('noDiner'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noDiner') }}</div>
    @endif
    @if (Session::has('noAemporter'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noAemporter') }}</div>
    @endif
    @if (Session::has('noHotel'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noHotel') }}</div>
    @endif
    @if (Session::has('noEssence'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('noEssence') }}</div>
    @endif


    <!---------------------------------->

    @if (Session::has('pasevents'))
        <div class="errorsDashboard" style="width:95%; margin-left:1%; color:red; margin-bottom:3px; font-weight:bold;">
            {{ Session::get('pasevents') }}</div>
    @endif
    @if (Session::has('dejasoumis'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(0, 60, 255); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('dejasoumis') }}</div>
    @endif
    @if (Session::has('dejavalide'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('dejavalide') }}</div>
    @endif
    @if (Session::has('NDFcreee'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('NDFcreee') }}</div>
    @endif
    @if (Session::has('NDFsuppr'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('NDFsuppr') }}</div>
    @endif
    @if (Session::has('supprEvent'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('supprEvent') }}</div>
    @endif
    @if (Session::has('createEvent'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('createEvent') }}</div>
    @endif
    @if (Session::has('modifEvent'))
        <div class="errorsDashboard"
            style="width:95%; margin-left:1%; color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
            {{ Session::get('modifEvent') }}</div>
    @endif
    @if (Session::has('nondf'))
        <div style="color:red; margin-left:1%; margin-bottom:3px; font-weight:bold;">{{ Session::get('nondf') }}</div>
    @endif

    <div class="container">
        <div class="modal fade" id="event-modal" role="dialog">
            {{-- modal dialog --}}
            <div class="modal-dialog" role="document">
                {{-- modal content --}}
                <div class="max-h-full overflow-hidden rounded-[3px] border-0 h-full flex flex-col relative bg-white">
                    {{-- modal header --}}
                    <div
                        class="rounded-none items-center flex flex-row p-[10px] box-border border-b-[rgb(224,224,224)] border-b-[1px] justify-between flex-shrink-0">
                        <h5 id="TitreEvenement" class="block box-border m-0 text-[rgb(79,79,79)] leading-[20px]"></h5>
                        {{-- <button type="button" id="closing_button"
                            class="relative leading-[11.25px] font-medium text-[7.5px] items-start px-[15px] pb-[5px] pt-[6.25px] bg-[rgb(178,60,253)] hover:bg-[#a316fd] overflow-hidden border-none rounded-[2.5px] shadow-[0_4px_10px_0_rgba(0,0,0,0.2)] box-border text-white block ">X</button> --}}
                        <button type="button" id="closing_button"
                            class="block text-[16px] leading-[20px] text-[rgb(41,43,44)] py-[8px] px-[16px] bg-[rgb(255,255,255)] border border-[rgb(204,204,204)] hover:text-[#292b2c] hover:bg-[rgb(230,230,230)] hover:border-[rgb(173,173,173)] rounded-[4px] focus:shadow-[0px_0px_0px_2px_rgba(204,204,204,0.5)] focus:outline-none">X</button>
                    </div>
                    {{-- modul body --}}
                    <div class="overflow-hidden block p-[10px]">
                        <form action="{{ route('createEvent') }}" method="POST" id="formEvent"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- Input client --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <div id="duplicate"></div>
                                    <label class="inline-block mb-0" for="title">Client</label>
                                    <input type="text" name="title" id="title"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        required="required">
                                </div>
                            </div>
                            {{-- Input Ville | Code Postal --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2 ">
                                    <label class="inline-block mb-0 labels-responsiv" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="code_postal" name="code_postal" type="text" pattern="[0-9]{5}"
                                        placeholder="ex : 75000" required="required">

                                </div>
                                <div class="mb-3 col divInput">
                                    <label class="inline-block mb-0 labels-responsiv" for="ville">
                                        Ville
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="ville" name="ville" type="text" value=""
                                        placeholder="ex : Paris" required="required">

                                </div>


                                <div class="mb-3 col divInput pr-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="parking">
                                            Parking
                                        </label>
                                        <input type="file" name="factureParking" id="factureParking"
                                            accept=".png, .jpg, .jpeg" style="display:none;" class="inputFacture"
                                            capture>
                                        <input id="buttonFactureParking" type="button" class="inputFacture"
                                            onclick="document.getElementById('factureParking').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="parking" id="parking" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>
                            </div>
                            {{-- Input Péage | Parking | Divers --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage">Péage</label>
                                        <input type="file" name="facturePeage" id="facturePeage"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFacturePeage" class="inputFacture" type="button"
                                            onclick="document.getElementById('facturePeage').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="peage" id="peage" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>
                                <div class="mb-3 col divInput ">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0 " for="peage2">
                                            Péage 2</label>
                                        <input type="file" name="facturePeage2" id="facturePeage2"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFacturePeage2" class="inputFacture" type="button">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="peage2" id="peage2" type="number" value="0" min="0" step="0.01"
                                        required="required">
                                </div>
                                <div class="mb-3 col divInput ">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage3">
                                            Péage 3</label>
                                        <input type="file" name="facturePeage3" id="facturePeage3"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFacturePeage3" class="inputFacture" type="button">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="peage3" id="peage3" type="number" value="0" min="0"
                                        required="required">
                                </div>
                                <div class="mb-3 col divInput">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage4">
                                            Péage 4</label>
                                        <input type="file" name="facturePeage4" id="facturePeage4"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFacturePeage4" class="inputFacture" type="button">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="peage4" id="peage4" type="number" value="0" min="0" step="0.01"
                                        required="required">
                                </div>



                                <div class="mb-3 col divInput pr-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="divers">
                                            Divers
                                        </label>
                                        <input type="file" name="factureDivers" id="factureDivers"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureDivers" class="inputFacture" type="button"
                                            onclick="document.getElementById('factureDivers').click();">

                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="divers" id="divers" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>
                            </div>

                            {{-- Input Repas | Hotel | Essence | Distance --}}

                            <div class="row">
                                <div class="mb-3 col divInput pl-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="petitDej">
                                            Pt déjeuner
                                        </label>
                                        <input type="file" name="facturePetitDej" id="facturePetitDej"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFacturePetitDej" class="inputFacture" type="button"
                                            onclick="document.getElementById('facturePetitDej').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="petitDej" id="petitDej" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>

                                @csrf
                                <div class="mb-3 col divInput" id="dejeuner">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="dejeuner">
                                            Déjeuner
                                        </label>
                                        <input type="file" name="factureDejeuner" id="factureDejeuner"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureDejeuner" class="inputFacture" type="button"
                                            onclick="document.getElementById('factureDejeuner').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="dejeuner" id="dejeuner" type="number" value="0" min="0" step="0.01"
                                        required="required">
                                </div>
                                <div class="mb-3 col divInput" id="diner">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="diner">
                                            Dîner
                                        </label>
                                        <input type="file" name="factureDiner" id="factureDiner"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureDiner" class="inputFacture" type="button"
                                            onclick="document.getElementById('factureDiner').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="diner" id="diner" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>
                                <div class="mb-3 col divInput pr-2" id="aEmporter">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="aEmporter">
                                            à emporter
                                        </label>
                                        <input type="file" name="factureAemporter" id="factureAemporter"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureAemporter" class="inputFacture" type="button"
                                            onclick="document.getElementById('factureAemporter').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="aEmporter" id="aEmporter" type="number" lang="en"
                                        value="0" min="0" step="0.01" required="required">

                                </div>


                            </div>
                            <div class="row">

                                <div class="mb-3 col divInput pl-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="hotel">
                                            Hôtel
                                        </label>
                                        <input type="file" name="factureHotel" id="factureHotel"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureHotel" class="inputFacture" type="button"
                                            onclick="document.getElementById('factureHotel').click();">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="hotel" id="hotel" type="number" value="0" min="0" step="0.01"
                                        required="required">

                                </div>
                                <div id="divEssence"class="mb-3 col divInput">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="essence">
                                            Essence
                                        </label>
                                        <input type="file" name="factureEssence" id="factureEssence"
                                            accept=".png, .jpg, .jpeg" style="display:none;" capture>
                                        <input id="buttonFactureEssence" class="inputFacture" type="button">
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        id="essence" name="essence" type="number" min="0" value="0" step="0.01"
                                        required="required">
                                </div>
                                <div id="divKilometrage" class="mb-3 col divInput pr-2">
                                    <label class="inline-block mb-0 labels-responsiv" for="kilometrage">
                                        Distance( km )
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        id="kilometrage" name="kilometrage" type="number" value="0"
                                        min="0" required="required">

                                </div>
                            </div>

                            {{-- Input heure début | heure fin --}}

                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="heure_debut" class="inline-block">
                                        Heure de début
                                    </label>
                                    <input
                                        class="time standard shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="heureDebut" id="heure_debut" type="text" value="00:00"
                                        required="required">
                                </div>
                                <div class="mb-3 col">
                                    <label for="heure_fin" class="w-full inline-block">
                                        Heure de fin
                                    </label>
                                    <input
                                        class="time fin shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="heureFin" id="heure_fin" type="text" value="00:00"
                                        required="required">
                                </div>
                                {{-- Empty div to align time input with the others --}}
                            </div>

                            {{-- Input description mission --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="description" class="mb-[5px]">Description du déplacement</label>
                                    <textarea name="description" id="description" rows="3" maxlength="100"
                                        placeholder="ex : Câblage de baie de brassage"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start px-[7.5px] pt-[4px]  w-full rounded-[2.5px]"
                                        required="required"></textarea>
                                </div>
                            </div>
                            <input name="start" id="starting" type="hidden">
                            <input name="end" id="ending" type="hidden">
                            <input name="iding" id="iding" type="hidden">
                            {{-- <input name="iding2" id="iding2" type="hidden">
                            <input name="iding3" id="iding3" type="hidden">
                            <input name="iding4" id="iding4" type="hidden">
                            <input name="iding5" id="iding5" type="hidden">
                            <input name="iding6" id="iding6" type="hidden"> --}}
                            <input name="moisActuel" id="monthing" type="hidden">

                            <button type="submit"
                                class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] mt-[10px] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                id="validation">VALIDATION</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!--/////////////////////////////////////////////////////////////////-->

    <!-- MODALE 2 POUR LA MODIFICATION -->

    <!--/////////////////////////////////////////////////////////////////--> --}}

    <div class="container">
        <div class="modal fade" id="event-modal2" role="dialog">
            {{-- modal dialog --}}
            <div class="modal-dialog" role="document">
                {{-- modal content --}}
                <div class="max-h-full overflow-hidden rounded-[3px] border-0 h-full flex flex-col relative bg-white">
                    {{-- modal header --}}
                    <div
                        class="rounded-none items-center flex flex-row p-[10px] box-border border-b-[rgb(224,224,224)] border-b-[1px] justify-between flex-shrink-0">
                        <h5 id="TitreEvenement2" class="block box-border m-0 text-[rgb(79,79,79)] leading-[20px]">
                        </h5>
                        {{-- <button type="button" id="closing_button"
                        class="relative leading-[11.25px] font-medium text-[7.5px] items-start px-[15px] pb-[5px] pt-[6.25px] bg-[rgb(178,60,253)] hover:bg-[#a316fd] overflow-hidden border-none rounded-[2.5px] shadow-[0_4px_10px_0_rgba(0,0,0,0.2)] box-border text-white block ">X</button> --}}
                        <button type="button" id="closing_button2"
                            class="block text-[16px] leading-[20px] text-[rgb(41,43,44)] py-[8px] px-[16px] bg-[rgb(255,255,255)] border border-[rgb(204,204,204)] hover:text-[#292b2c] hover:bg-[rgb(230,230,230)] hover:border-[rgb(173,173,173)] rounded-[4px] focus:shadow-[0px_0px_0px_2px_rgba(204,204,204,0.5)] focus:outline-none">X</button>
                    </div>
                    {{-- modal body --}}
                    <div class="overflow-hidden block p-[10px]">
                        <form action="{{ route('ModifierEvent') }}" method="POST" id="formModificationEvent"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- Input client --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <div id="duplicate"></div>
                                    <label class="inline-block mb-0" for="title">Client</label>
                                    <input type="text" value="" name="title" id="2title"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        required>
                                </div>
                            </div>
                            {{-- Input Ville | Code Postal --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2">
                                    <label class="inline-block mb-0 labels-responsiv" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="2code_postal" name="code_postal" type="text" value="" required>

                                </div>
                                <div class="mb-3 col divInput">
                                    <label class="inline-block mb-0 labels-responsiv" for="ville">
                                        Ville
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="2ville" name="ville" type="text" value="" required>

                                </div>

                                <!--llllll-->
                                <div class="mb-3 col divInput pr-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="parking">
                                            Parking
                                        </label>
                                        <input id="pathFactureParking" type="hidden" name="pathFactureParking"
                                            value="0">
                                        <input id="buttonModifFactureParking" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureParking').click();">
                                        <input type="file" id="modifFactureParking" accept=".png, .jpeg, .jpg"
                                            name="modifFactureParking" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="parking" id="2parking" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>
                            </div>
                            {{-- Input Péage | Parking | Divers --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2" id="div2peage">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage">Péage
                                        </label>
                                        <input id="pathFacturePeage" type="hidden" name="pathFacturePeage"
                                            value="0">
                                        <input id="buttonModifFacturePeage" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFacturePeage').click();">
                                        <input type="file" id="modifFacturePeage" accept=".png, .jpeg, .jpg"
                                            name="modifFacturePeage" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        name="peage" id="2peage" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>
                                <div class="mb-3 col divInput " id="div2peage2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0 " for="peage2">
                                            Péage 2
                                        </label>
                                        <input id="pathFacturePeage2" type="hidden" name="pathFacturePeage2"
                                            value="0">
                                        <input id="buttonModifFacturePeage2" class="inputFacture" type="button">
                                        <input type="file" id="modifFacturePeage2" accept=".png, .jpeg, .jpg"
                                            name="modifFacturePeage2" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        name="peage2" id="2peage2" type="number" value="0" min="0" step="0.01"
                                        required>
                                </div>
                                <div class="mb-3 col divInput " id="div2peage3">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage3">
                                            Péage 3
                                        </label>
                                        <input id="pathFacturePeage3" type="hidden" name="pathFacturePeage3"
                                            value="0">
                                        <input id="buttonModifFacturePeage3" class="inputFacture" type="button">
                                        <input type="file" id="modifFacturePeage3" accept=".png, .jpeg, .jpg"
                                            name="modifFacturePeage3" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        name="peage3" id="2peage3" type="number" value="0" min="0" step="0.01"
                                        required>
                                </div>
                                <div class="mb-3 col divInput" id="div2peage4">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="peage4">
                                            Péage 4
                                        </label>
                                        <input id="pathFacturePeage4" type="hidden" name="pathFacturePeage4"
                                            value="0">
                                        <input id="buttonModifFacturePeage4" class="inputFacture" type="button">
                                        <input type="file" id="modifFacturePeage4" accept=".png, .jpeg, .jpg"
                                            name="modifFacturePeage4" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        name="peage4" id="2peage4" type="number" value="0" min="0" step="0.01"
                                        required>
                                </div>



                                <div class="mb-3 col divInput pr-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="divers">
                                            Divers
                                        </label>
                                        <input id="pathFactureDivers" type="hidden" name="pathFactureDivers"
                                            value="0">
                                        <input id="buttonModifFactureDivers" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureDivers').click();">
                                        <input type="file" id="modifFactureDivers" accept=".png, .jpeg, .jpg"
                                            name="modifFactureDivers" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="divers" id="2divers" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>
                            </div>
                            {{-- Input | Hotel | Distance --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="2petitDej">
                                            Pt déjeuner
                                        </label>
                                        <input id="pathFacturePetitDej" type="hidden" name="pathFacturePetitDej"
                                            value="0">
                                        <input id="buttonModifFacturePetitDej" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFacturePetitDej').click();">
                                        <input type="file" id="modifFacturePetitDej" accept=".png, .jpeg, .jpg"
                                            name="modifFacturePetitDej" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="petitDej" id="2petitDej" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>

                                @csrf
                                <div class="mb-3 col divInput" id="div2dejeuner">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="repas">
                                            Déjeuner
                                        </label>
                                        <input id="pathFactureDejeuner" type="hidden" name="pathFactureDejeuner"
                                            value="0">
                                        <input id="buttonModifFactureDejeuner" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureDejeuner').click();">
                                        <input type="file" id="modifFactureDejeuner" accept=".png, .jpeg, .jpg"
                                            name="modifFactureDejeuner" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="dejeuner" id="2dejeuner" type="number" value="0" min="0" step="0.01"
                                        required>
                                </div>
                                <div class="mb-3 col divInput" id="div2diner">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="repas">
                                            Dîner
                                        </label>
                                        <input id="pathFactureDiner" type="hidden" name="pathFactureDiner"
                                            value="0">
                                        <input id="buttonModifFactureDiner" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureDiner').click();">
                                        <input type="file" id="modifFactureDiner" accept=".png, .jpeg, .jpg"
                                            name="modifFactureDiner" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="diner" id="2diner" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>
                                <div class="mb-3 col divInput pr-2" id="div2aEmporter">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="2aEmporter">
                                            à emporter
                                        </label>
                                        <input id="pathFactureAemporter" type="hidden" name="pathFactureAemporter"
                                            value="0">
                                        <input id="buttonModifFactureAemporter" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureAemporter').click();">
                                        <input type="file" id="modifFactureAemporter" accept=".png, .jpeg, .jpg"
                                            name="modifFactureAemporter" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="aEmporter" id="2aEmporter" type="number" value="0" step="0.01"
                                        min="0" required>
                                </div>
                            </div>
                            <div class="row">

                                <div class="mb-3 col divInput pl-2">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="hotel">
                                            Hôtel
                                        </label>
                                        <input id="pathFactureHotel" type="hidden" name="pathFactureHotel"
                                            value="0">
                                        <input id="buttonModifFactureHotel" class="inputFacture" type="button"
                                            onclick="document.getElementById('modifFactureHotel').click();">
                                        <input type="file" id="modifFactureHotel" accept=".png, .jpeg, .jpg"
                                            name="modifFactureHotel" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="hotel" id="2hotel" type="number" value="0" min="0" step="0.01"
                                        required>

                                </div>
                                <div id="div2Essence"class="mb-3 col divInput">
                                    <div class="flex flex-row justify-between">
                                        <label class="inline-block mb-0" for="2essence">
                                            Essence
                                        </label>
                                        <input id="pathFactureEssence" type="hidden" name="pathFactureEssence"
                                            value="0">
                                        <input id="buttonModifFactureEssence" class="inputFacture" type="button">
                                        <input type="file" id="modifFactureEssence" accept=".png, .jpeg, .jpg"
                                            name="modifFactureEssence" style="display:none;" capture>
                                    </div>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        id="2essence" name="essence" type="number" min="0" value="0" step="0.01"
                                        required>
                                </div>
                                <div id="div2Kilometrage" class="mb-3 col divInput pr-2">
                                    <label class="inline-block mb-0 labels-responsiv" for="2kilometrage">
                                        Distance( km )
                                    </label>

                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px] peagemodif"
                                        id="2kilometrage" name="kilometrage" type="number" min="0"
                                        value="0" required>

                                </div>
                            </div>
                            {{-- Input heure début | heure fin --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2">
                                    <label for="heure_debut" class="inline-block">
                                        Heure de début
                                    </label>
                                    <input
                                        class="time standard shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="heureDebut" id="2heure_debut" type="text" value="00:00" required>
                                </div>
                                <div class="mb-3 col divInput pr-2">
                                    <label for="heure_fin" class="w-full inline-block">
                                        Heure de fin
                                    </label>
                                    <input
                                        class="time fin shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="heureFin" id="2heure_fin" type="text" value="00:00" required>
                                </div>
                                {{-- Empty div to align time input with the others --}}
                            </div>

                            {{-- Input description mission --}}
                            <div class="row">
                                <div class="mb-3 col divInput pl-2 pr-2">
                                    <label for="description" class="mb-[5px]">Description du déplacement</label>
                                    <textarea name="description" id="2description" rows="3" maxlength="100"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start px-[7.5px] pt-[4px]  w-full rounded-[2.5px]"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="eventID" id="2eventID">
                            <input type="hidden" name="start" id="2start">
                            <input type="hidden" name="end" id="2end">
                            <input type="hidden" name="mois" id="2mois">
                            <input type="hidden" name="idUser" id="2idUSer" value="{{ Auth::user()->id }}">



                            <button type="button"
                                class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] mt-[10px] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                id="2validation">MODIFIER</button>
                            <button type="button"
                                class="inline-flex justify-end items-start bg-red-700 focus:bg-red-800 hover:bg-red-800 shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                id="supprimer">SUPPRIMER</button>
                        </form>

                        <form method="POST" action="{{ route('SupprimerEvent') }}" id="formSupprimerEvent">
                            @csrf
                            <input type="hidden" id="eventID" name="eventID">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="container">
        <div class="row">

            <div id="calendrier-externe" class="col-12">
                @if (\Session::has('failure'))
                    <div
                        class="block mb-[16px] py-3 px-5 text-[16px] text-[rgb(169,68,66)] bg-[rgb(242,222,222)] border-[rgb(235,204,204)] border ">
                        <p>{{ \Session::get('failure') }}</p>
                    </div>
                @endif
                <h1 class="text-center text-primary"><u>Calendrier des Déplacements</u></h1>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif



                <livewire:calendar />
                @livewireScripts
                @stack('scripts')

            </div>

        </div>
        {{-- <footer style="text-align: center; background:rgb(33, 119, 233);color:aliceblue;">
                <p>Author:Rami KHADDOUR<br>
                <a href="ramikhaddour@gmail.com">ramikhaddour@gmail.com</a></p>
              </footer> --}}

    </div>
    <div class="flex flex-row items-center justify-around w-full h-20 text-center">
        @if (Auth::user()->salarie == 1 || (Auth::user()->admin == 1 && Auth::user()->superadmin != 1))
            <!--  permet de vérouiller le mous avec le bouton "Soumettre le mois ....."      -->
            <form method="POST" action="{{ route('lockMonth') }}" class="block" id="formlock">
                @csrf
                <input id="inputdatelock" type="hidden" name="lockedmonth">
                <input type="hidden" id="locked" value="false">
                <button type="button" id="lockMonth"
                    style="font-size:12px; font-family:'nunito','arial',sans-serif; background:#11306e; font-weight:bold;" class="dashboard-buttons sm:text-sm md:text-base lg:text-lg  items-center px-2 py-1  focus:bg-[#0c56d0] hover:bg-[#0c56d0]  active:bg-[#0c56d0] border border-transparent rounded-md font-semibold text-white uppercase tracking-widest  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Soumettre
                    le mois à inspection</button>
            </form>
            <!-- permet aux utilisateurs de visualiser leurs note de frais et ca c'est régale -->
            <form method="POST" action="{{ route('validationNDF') }}" id="formsalarievisu">
                @csrf
                <input id="inputmonthsalarie" type="hidden" name="moisNDF">
                <input id="inputemployesalarie" type="hidden" name="employe" value="{{ Auth::user()->name }}">

                <button type="button" id="salarievisuNDF"
                    style="font-size:12px; font-family:'nunito','arial',sans-serif; font-weight:bold;" class="dashboard-buttons sm:text-sm md:text-base lg:text-lg items-center px-2 py-1 bg-gray-700 focus:bg-gray-800 hover:bg-gray-800  active:bg-red-gray border border-transparent rounded-md font-semibold text-white uppercase tracking-widest  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Visualiser
                    ma note de frais</button>
            </form>

            <form method="POST" action="{{ route('unlockMonth') }}" class="block" id="formunlock">
                @csrf
                <input id="inputdateunlock" type="hidden" name="unlockedmonth">
                <input name="userId" type="hidden" id="userId" value="{{ Auth::user()->id }}">
                <button type="button" id="unlockMonth"
                    style="font-size:12px; font-family:'nunito','arial',sans-serif; background:#AE0B30; font-weight:bold;" class="dashboard-buttons sm:text-sm md:text-base lg:text-lg items-center px-2 py-1 focus:bg-red-800 hover:bg-red-800  active:bg-red-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Annuler
                    ma demande de validation
                </button>
            </form>
        @endif
        @if (Auth::user()->superadmin == 1)
            <form method="POST" action="{{ route('validationNDF') }}" id="formsalarievisu">
                @csrf
                <input id="inputmonthsalarie" type="hidden" name="moisNDF">
                <input id="inputemployesalarie" type="hidden" name="employe" value="{{ Auth::user()->name }}">

                <x-button type="button" id="salarievisuNDF" style="font-family:'nunito','arial',sans-serif">
                    Visualiser ma note de frais</x-button>
            </form>
        @endif

        @if (Auth::user()->admin == 1 && Auth::user()->superadmin == 1)

            @if (Session::has('noevents'))
                <div style="color:red; margin-bottom:3px; font-weight:bold;">{{ Session::get('noevents') }}</div>
            @endif
            @if (Session::has('noCHF'))
                <div style="color:red; margin-bottom:3px; font-weight:bold;">{{ Session::get('noCHF') }}</div>
            @endif
            @if (Session::has('novehicule'))
                <div style="color:red; margin-bottom:3px; font-weight:bold;">{{ Session::get('novehicule') }}</div>
            @endif
            @if (Session::has('NDFcreee'))
                <div style="color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
                    {{ Session::get('NDFcreee') }}</div>
            @endif
            @if (Session::has('NDFsuppr'))
                <div style="color:rgb(15, 170, 15); margin-bottom:3px; font-weight:bold;">
                    {{ Session::get('NDFsuppr') }}</div>
            @endif




        @endif

        <input type="hidden" id="lockedMonth" value="{{ $uniqueMonth }}">
    </div>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
    <script type="text/javascript">
        function getMonth() {
            let date = $('.fc-toolbar-title').html();
            let month = date.slice(0, -5);

            switch (month) {
                case "janvier":
                    month = "01";
                    break;
                case "février":
                    month = "02";
                    break;
                case "mars":
                    month = "03";
                    break;
                case "avril":
                    month = "04";
                    break;
                case "mai":
                    month = "05";
                    break;
                case "juin":
                    month = "06";
                    break;
                case "juillet":
                    month = "07";
                    break;
                case "août":
                    month = "08";
                    break;
                case "septembre":
                    month = "09";
                    break;
                case "octobre":
                    month = "10";
                    break;
                case "novembre":
                    month = "11";
                    break;
                case "décembre":
                    month = "12";
                    break;
                default:
                    break;
            };
            date = date.substr(date.length - 4) + "-" + month;

            return date;
        }
    </script>
    <script type='text/javascript'></script>








    {{-- //     function checkLock() {
    //         let date = getMonth();

    //         let lockedMonth = $('#lockedMonth').val();
    //         lockedMonth = lockedMonth.split(',')
    //         let isChecked = false;
    //         $('#unlockMonth').css('display', 'none');
    //         $('#lockMonth').css('display', 'none');
    //         while(isChecked != true){
    //             lockedMonth.forEach(month => {
    //                 if (date == month) {
    //                     console.log('locked');
    //                     $('#unlockMonth').css('display', 'inline-flex');
    //                     isChecked = true;
    //                 }
    //             });
    //             isChecked = true;
    //         }
    //         if($('#unlockMonth').css('display') == 'none'){
    //             $('#lockMonth').css('display', 'inline-flex');
    //         }
    //     }
    //     $(document).ready(function() {
    //         checkLock();
    //         $('#nextMonthButton').on('click', function() {
    //             checkLock();
    //         });
    //         $('#prevMonthButton').on('click', function() {
    //             checkLock();
    //         });
    //     })
    //     $('#lockMonth').on('click', function() {
    //         let date = getMonth()
    //         $('#isLocked').prop("checked", true);
    //         $('#actualMonthInput').val(date);
    //     });
    //     $('#unlockMonth').on('click', function() {
    //         let date = getMonth()
    //         $('#actualMonthInput2').val(date);
    //     })

    //     console.log($('#lockedMonth').val());

    //     let alertSuccess = document.querySelector('.alert-success');

    //     window.addEventListener('click', () => {
    //         if (alertSuccess) {
    //             alertSuccess.style.display = 'none';
    //         }

    //     });

    //     getMonth();
    // --}}







</x-app-layout>
