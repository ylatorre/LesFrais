<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css" />

    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
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



                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">

                        <form method="POST" action="/dashboard">
                            @csrf


                            <div class="mb-3">
                                <label class="form-label" for="client">
                                    Client
                                </label>
                                <input class="form-control" id="client" name="client" type="text" value="test">

                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" id="ville" name="ville" type="text" value="test">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" id="code_postal" name="code_postal" type="text" value="test">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="peage">Péage

                                    </label>
                                    <input class="form-control" name="peage" id="peage" type="number"  value="1">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" id="parking" type="number"  value="1">

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" id="divers" type="number"  value="1">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" id="repas" type="number"  value="1">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" id="hotel" type="number"  value="1">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="kilometrage">
                                        Distance
                                    </label>
                                    <input class="form-control" id="kilometrage" name="kilometrage" type="number" value="1">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">
                                Description de la mission
                                </label>
                                <textarea id="descriptionArea" class="form-control input-dashboard" name="descriptionArea"  rows="6" ></textarea>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="Validation"  >Validation</button>

                         </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="row">
                <form action="{{ route('mission.index') }}">
                    <button type="submit" class="btn btn-primary mt-4">Regarder vos déplacements</button>
                </form>

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




    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

    </script>
    <script type="text/javascript">
let alertSuccess = document.querySelector('.alert-success');
window.addEventListener('click', ()=> {
    alertSuccess.style.display = 'none';
})

    </script>





</x-app-layout>
