<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css" />

    <title>Document</title>
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


    <div class="container">
        <div class="modal fade" id="event" role="dialog" class="hidden">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title">Mission</h5>
                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">

                        <form method="POST" action="/dashboard">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="title">
                                    Client
                                </label>
                                <input class="form-control" id="title1" name="title" type="text" placeholder="ex: WWF"
                                    >

                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" id="ville" name="ville" type="text" placeholder="ex: Paris"
                                        >

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" id="code_postal" name="code_postal" type="text" placeholder="ex: 12 345"
                                        >

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="essence">
                                        essence
                                    </label>
                                    <input class="form-control" id="essence" name="essence" type="text" placeholder="..,..€"
                                        >

                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="peage">Péage

                                    </label>
                                    <input class="form-control" name="peage" id="peage" type="number" placeholder="..,..€"
                                        >

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" id="parking" type="number" placeholder="..,..€"
                                        >

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" id="divers" type="number" placeholder="..,..€"
                                        >

                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" id="repas" type="number" placeholder="..,..€"
                                        >

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" id="hotel" type="number" placeholder="..,..€"
                                        >

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="kilometrage">
                                        Distance
                                    </label>
                                    <input class="form-control" id="kilometrage" name="kilometrage" placeholder="ex: 12km"
                                        type="number">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">
                                    Description de la mission
                                </label>
                                <textarea id="descriptionArea" class="form-control input-dashboard" name="descriptionArea" rows="6" placeholder="Il était une fois..."></textarea>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="Validation">Validation</button>



                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal fade" id="eventClicked" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Modifier la mission</h5>



                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/dashboard">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="title">
                                    Client
                                </label>
                                <input class="form-control" id="title1" name="title" type="text"
                                    value="testtitre">
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" id="ville" name="ville" type="text"
                                        value="test">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" id="code_postal" name="code_postal" type="text"
                                        value="test">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="essence">
                                        essence
                                    </label>
                                    <input class="form-control" id="essence" name="essence" type="text"
                                        value="10">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="peage">Péage
                                    </label>
                                    <input class="form-control" name="peage" id="peage" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" id="parking" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" id="divers" type="number"
                                        value="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" id="repas" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" id="hotel" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="kilometrage">
                                        Distance
                                    </label>
                                    <input class="form-control" id="kilometrage" name="kilometrage"
                                        type="number"value="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="floatingInput" class="form-label">Heure</label>
                                    <div class="timepicker-format form-floating" data-mdb-with-icon="false"
                                        id="input-toggle-timepicker">
                                        <input type="text"
                                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            placeholder="Select a date" data-mdb-toggle="input-toggle-timepicker" />
                                    </div>
                                    <input class="datepicker" type="text" onclick="BasicTimePicker()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="description">
                                        Description de la mission
                                    </label>
                                    <textarea id="descriptionArea" class="form-control input-dashboard" name="descriptionArea" rows="6"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary"
                                    id="Validation">Validation</button>
                            </form>
                    </div> --}}

                </div>

            </div>
            {{-- Modal Tailwind --}}
            <div id="data-modal-toggle" class="z-[1055]">
                {{-- modal dialog --}}
                <div class="my-6 mx-auto max-w-[500px]" role="document">
                    {{-- modal content --}}
                    <div
                        class="max-h-full overflow-hidden rounded-[3px] border-0 h-full flex flex-col relative bg-white">
                        {{-- modal header --}}
                        <div
                            class="rounded-none items-center flex flex-row p-[10px] box-border border-b-[rgb(224,224,224)] border-b-[1px] justify-between flex-shrink-0 before:content-[' '] before:box-border after:content-[' '] after:box-border">
                            <h5 class="block box-border m-0 text-[rgb(79,79,79)] leading-[20px]">Mission</h5>
                            <button type="button"
                                class="relative leading-[11.25px] font-medium text-[7.5px] items-start px-[15px] pb-[5px] pt-[6.25px] bg-[rgb(178,60,253)] hover:bg-[#a316fd] overflow-hidden border-none rounded-[2.5px] shadow-[0_4px_10px_0_rgba(0,0,0,0.2)] box-border text-white block "
                                data-bs-dismiss="modal">X</button>
                        </div>
                        {{-- modul body --}}
                        <div class="overflow-hidden block p-[10px]">
                            <form action="/dashboard" method="POST">
                                @csrf
                                {{-- Input client | errors --}}
                                <div class="mb-3">
                                    <div id="errors" class="text-red-700  pt-[4px] pb-[3.28px]" style="display:none"></div>
                                    <label class="mb-[5px]" for="title">Client</label>
                                    <input type="text" name="title" id="title1" value="testtitre"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]">
                                    <input type="text" name="start" id="start" class="hidden">
                                    <input type="text" name="end" id="end" class="hidden">
                                </div>
                                {{-- Input Ville | Code Postal | Essence --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="ville">
                                            Ville
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="ville" name="ville" type="text" value="test">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="code_postal">
                                            Code Postal
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="code_postal" name="code_postal" type="text"
                                            value="00000">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="essence">
                                            essence
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="essence" name="essence" type="number" min="0" value="10">

                                    </div>
                                </div>
                                {{-- Input Péage | Parking | Divers --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="peage">Péage

                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="peage" id="peage" type="number" min="0" value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="parking">
                                            Parking
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="parking" id="parking" type="number" min="0"
                                            value="1">

                                    </div>

                                    <div class="mb-3 col">
                                        <label class="form-label" for="divers">
                                            Divers
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="divers" id="divers" type="number" min="0"
                                            value="1">

                                    </div>
                                </div>
                                {{-- Input Repas | Hotel | Distance --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="repas">
                                            Repas
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="repas" id="repas" type="number" min="0"
                                            value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="hotel">
                                            Hotel
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="hotel" id="hotel" type="number" min="0"
                                            value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="kilometrage">
                                            Distance
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="kilometrage" name="kilometrage" type="number"
                                            min="0"value="1">

                                    </div>
                                </div>
                                {{-- Input heure début | heure fin --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="heureDebut" class="form-label">
                                            Heure de début
                                        </label>
                                        <input
                                            class="time standard shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="heureDebut" id="heureDebut" type="text" value="00:00">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="heureFin" class="w-full form-label">
                                            Heure de fin
                                        </label>
                                        <input
                                            class="time fin shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="heureFin" id="heureFin" type="text" value="00:00">
                                    </div>
                                    {{-- Empty div to align time input with the others --}}
                                </div>

                                {{-- Input description mission --}}
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="descritpion" class="mb-[5px]">Description de la mission</label>
                                        <textarea name="description" id="description" rows="6"
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"></textarea>
                                    </div>
                                </div>
                            </form>
                            <button
                                class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                data-bs-dismiss="modal">ANNULER</button>
                            <button
                                class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                id="Validation">VALIDATION</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="modal fade" id="eventClicked" role="dialog">

            {{-- Modal bootstrap --}}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title">Mission</h5>
                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/dashboard">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="title">
                                    Client
                                </label>
                                <input class="form-control" id="title2" name="title" type="text"
                                    value="testtitre2">
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" id="ville" name="ville" type="text"
                                        value="test">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" id="code_postal" name="code_postal" type="text"
                                        value="test">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="essence">
                                        essence
                                    </label>
                                    <input class="form-control" id="essence" name="essence" type="text"
                                        value="10">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="peage">Péage
                                    </label>
                                    <input class="form-control" name="peage" id="peage" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" id="parking" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" id="divers" type="number"
                                        value="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" id="repas" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" id="hotel" type="number"
                                        value="1">
                                </div>
                                <div class="mb-3 col">
                                    <label class="form-label" for="kilometrage">
                                        Distance
                                    </label>
                                    <input class="form-control" id="kilometrage" name="kilometrage"
                                        type="number"value="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">
                                    Description de la mission
                                </label>
                                <textarea id="descriptionArea" class="form-control input-dashboard" name="descriptionArea" rows="6"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="Validation">Validation</button>
                        </form>
                    </div> --}}

                </div>
            </div>

            {{-- Modal Tailwind --}}
            <div id="data-modal-toggle" class="z-[1055]">
                {{-- modal dialog --}}
                <div class="my-6 mx-auto max-w-[500px]" role="document">
                    {{-- modal content --}}
                    <div
                        class="max-h-full overflow-hidden rounded-[3px] border-0 h-full flex flex-col relative bg-white">
                        {{-- modal header --}}
                        <div
                            class="rounded-none items-center flex flex-row p-[10px] box-border border-b-[rgb(224,224,224)] border-b-[1px] justify-between flex-shrink-0 before:content-[' '] before:box-border after:content-[' '] after:box-border">
                            <h5 class="block box-border m-0 text-[rgb(79,79,79)] leading-[20px]">Mission</h5>
                            <button type="button" id="closing_button"
                                class="relative leading-[11.25px] font-medium text-[7.5px] items-start px-[15px] pb-[5px] pt-[6.25px] bg-[rgb(178,60,253)] hover:bg-[#a316fd] overflow-hidden border-none rounded-[2.5px] shadow-[0_4px_10px_0_rgba(0,0,0,0.2)] box-border text-white block "
                                data-bs-dismiss="modal">X</button>
                        </div>
                        {{-- modul body --}}
                        <div class="overflow-hidden block p-[10px]">
                            <form action="/dashboard" method="POST">
                                @csrf
                                {{-- Input client --}}
                                <div class="mb-3">
                                    <div id="errors2" class="text-red-700  pt-[4px] pb-[3.28px]" ></div>
                                    <label class="mb-[5px]" for="title">Client</label>
                                    <input type="text" name="title" id="title2" value="testtitre"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]">
                                </div>
                                {{-- Input Ville | Code Postal | Essence --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="ville">
                                            Ville
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="ville2" name="ville" type="text" value="test">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="code_postal">
                                            Code Postal
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="code_postal2" name="code_postal" type="text"
                                            value="test">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="essence">
                                            essence
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="essence2" name="essence" type="number" min="0"
                                            value="10">

                                    </div>
                                </div>
                                {{-- Input Péage | Parking | Divers --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="peage">Péage

                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="peage" id="peage2" type="number" min="0"
                                            value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="parking">
                                            Parking
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="parking" id="parking2" type="number" min="0"
                                            value="1">

                                    </div>

                                    <div class="mb-3 col">
                                        <label class="form-label" for="divers">
                                            Divers
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="divers" id="divers2" type="number" min="0"
                                            value="1">

                                    </div>
                                </div>
                                {{-- Input Repas | Hotel | Distance --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label class="form-label" for="repas">
                                            Repas
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="repas" id="repas2" type="number" min="0"
                                            value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="hotel">
                                            Hotel
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="hotel" id="hotel2" type="number" min="0"
                                            value="1">

                                    </div>
                                    <div class="mb-3 col">
                                        <label class="form-label" for="kilometrage">
                                            Distance
                                        </label>
                                        <input
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            id="kilometrage2" name="kilometrage" type="number"
                                            min="0"value="1">

                                    </div>
                                </div>
                                {{-- Input heure début | heure fin | description mission --}}
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="heureDebut" class="form-label">
                                            Heure de début
                                        </label>
                                        <input
                                            class="time standard shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="heureDebut" id="heureDebut2" type="text" value="00:00">
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="heureFin" class="w-full form-label">
                                            Heure de fin
                                        </label>
                                        <input
                                            class="time fin shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                            name="heureFin" id="heureFin2" type="text" value="00:00">
                                    </div>
                                    {{-- Empty div to align time input with the others --}}
                                </div>

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="descritpion" class="mb-[5px]">Description de la mission</label>
                                        <textarea name="descriptionArea" id="description2" rows="6"
                                            class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div >
                                <button
                                    class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                    data-bs-dismiss="modal" id="cancel_button">ANNULER</button>
                                <button
                                    class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                    id="validation2">VALIDATION</button>
                                @if (auth()->user()->admin)
                                    <button
                                        class="inline-flex justify-end items-start bg-red-700 focus:bg-red-800 hover:bg-red-800 shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                                        id="supprimer">SUPPRIMER</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h1 class="text-center text-primary mt-5"><u>Calendrier des Déplacements</u></h1>

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
    <form methode="POST" action="{{ route('postPDFgenerator') }}">
        @csrf
        <input name="tgyvan" type="hidden" value="2">

        <div class="flex flex-row items-center justify-around w-full h-20">
            <x-button class="px-4 py-2 text-xs" target="_blank" type="submit">Generer une facture</x-button>
        </div>
    </form>



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
    <script type="text/javascript">
        let alertSuccess = document.querySelector('.alert-success');
        window.addEventListener('click', () => {
            if (alertSuccess) {
                alertSuccess.style.display = 'none';
            }
        })
    </script>
</x-app-layout>
