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



    <div class="container">
        <div class="modal fade" id="event" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
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
                                <input class="form-control" id="title2" name="title" type="text"
                                    value="testtitre2">

                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" id="ville" name="ville" type="text"
                                        value="test">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" id="code_postal" name="code_postal" type="text"
                                        value="test">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="essence">
                                        essence
                                    </label>
                                    <input class="form-control" id="essence" name="essence" type="text"
                                        value="10">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="peage">Péage

                                    </label>
                                    <input class="form-control" name="peage" id="peage" type="number"
                                        value="1">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" id="parking" type="number"
                                        value="1">

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" id="divers" type="number"
                                        value="1">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" id="repas" type="number"
                                        value="1">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" id="hotel" type="number"
                                        value="1">

                                </div>
                                <div class="col mb-3">
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
                            <div class="flex flex-row justify-between items-center">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-danger" id="Suppression">Supprimer la
                                    mission</button>
                                <button type="button" class="btn btn-primary" id="Validation">Valider</button>
                            </div>


                        </form>

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
{{--        <input name="tgyvan" type="hidden" value="2">--}}
        <label for="start">Mois a telecharger:</label>

        <input type="month" id="mois" name="mois"
               min="2018-03" value="{{date("Y-m")}}">

        <div class="h-20 w-full flex flex-row justify-around items-center">
            <x-button target="_blank" type="submit">Generer une facture</x-button>
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
