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
        <div class="modal fade" id="event-modal" role="dialog">
            {{-- modal dialog --}}
            <div class="modal-dialog" role="document">
                {{-- modal content --}}
                <div class="max-h-full overflow-hidden rounded-[3px] border-0 h-full flex flex-col relative bg-white">
                    {{-- modal header --}}
                    <div
                        class="rounded-none items-center flex flex-row p-[10px] box-border border-b-[rgb(224,224,224)] border-b-[1px] justify-between flex-shrink-0">
                        <h5 class="block box-border m-0 text-[rgb(79,79,79)] leading-[20px]">Mission</h5>
                        {{-- <button type="button" id="closing_button"
                            class="relative leading-[11.25px] font-medium text-[7.5px] items-start px-[15px] pb-[5px] pt-[6.25px] bg-[rgb(178,60,253)] hover:bg-[#a316fd] overflow-hidden border-none rounded-[2.5px] shadow-[0_4px_10px_0_rgba(0,0,0,0.2)] box-border text-white block ">X</button> --}}
                        <button type="button" id="closing_button"
                            class="block text-[16px] leading-[20px] text-[rgb(41,43,44)] py-[8px] px-[16px] bg-[rgb(255,255,255)] border border-[rgb(204,204,204)] hover:text-[#292b2c] hover:bg-[rgb(230,230,230)] hover:border-[rgb(173,173,173)] rounded-[4px] focus:shadow-[0px_0px_0px_2px_rgba(204,204,204,0.5)] focus:outline-none">X</button>
                    </div>
                    {{-- modul body --}}
                    <div class="overflow-hidden block p-[10px]">
                        <form action="/dashboard" method="POST">
                            @csrf
                            {{-- Input client --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <div id="duplicate"></div>
                                    <label class="inline-block mb-0" for="title">Client</label>
                                    <input type="text" value="" name="title" id="title"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]">
                                </div>
                            </div>
                            {{-- Input Ville | Code Postal | Essence --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="ville">
                                        Ville
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="ville" name="ville" type="text" value="">

                                </div>
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="code_postal" name="code_postal" type="text" value="">

                                </div>
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="essence">
                                        essence
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="essence" name="essence" type="number" value="1" min="0">

                                </div>
                            </div>
                            {{-- Input Péage | Parking | Divers --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="peage">Péage

                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="peage" id="peage" type="number" value="1" min="0">

                                </div>
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="parking">
                                        Parking
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="parking" id="parking" type="number" value="1" min="0">

                                </div>

                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="divers">
                                        Divers
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="divers" id="divers" type="number" value="1" min="0">

                                </div>
                            </div>
                            {{-- Input Repas | Hotel | Distance --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="repas">
                                        Repas
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="repas" id="repas" type="number" value="1" min="0">

                                </div>
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="hotel">
                                        Hotel
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="hotel" id="hotel" type="number" value="1" min="0">

                                </div>
                                <div class="mb-3 col">
                                    <label class="inline-block mb-0" for="kilometrage">
                                        Distance
                                    </label>
                                    <input
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        id="kilometrage" name="kilometrage" type="number" value="1"
                                        min="0">

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
                                        name="heureDebut" id="heure_debut" type="text" value="00:00">
                                </div>
                                <div class="mb-3 col">
                                    <label for="heure_fin" class="w-full inline-block">
                                        Heure de fin
                                    </label>
                                    <input
                                        class="time fin shadow-[#2563eb] border-[rgb(189,189,189)] text-start h-[38px] px-[7.5px] pt-[4px] pb-[3.28px] w-full rounded-[2.5px]"
                                        name="heureFin" id="heure_fin" type="text" value="00:00">
                                </div>
                                {{-- Empty div to align time input with the others --}}
                            </div>

                            {{-- Input description mission --}}
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="description" class="mb-[5px]">Description de la mission</label>
                                    <textarea name="description" id="description" rows="6"
                                        class="shadow-[#2563eb] border-[rgb(189,189,189)] text-start px-[7.5px] pt-[4px]  w-full rounded-[2.5px]"></textarea>
                                </div>
                            </div>
                        </form>
                        <button
                            class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] mt-[10px] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                            id="cancel_button">ANNULER</button>
                        <button
                            class="inline-block items-start bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0] mt-[10px] shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white"
                            id="validation">VALIDATION</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-12">
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
    <div class="flex flex-row items-center justify-around w-full h-20">
        @if(Auth::user()->salarie == 1)
        
        <div>
            <form method="POST" action="{{ route('lockMonth') }}" class="block">
                @csrf
                <input name="actualMonth" id="actualMonthInput" type="hidden" value="Month">
                <input type="hidden" id="locked" value="false">
                <button
                    class="hidden items-center px-4 py-2 bg-[#1266f1] focus:bg-[#0c56d0] hover:bg-[#0c56d0]  active:bg-[#0c56d0] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    type="submit" id="lockMonth">Soumettre le mois à inspection</button>
            </form>

            <form method="POST" action="{{ route('unlockMonth') }}" class="block">
                @csrf
                <input name="actualMonth" id="actualMonthInput2" type="hidden" value="Month">
                <input name="userId" type="hidden" id="userId" value="{{ Auth::user()->id }}">
                <button
                    class="hidden items-center px-4 py-2 bg-red-700 focus:bg-red-800 hover:bg-red-800  active:bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    type="submit" id="unlockMonth">Annuler ma demande de validation</button>
            </form>
        </div>
        @endif
        <form method="POST" action="/PDFgeneratorPerMonth/{{ Auth::user()->id }}" id="formndf">
            @csrf
            <input id="inputdate" type="hidden" name="selectedMonth" >
            <x-button  type="button" id="genendf" class="px-4 py-2 text-xs" target="_blank">Générer une note de frais</x-button>
        </form>
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
    // let test = $('#calendar .fc-header-toolbar .fc-toolbar-chunk .fc-toolbar-title');

    // console.log(test);
    //     test.style.color="red;"





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






        function checkLock() {
            let date = getMonth();

            let lockedMonth = $('#lockedMonth').val();
            lockedMonth = lockedMonth.split(',')
            let isChecked = false;
            $('#unlockMonth').css('display', 'none');
            $('#lockMonth').css('display', 'none');
            while(isChecked != true){
                lockedMonth.forEach(month => {
                    if (date == month) {
                        console.log('locked');
                        $('#unlockMonth').css('display', 'inline-flex');
                        isChecked = true;
                    }
                });
                isChecked = true;
            }
            if($('#unlockMonth').css('display') == 'none'){
                $('#lockMonth').css('display', 'inline-flex');
            }
        }
        $(document).ready(function() {
            checkLock();
            $('#nextMonthButton').on('click', function() {
                checkLock();
            });
            $('#prevMonthButton').on('click', function() {
                checkLock();
            });
        })
        $('#lockMonth').on('click', function() {
            let date = getMonth()
            $('#isLocked').prop("checked", true);
            $('#actualMonthInput').val(date);
        });
        $('#unlockMonth').on('click', function() {
            let date = getMonth()
            $('#actualMonthInput2').val(date);
        })

        // console.log($('#lockedMonth').val());

        let alertSuccess = document.querySelector('.alert-success');

        window.addEventListener('click', () => {
            if (alertSuccess) {
                alertSuccess.style.display = 'none';
            }

        });

        getMonth();


    </script>
    {{-- <script type="text/javascript">
        let datation = getMonth();
        console.log(datation);

    </script> --}}
    <script type="text/javascript">

            // inputDate.value = $("#calendar").fullCalendar('getDate');
            // genendf = document.getElementById('genendf');
            // inputdate = document.getElementById('inputdate');
            // formndf = document.getElementById('formndf');

            // genendf.addEventListener('click',()=>{
            //     inputdate.value = $("#calendar").fullCalendar('getDate');
            //     formndf.submit();
            // })



    </script>

</x-app-layout>
