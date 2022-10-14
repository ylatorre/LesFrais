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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
    {{-- <style> --}}
    {{-- table { --}}
    {{-- table-layout: fixed; --}}
    {{-- } --}}
    {{-- </style> --}}
    <!-- Modal toggle -->
    <style>
        body {
            font-family: 'nunito', sans-serif;
        }

        /* responsive administration buttons*/
        .responsiv-administration-buttons {
            padding: 15px;
            font-family: 'nunito', sans-serif;
            transition: 200ms ease;

        }
        .evenodd :nth-child(even) {
            background: grey;
        }
        .buttonUtilisateur{
            width:100%;
            display:flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            margin-bottom:12px;
            transition:200ms ease;

        }

        @media screen and (max-width:1450px) {

            /* 1450PX */
            td {
                font-size: 15px;
                width: 10%;

            }

            th {
                font-size: 15px;
                width: 10%;

            }

            .responsiv-administration-buttons {
                font-size: 12px;
                padding: 6px;
            }

            .th-table-admin {
                font-size: 10px;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 6px;
                padding-bottom: 6px;
                max-width: 10%;
            }
        }

        @media screen and (max-width:1240px) {

            /*--------------------------------- 1240PX */
            td {
                font-size: 12px;
                width: 10%;

            }

            th {
                font-size: 12px;
                width: 10%;

            }

            .responsiv-administration-buttons {
                font-size: 12px;
                padding: 6px;
            }

            .th-table-admin {
                font-size: 10px;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 6px;
                padding-bottom: 6px;
                max-width: 10%;
            }
        }

        @media screen and (max-width:1062px) {

            /*--------------------------------- 1062PX */
            .tchao1062 {
                display: none;
            }

            td {
                font-size: 12px;
                width: 10%;
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }

            th {
                font-size: 12px;
                width: 10%;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .responsiv-administration-buttons {
                font-size: 10px;
                padding-left: 6px;
                padding-right: 6px;
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .th-table-admin {
                font-size: 10px;
                padding-left: 8px;
                padding-right: 8px;
                padding-top: 4px;
                padding-bottom: 4px;
                max-width: 10%;
            }
        }

        @media screen and (max-width:780px) {
            /*--------------------------------- 780PX */

            .tchao780 {
                display: none;
            }

            td {
                font-size: 12px;
                width: 10%;
                padding-top: 8px;
                padding-bottom: 8px;
            }

            th {
                font-size: 12px;
                width: 10%;
                padding-top: 8px;
                padding-bottom: 8px;
            }

            .responsiv-administration-buttons {
                font-size: 9px;
                padding-left: 6px;
                padding-right: 6px;
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .th-table-admin {
                font-size: 8px;
                padding-left: 6px;
                padding-right: 6px;
                padding-top: 2px;
                padding-bottom: 2px;
                max-width: 10%;
            }
        }

        @media screen and (max-width:540px) {

            /*--------------------------------- 540PX */
            td {
                font-size: 8px;
                width: 10%;
                padding-top: 2px !important;
                padding-bottom: 2px !important;
            }
            label{
                font-size:10px;
            }

            th {
                font-size: 8px;
                width: 10%;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .responsiv-administration-buttons {
                font-size: 9px;
                padding-left: 5px;
                padding-right: 5px;
                padding-top: 4px;
                padding-bottom: 4px;
                margin-right: 2px !important;
            }
            .buttonUtilisateur{
                align-items: flex-end;
                margin-right:20px;
            }

            .th-table-admin {

                padding-left: 4px;
                padding-right: 4px;
                padding-top: 2px;
                padding-bottom: 2px;
                max-width: 10%;
            }

            .tchao540 {
                display: none;
            }

        }

        @media screen and (max-width:420px) {

            /*--------------------------------- 420PX */
            td {
                font-size: 8px;
                width: 10%;
                padding-top: 4px;
                padding-bottom: 4px;
            }

            th {
                font-size: 8px;
                width: 10%;
                padding-top: 4px;
                padding-bottom: 4px;
            }

            .responsiv-administration-buttons {
                font-size: 8px;
                padding-left: 5px;
                padding-right: 5px;
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .th-table-admin {

                padding-left: 2px;
                padding-right: 2px;
                padding-top: 1px;
                padding-bottom: 1px;
                max-width: 10%;
            }

            .tchao400 {
                display: none;
            }
        }
    </style>
    <div>
        @if (\Session::has('failure'))
            <div
                class="block mb-[16px] py-3 px-5 text-[16px] leading-6 text-[rgb(169,68,66)] bg-[rgb(242,222,222)] border-[rgb(235,204,204)] border ">
                <p>{{ \Session::get('failure') }}</p>
            </div>
        @endif
        @if (Session::has('validatesuccess'))
            <div
                class="font-bold mb-[16px] py-3 px-5 text-[16px] leading-6 text-[rgb(30,122,30)] bg-[rgb(167,209,176)] border-[rgb(188,219,193)] border ">
                <p>{{ Session::get('validatesuccess') }}</p>
            </div>
        @endif
    </div>
    <div class="buttonUtilisateur">
        <button
            class="responsiv-administration-buttons block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" data-modal-toggle="authentication-modal">
            + Utilisateur
        </button>

    </div>
    <div class="relative overflow-visible shadow-md sm:rounded-lg ">
        <table class="table-text-responsiv w-full text-left text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="th-table-admin text-center">
                        Rang
                    </th>
                    <th scope="col" class="th-table-admin text-center">
                        Utilisateur
                    </th>
                    <th scope="col" class="tchao1062 th-table-admin text-center">
                        Email
                    </th>



                    <th scope="col" class="tchao780 th-table-admin  text-center">
                        Numero de Téléphone
                    </th>
                    <th scope="col" class="tchao540 th-table-admin  text-center">
                        Véhicule
                    </th>
                    <th scope="col" class="tchao780 th-table-admin  text-center">
                        chevaux Fiscaux
                    </th>
                    <th scope="col" class="th-table-admin  text-center tchao400 ">
                        Taux/Km
                    </th>
                    <th scope="col" class="tchao780 th-table-admin  text-center">
                        Mot de passe
                    </th>


                    <th scope="col" class="px-6 py-3 text-center">
                        <span class="sr-only">Modifier</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($users as $user)
                    <tr
                        class=" overflow-visible border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        @if ($user->admin == 1 && $user->superadmin == 0)
                            <td scope="row"
                                class="px-2 text-center font-medium text-blue-600 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                Modérateur
                            </td>
                            <td scope="row"
                                class="px-2 py-2 text-center font-medium text-blue-600 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                {{ $user->name }}
                            </td>
                            <td class="tchao1062 py-2 text-center text-blue-600" style="background:white;">
                                {{ $user->email }}
                            </td>
                            <td class="tchao780 py-2 text-center text-blue-600" style="background:white;">
                                {{ $user->portables }}
                            </td>
                            <td class="tchao540 py-2 text-center text-blue-600" style="background:white;">
                                {{ $user->vehicule }}
                            </td>
                            <td class="tchao780 py-2 text-center text-blue-600" style="background:white;">
                                {{ $user->chevauxFiscaux }}
                            </td>
                            <td class=" py-2 text-center text-blue-600 tchao400" style="background:white;">
                                {{ $user->taux }} €
                            </td>

                            <td class="tchao780 py-2 text-center text-blue-600" style="background:white;">
                                *******
                            </td>
                        @elseif($user->superadmin == 1)
                            <td scope="row"
                                class=" py-2 text-center font-bold text-red-400 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                Administrateur
                            </td>
                            <td scope="row"
                                class=" py-2 text-center font-bold text-red-400 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                {{ $user->name }}
                            <td class="tchao1062 py-2 text-center text-red-400 font-bold" style="background:white;">
                                {{ $user->email }}
                            </td>
                            <td class="tchao780 py-2 text-center text-red-400 font-bold" style="background:white;">
                                {{ $user->portables }}
                            </td>
                            <td class="tchao540 py-2 text-center text-red-400 font-bold" style="background:white;">
                                {{ $user->vehicule }}
                            </td>
                            <td class="tchao780 py-2 text-center text-red-400 font-bold" style="background:white;">
                                {{ $user->chevauxFiscaux }}
                            </td>
                            <td class=" py-2 text-center text-red-400 font-bold tchao400" style="background:white;">
                                {{ $user->taux }} €
                            </td>

                            <td class="tchao780 py-2 text-center text-red-400 font-bold" style="background:white;">
                                *******
                            </td>
                        @else
                            <td scope="row"
                                class=" py-2 text-center font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                Salarié
                            </td>
                            <td scope="row"
                                class=" py-2 text-center font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                style="background:white;">
                                {{ $user->name }}
                            <td class="tchao1062 py-2 text-center" style="background:white;">
                                {{ $user->email }}
                            </td>
                            <td class="tchao780 py-2 text-center" style="background:white;">
                                {{ $user->portables }}
                            </td>
                            <td class="tchao540 py-2 text-center" style="background:white;">
                                {{ $user->vehicule }}
                            </td>
                            <td class="tchao780 py-2 text-center" style="background:white;">
                                {{ $user->chevauxFiscaux }}
                            </td>
                            <td class="py-2 text-center tchao400" style="background:white;">
                                {{ $user->taux }} €
                            </td>

                            <td class="tchao780 py-2 text-center" style="background:white;">
                                *******
                            </td>
                        @endif


                        <td class="py-1 overflow-visible text-right" style="background:white;">
                            <div class=" flex justify-start overflow-visible ">
                                {{-- <a href="#" id="{{$i}}"class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                @if ($user->vehicule != null || $user->chevauxFiscaux != null)
                                    <form method="POST" action="{{ route('gestionnairendf') }}"
                                        class="flex justify-end">
                                        @csrf
                                        {{-- <div class="custom-select-dropdown">
                                            <select name="selectMonth" id="{{ 'selectMonth' . strval($user->id) }}"
                                                class=" px-3.5 py-2.5 mr-2 bg-gray-300 text-gray-700 focus:rounded-b-none rounded-md text-sm font-medium  focus:ring-gray-700 focus:ring-0 border border-transparent focus:border-transparent bg-none "></select>
                                        </div> --}}
                                        <input type="hidden" name="utilisateur" value="{{ $user->name }}">

                                        <input type="hidden" name="salarie" value="{{ $user->salarie }}">

                                        <input type="hidden" name="selectedMonth" id="selectedMonth">

                                        <input type="hidden" name="listLockedMonth" id="listLockedMonth"
                                            value="{{ $uniqueMonth }}">

                                        <input type="hidden" name="listUser" id="listUser"
                                            value="{{ $uniqueUser }}">

                                        <input type="hidden" name="userId" class="userId"
                                            value="{{ $user->id }}">


                                        <button
                                            class=" responsiv-administration-buttons block mr-1 items-center sm:py-2.5 whitespace-nowrap bg-gray-800 border border-transparent rounded-md font-medium text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            type="submit">
                                            Notes de frais
                                        </button>
                                    </form>
                                @endif
                                @if (Auth::user()->admin == 1 && $user->superadmin != 1)
                                    <button
                                        class="responsiv-administration-buttons block mr-1   text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button" data-modal-toggle="authentication-modal{{ $i }}">
                                        Modifier
                                    </button>
                                @elseif(Auth::user()->superadmin == 1)
                                    <button
                                        class=" responsiv-administration-buttons block mr-2   text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button" data-modal-toggle="authentication-modal{{ $i }}">
                                        Modifier
                                    </button>
                                @endif

                                @if (Auth::user()->admin == 1 && Auth::user()->superadmin == 0 && $user->salarie == 1)
                                    <button
                                        class=" responsiv-administration-buttons block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button" data-modal-toggle="popup-modal{{ $i }}">
                                        Supprimer
                                    </button>
                                @elseif(Auth::user()->superadmin == 1 && Auth::user()->email != $user->email)
                                    <button
                                        class="responsiv-administration-buttons block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button" data-modal-toggle="popup-modal{{ $i }}">
                                        Supprimer
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Main modal 2 modif user-->
                    <div id="authentication-modal{{ $i }}" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full ">
                        <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="authentication-modal{{ $i }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div class="px-2 py-2 lg:px-8">
                                    <form class="space-y-6" action="{{ route('modifUser') }}" method="POST">
                                        @csrf

                                        <div>
                                            <label for="name"
                                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Prénom
                                                et Nom</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                placeholder="Prénom puis Nom" value="{{ $user->name }}">
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                placeholder="name@company.com" value="{{ $user->email }}">
                                        </div>


                                        <input type="hidden" name="actualemail" id="actualemail"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" value="{{ $user->email }}">

                                        <div>
                                            <label for="portable"
                                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Portable</label>
                                            <input type="tel" name="portable" id="portable"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                placeholder="06 60 06 60 06" value="{{ $user->portables }}"
                                                autofocus>
                                            @if (Auth::user()->superadmin == 1)
                                                <div class="flex flex-col">
                                                    <label for="admin"
                                                        class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Rôle
                                                    </label>
                                                    <select type="select" name="admin" id="admin"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                        <option value="0">Salarié</option>
                                                        <option value="1">Admin</option>
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex items-end justify-between">
                                            <div class="w-1/3 pr-1">
                                                <label for="vehicule"
                                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Modèle
                                                    du Vehicule</label>
                                                <input type="text" name="vehicule" id="vehicule"
                                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="voiture" value="{{ $user->vehicule }}" autofocus>
                                            </div>
                                            <div class="w-1/3">
                                                <label for="taux"
                                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Taux
                                                </label>
                                                <input type="number" name="taux" id="taux" step="any"
                                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="ex : 502" value="{{ $user->taux }}" required
                                                    autofocus>
                                            </div>
                                            <div class="w-1/3 pl-1">
                                                <label for="ChevauxFiscaux"
                                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Chevaux
                                                    Fiscaux</label>
                                                <input type="number" name="ChevauxFiscaux" id="ChevauxFiscaux"
                                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="exemple: 6" value="{{ $user->chevauxFiscaux }}"
                                                    autofocus>
                                            </div>
                                            <!-- si c'ets le super admin qui est connecté-->



                                        </div>

                                        <button type="submit"
                                            class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Modifier les informations
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="popup-modal{{ $i }}" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full"
                        aria-hidden="true">
                        <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="popup-modal{{ $i }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Etes-vous sur
                                        de bien
                                        vouloir supprimer cet utilisateur ?</h3>
                                    <form methode="post" action="{{ route('supuser') }}">
                                        @csrf
                                        <input type="hidden"value="{{ $user->email }}" name="email">
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Oui, Je suis sur
                                        </button>
                                    </form>
                                    <button data-modal-toggle="popup-modal{{ $i }}" type="button"
                                        class="mt-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Non
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $i = $i + 1;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        var arrayMonth = $('#listLockedMonth').val().split(',');
        var arrayYear = [];
        arrayMonth.forEach(element => {
            arrayYear.push(element.slice(0, -3));
        });
        var arrayUser = $('#listUser').val().split(',');
        console.log(arrayMonth);
        console.log(arrayYear);
        console.log(arrayUser);
        for (let i = 0; i < arrayMonth.length; i++) {
            if (i > 0 && arrayMonth[i] == arrayMonth[i - 1] && arrayUser[i] == arrayUser[i - 1] && arrayYear[i] ==
                arrayYear[i - 1]) {
                i += 1;
            }
            if ((!!document.getElementById("user" + arrayUser[i] + "SelectYear" + arrayYear[i])) == false) {
                $('#dropdownMonthContent' + arrayUser[i]).append('<div class="dropdownYear" id="user' + arrayUser[i] +
                    'SelectYear' + arrayYear[i] +
                    '"> <button id="user' + arrayUser[i] + 'Select' + arrayYear[i] + '" class="dropdownYearBtn">' +
                    arrayYear[i] + '</button> <div class="dropdownYearContent" id="dropdownYearContent' + arrayYear[i] +
                    '" > </div> </div>');
            }
            if ((!!document.getElementById("user" + arrayUser[i] + "Select" + arrayMonth[i])) == false) {
                $('#dropdownYearContent' + arrayYear[i]).append('<button class="selectYearButton" id="user' + arrayUser[i] +
                    'Select' + arrayMonth[i] + '">' + arrayMonth[i] + '</button>');
                $('#user' + arrayUser[i] + 'Select' + arrayYear[i]).width($('#dropdownMonthBtn' + arrayUser[i]).width());

                var yearButton = document.getElementById('user' + arrayUser[i] + 'Select' + arrayMonth[i]).addEventListener(
                    'click',
                    function() {
                        $('#dropdownMonthBtn' + arrayUser[i]).html(arrayMonth[i]);
                        $('.dropdownYearBtn').width($('#dropdownMonthBtn' + arrayUser[i]).width());
                        $('#selectedMonth').val(arrayMonth[i]);
                    })
            }
            // $('#dropdownMonthContent' + arrayUser[i]).append('<a id="select'+arrayMonth[i]+'">' + arrayMonth[i] + '</a>');
        }
    </script>

    <!-- Main modal ajout user -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full ">
        <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="authentication-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="px-2 py-2 lg:px-8">

                    <!--AJOUTER UN USER-->

                    <form class="space-y-6" action="{{ route('ajoutUser') }}" method="post">
                        @csrf

                        <div>
                            <label for="name"
                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Prénom et
                                Nom</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="ex: Prénom Nom" :value="old('name')" required="">
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@company.com" :value="old('email')" required="">
                        </div>
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col w-1/2 mr-1">
                            <label for="portables"
                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Portable</label>
                            <input type="tel" name="portable" id="portable"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="06 60 06 60 06" :value="old('portable')" required autofocus>
                            </div>
                                @if (Auth::user()->superadmin == 1)
                                <div class="flex flex-col w-1/2 ml-1">
                                    <label for="admin"
                                        class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">
                                        Rôle</label>
                                    <select type="select" name="admin" id="admin"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="0">Salarié</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-end justify-between">
                            <div class="w-1/3 pr-1">
                                <label for="vehicule"
                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Modèle du
                                    Vehicule</label>
                                <input type="text" name="vehicule" id="vehicule"
                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="ex : 308" required autofocus>
                            </div>
                            <div class="w-1/3">
                                <label for="taux"
                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Taux
                                </label>
                                <input type="number" name="taux" id="taux" step="any"
                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="ex : 0.542" required autofocus>
                            </div>
                            <div class="w-1/3 pl-1">
                                <label for="ChevauxFiscaux"
                                    class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Chevaux
                                    Fiscaux</label>
                                <input type="text" name="ChevauxFiscaux" id="ChevauxFiscaux"
                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="ex : 6" autofocus>
                            </div>



                        </div>
                        <div>
                            <label for="password"
                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Mot de
                                passe</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required autocomplete="new-password">
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-1 mt-1 font-medium text-gray-900 dark:text-gray-300">Confirmer mot
                                de passe
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Créer
                            un utilisateur</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
