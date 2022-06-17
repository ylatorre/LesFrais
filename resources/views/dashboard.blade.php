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
        <div class="modal" id="event" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mission</h5>



                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">

                        <form action= "/dashboard" method="POST">
                            @csrf


                            <div class="mb-3">
                                <label class="form-label" for="client">
                                    Client
                                </label>
                                <input class="form-control" name="client" type="text">

                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="ville">
                                        Ville
                                    </label>
                                    <input class="form-control" name="ville" type="text">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="code_postal">
                                        Code Postal
                                    </label>
                                    <input class="form-control" name="code_postal" type="text">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="peage">Peage

                                    </label>
                                    <input class="form-control" name="peage" type="number" min="0.00" step="0.01">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="parking">
                                        Parking
                                    </label>
                                    <input class="form-control" name="parking" type="number" min="0.00" step="0.01" >

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="divers">
                                        Divers
                                    </label>
                                    <input class="form-control" name="divers" type="number" min="0.00" step="0.01">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="repas">
                                        Repas
                                    </label>
                                    <input class="form-control" name="repas" type="number" min="0.00" step="0.01">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="hotel">
                                        Hotel
                                    </label>
                                    <input class="form-control" name="hotel" type="number" min="0.00" step="0.01">

                                </div>
                                <div class="col mb-3">
                                    <label class="form-label" for="km">
                                        KM
                                    </label>
                                    <input class="form-control" name="km" type="number" min="0.00" step="0.01">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mission">
                                Déscription de la mission
                                </label>
                                <input class="form-control input-dashboard" name="mission" type="text" placeholder="...">

                            </div>

                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" >Validation</button>

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



                    <div id="calendar">

                    </div>

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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
            }
        })

    </script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today'
                    , center: 'title'
                    , right: 'month,agendaWeek,agendaDay'
                , }


                , selectable: true
                , selectHelper: true
                , select: function(start, end, allDays) {
                    $('#event').modal('toggle');

                }

            })
        });

    </script>



</x-app-layout>
