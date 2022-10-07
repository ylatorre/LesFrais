<div>
    <div>
        @php

            $moisValide = DB::table('infosndfs')
                ->select('MoisEnCours')
                ->where('Utilisateur', '=', Auth::user()->name)
                ->where('Valide', '=', 1)
                ->get();
            $moisValidationEnCours = DB::table('infosndfs')
                ->select('MoisEnCours')
                ->where('Utilisateur', '=', Auth::user()->name)
                ->where('ValidationEnCours', '=', 1)
                ->get();
            $allMonth = DB::table('infosndfs')
                ->select('MoisEnCours')
                ->where('Utilisateur', '=', Auth::user()->name)
                ->get();

            /* - Création du tableau PHP des mois dit "Valide" */
            $tableauDesMoisValide = [];
            for ($i = 0; $i < sizeof($moisValide); $i++) {
                array_push($tableauDesMoisValide, $moisValide[$i]->MoisEnCours);
            }
            $tailleDuTableauValide = sizeof($tableauDesMoisValide);

            /* - Création du tableau PHP des mois dit "ValidationEnCours" */

            $tableauValidationEnCours = [];
            for ($i = 0; $i < sizeof($moisValidationEnCours); $i++) {
                array_push($tableauValidationEnCours, $moisValidationEnCours[$i]->MoisEnCours);
            }
            $tailleDuTableauValidation = sizeof($tableauValidationEnCours);

            /* - Création du tableau PHP contenant tous les mois du user */

            $tableauAllMonth = [];
            for ($i = 0; $i < sizeof($allMonth); $i++) {
                array_push($tableauAllMonth, $allMonth[$i]->MoisEnCours);
            }
            $tailleDuTableauAllMonth = sizeof($tableauAllMonth);

        @endphp

        {{-- Close your eyes. Count to one. That is how long forever feels. --}}
        <style>
            input:read-only {
                border: 1px solid red !important;
            }

            #essence {
                transition: 100ms;

            }

            #kilometrage {
                transition: 100ms;
            }

            #calendar-container {
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }

            #calendar {
                margin: 10px auto;
                padding: 10px;
                max-width: 1100px;
                height: 700px;
            }

            .col-12 h1 u {
                display: none;
            }
        </style>
        <div>
            <div id='calendar-container' wire:ignore>
                <div id='calendar'></div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('/js/fullcalendar.js') }}"></script>
            {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script> --}}
            <script>
                /* - permet le verrouillage / déverrouillage des input essence et distance en fonction de la valeur saisie */

                const essenceInput = document.getElementById('essence');
                const kmInput = document.getElementById('kilometrage');
                const essenceDiv = document.getElementById('divEssence');
                const kmDiv = document.getElementById('divKilometrage');
                const modifKilometrage = document.getElementById('2kilometrage');
                const modifEssence = document.getElementById('2essence');

                essenceDiv.addEventListener('click', () => {
                    if (kmInput.value == 0) {
                        essenceInput.readOnly = false;
                    }
                })

                kmDiv.addEventListener('click', () => {
                    if (essenceInput.value == 0) {
                        kmInput.readOnly = false;
                    }
                })


                modifKilometrage.addEventListener('click', () => {
                    if (modifEssence.value == 0) {
                        modifKilometrage.readOnly = false;
                    }
                })
                modifEssence.addEventListener('click', () => {
                    if (modifKilometrage.value == 0) {
                        modifEssence.readOnly = false;
                    }
                })







                $('#essence').change(function() {
                    $("#kilometrage").prop('readonly', true);
                });

                $('#kilometrage').change(function() {
                    $("#essence").prop('readonly', true);
                });

                $('#2essence').change(function() {
                    $("#2kilometrage").prop('readonly', true);
                });

                $('#2kilometrage').change(function() {
                    $("#2essence").prop('readonly', true);
                });

                /*------------------*/

                create_UUID = () => {
                    let dt = new Date().getTime();
                    const uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
                        let r = (dt + Math.random() * 16) % 16 | 0;
                        dt = Math.floor(dt / 16);
                        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                    });
                    return uuid;
                }


                document.addEventListener('livewire:load', function() {

                    const Calendar = FullCalendar.Calendar;
                    const calendarEl = document.getElementById('calendar');
                    const calendar = new Calendar(calendarEl, {
                        editable: true,
                        unselectAuto: true,
                        dayMaxEventRows: true,



                        initialView: 'dayGridMonth',
                        // Block pour la création d'événement

                        dateClick: function(info) {
                            let zero = 0;
                            $("#essence").val(zero);
                            $("#kilometrage").val(zero);





                            $('#essence').change(function() {
                                $("#kilometrage").prop('readonly', true);
                            });

                            $('#kilometrage').change(function() {
                                $("#essence").prop('readonly', true);
                            });








                            /* - création du titre lorceque l'utilisateur clique sur une date */
                            let actualyear = $('.fc-toolbar-title').html();

                            nombreDuJour = info.dateStr.slice(8)
                            dateFormatedClicked = nombreDuJour + " " + actualyear;
                            document.getElementById('TitreEvenement').innerHTML = "Déplacement du " +
                                dateFormatedClicked;



                            let selectedyear = actualyear.slice(-4, 25);

                            let yearMonth = $('.fc-toolbar-title').html();

                            let selectedMonth = yearMonth.slice(0, -5);
                            switch (selectedMonth) {
                                case "janvier":
                                    selectedMonth = "01";
                                    break;
                                case "février":
                                    selectedMonth = "02";
                                    break;
                                case "mars":
                                    selectedMonth = "03";
                                    break;
                                case "avril":
                                    selectedMonth = "04";
                                    break;
                                case "mai":
                                    selectedMonth = "05";
                                    break;
                                case "juin":
                                    selectedMonth = "06";
                                    break;
                                case "juillet":
                                    selectedMonth = "07";
                                    break;
                                case "août":
                                    selectedMonth = "08";
                                    break;
                                case "septembre":
                                    selectedMonth = "09";
                                    break;
                                case "octobre":
                                    selectedMonth = "10";
                                    break;
                                case "novembre":
                                    selectedMonth = "11";
                                    break;
                                case "décembre":
                                    selectedMonth = "12";
                                    break;
                                default:
                                    break;
                            }



                            /*içi le clique influe vraiment sur les events*/


                            /* - transformer les tableaux php en tableau javascript */

                            var tabAllMonth = @php echo json_encode($tableauAllMonth); @endphp;
                            var tabValidationEnCours = @php echo json_encode($tableauValidationEnCours); @endphp;
                            var tabMoisValide = @php echo json_encode($tableauDesMoisValide); @endphp;



                            var isCurrentMonthLocked = false;

                            for (let i = 0; i < tabAllMonth.length; i++) {
                                if (tabMoisValide[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la ndf n'ets pas validée */
                                    isCurrentMonthLocked = true;
                                    $calendar
                                    break;

                                } else if (tabValidationEnCours[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la NDF est en cours de validation */
                                    isCurrentMonthLocked = true;
                                    break;
                                } else {
                                    /* sinon laisse le mois cliquable */
                                    isCurrentMonthLocked = false;
                                };
                            };
                            if (isCurrentMonthLocked == false) {
                                $('#event-modal').modal('toggle');

                                $("#essence").prop('readonly', false);
                                $("#kilometrage").prop('readonly', false);



                                $('#duplicate').html('');

                                //gestion de fermeture d'événement

                                $('#closing_button').on('click', function() {
                                    $('#event-modal').modal('toggle');

                                });
                                $('#cancel_button').on('click', function() {
                                    $('#event-modal').modal('toggle');

                                });
                                $('#event-modal').on('hidden.bs.modal', function() {
                                    $('#validation').unbind();



                                });

                                //création d'événement quand le bouton validation est click
                                $("#validation").on('click', function() {
                                    //formatage des dates au format année-mois-jour heure:minute
                                    if (kmInput.value == "") {
                                        $('#kilometrage').val(0);
                                    }
                                    if (essenceInput.value == "") {
                                        $('#essence').val(0);
                                    }

                                    let dateactuelle = info.dateStr;
                                    dateactuelle = dateactuelle.slice(0, -3);
                                    var startDate =
                                        info.dateStr + " " +
                                        $('#heure_debut').val();
                                    var endDate =
                                        info.dateStr + " " +
                                        $('#heure_fin').val();
                                    $('#start').val(startDate);
                                    $('#end').val(endDate);

                                    /* - ajout des valeurs des inpout pour créer l'evenement lorceque repas 2 est saisie*/

                                    $('#starting').val(startDate);
                                    $('#ending').val(endDate);
                                    $('#iding').val(create_UUID());

                                    //ID des events repas
                                    $('#iding2').val(create_UUID());
                                    $('#iding3').val(create_UUID());

                                    //ID des events péages
                                    $('#iding4').val(create_UUID());
                                    $('#iding5').val(create_UUID());
                                    $('#iding6').val(create_UUID());

                                    $('#monthing').val(dateactuelle);

                                    //récupération des input
                                    const id = create_UUID();
                                    let descriptionVal = $("#description").val();
                                    let clientVal = $("#title").val();
                                    let villeVal = $("#ville").val();
                                    let code_postalVal = $("#code_postal").val();
                                    let peageVal = $("#peage").val();
                                    let parkingVal = $("#parking").val();
                                    let diversVal = $("#divers").val();
                                    let repasVal = $("#repas").val();
                                    let hotelVal = $("#hotel").val();
                                    let kilometrageVal = $("#kilometrage").val();
                                    let essenceVal = $("#essence").val();
                                    let heureDebutVal = $("#heure_debut").val();
                                    let heureFinVal = $("#heure_fin").val();


                                    let event = {
                                        id: id,
                                        start: startDate,
                                        end: endDate,
                                        description: descriptionVal,
                                        title: clientVal,
                                        ville: villeVal,
                                        code_postal: code_postalVal,
                                        peage: peageVal,
                                        parking: parkingVal,
                                        divers: diversVal,
                                        repas: repasVal,
                                        essence: essenceVal,
                                        hotel: hotelVal,
                                        kilometrage: kilometrageVal,
                                        idUser: {{ Auth::user()->id }},
                                        heure_debut: heureDebutVal,
                                        heure_fin: heureFinVal,
                                        mois: dateactuelle,
                                    }

                                    //récupérer les erreur d'une request


                                    $("#validation").submit();
                                    // @this.eventAdd(event);



                                    // check.then((value) => {
                                    //     if (value == null) {
                                    //         //si pas d'erreur ajouter l'événement
                                    //         console.log('tu es la');

                                    //     } else {

                                    //         // reset les élément d'affichage d'erreur
                                    //         var isDuplicate = false;
                                    //         $('.errors').remove();
                                    //         //récup la valeur d'où seront positioner les élément d'erreur
                                    //         let bottom = ($("label[for='title']").parent()
                                    //             .outerHeight()) * 0.25;
                                    //         value.forEach(element => {
                                    //             if (element == "duplicate") {
                                    //                 //afficher le messages de duplication
                                    //                 isDuplicate = true;
                                    //                 $('#duplicate').html(
                                    //                     'The event is a duplicate');
                                    //             } else {
                                    //                 //afficher les messages d'erreurs sur les input
                                    //                 $("#" + element).parent().append(
                                    //                     '<div id="errors" class="errors text-[rgb(169,68,66)] absolute bottom-[-' +
                                    //                     bottom +
                                    //                     'px] w-full text-[12px]">Veuillez saisir une valeur.</div>'
                                    //                 );
                                    //             };
                                    //         });
                                    //         $('#duplicate').show();
                                    //     };
                                    //  });

                                    calendar.unselect();

                                });
                            }
                        },

                        //block de déplacage d'événement
                        eventDrop: function(info) {
                            //formatage de la date en année-mois-jour heure:minute
                            let month = info.event.start.getMonth() + 1;
                            if (month < 10) {
                                month = "0" + month;
                            };
                            let day = info.event.start.getDate();
                            if (day < 10) {
                                day = "0" + day;
                            };
                            let year = info.event.start.getFullYear();
                            let startDate = year + "-" + month + "-" + day + " " + info.event._def.extendedProps
                                .heure_debut;

                            let actualyear = $('.fc-toolbar-title').html();
                            let selectedyear = actualyear.slice(-4, 25);

                            let yearMonth = $('.fc-toolbar-title').html();

                            let selectedMonth = yearMonth.slice(0, -5);
                            switch (selectedMonth) {
                                case "janvier":
                                    selectedMonth = "01";
                                    break;
                                case "février":
                                    selectedMonth = "02";
                                    break;
                                case "mars":
                                    selectedMonth = "03";
                                    break;
                                case "avril":
                                    selectedMonth = "04";
                                    break;
                                case "mai":
                                    selectedMonth = "05";
                                    break;
                                case "juin":
                                    selectedMonth = "06";
                                    break;
                                case "juillet":
                                    selectedMonth = "07";
                                    break;
                                case "août":
                                    selectedMonth = "08";
                                    break;
                                case "septembre":
                                    selectedMonth = "09";
                                    break;
                                case "octobre":
                                    selectedMonth = "10";
                                    break;
                                case "novembre":
                                    selectedMonth = "11";
                                    break;
                                case "décembre":
                                    selectedMonth = "12";
                                    break;
                                default:
                                    break;
                            }

                            let dateactuelle = selectedyear + "-" + selectedMonth;


                            /*içi le clique influe vraiment sur les events*/


                            /* - transformer les tableaux php en tableau javascript */

                            var tabAllMonth = @php echo json_encode($tableauAllMonth); @endphp;
                            var tabValidationEnCours = @php echo json_encode($tableauValidationEnCours); @endphp;
                            var tabMoisValide = @php echo json_encode($tableauDesMoisValide); @endphp;



                            var isCurrentMonthLocked = false;
                            var dragable = false;


                            for (let i = 0; i < tabAllMonth.length; i++) {
                                if (tabMoisValide[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la ndf n'est pas validée */
                                    isCurrentMonthLocked = true;

                                    $calendar
                                    break;

                                } else if (tabValidationEnCours[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la NDF est en cours de validation */
                                    isCurrentMonthLocked = true;

                                    break;
                                } else {
                                    /* sinon laisse le mois cliquable */
                                    isCurrentMonthLocked = false;

                                };
                            };
                            if (isCurrentMonthLocked == false) {
                                //appliquer le changement
                                @this.dateChange(info.event.id, startDate);
                            }
                        },

                        //block de modification d'événement
                        eventClick: function(info) {




                            //formatter les date au format année-mois-jour heure:minute

                            let actualyearEvent = $('.fc-toolbar-title').html();

                            let month = info.event.start.getMonth() + 1;
                            if (month < 10) {
                                month = "0" + month;
                            };
                            let day = info.event.start.getDate();
                            if (day < 10) {
                                day = "0" + day;
                            };
                            let year = info.event.start.getFullYear();
                            let startDate = year + "-" + month + "-" + day + " " + $('#heure_debut')
                                .val();
                            let endDate = year + "-" + month + "-" + day + " " + $('#heure_fin')
                                .val();

                            /* - création du titre lorceque l'utilisateur clique sur l'évènement*/
                            nombreDuDay = startDate.slice(8, 11);
                            document.getElementById('TitreEvenement2').innerHTML = "Déplacement du " +
                                nombreDuDay + " " + actualyearEvent;

                            /* formatage de la date*/

                            let actualyear = $('.fc-toolbar-title').html();
                            let selectedyear = actualyear.slice(-4, 25);

                            let yearMonth = $('.fc-toolbar-title').html();

                            let selectedMonth = yearMonth.slice(0, -5);
                            switch (selectedMonth) {
                                case "janvier":
                                    selectedMonth = "01";
                                    break;
                                case "février":
                                    selectedMonth = "02";
                                    break;
                                case "mars":
                                    selectedMonth = "03";
                                    break;
                                case "avril":
                                    selectedMonth = "04";
                                    break;
                                case "mai":
                                    selectedMonth = "05";
                                    break;
                                case "juin":
                                    selectedMonth = "06";
                                    break;
                                case "juillet":
                                    selectedMonth = "07";
                                    break;
                                case "août":
                                    selectedMonth = "08";
                                    break;
                                case "septembre":
                                    selectedMonth = "09";
                                    break;
                                case "octobre":
                                    selectedMonth = "10";
                                    break;
                                case "novembre":
                                    selectedMonth = "11";
                                    break;
                                case "décembre":
                                    selectedMonth = "12";
                                    break;
                                default:
                                    break;
                            }

                            let dateactuelle = selectedyear + "-" + selectedMonth;


                            /*içi le clique influe vraiment sur les events*/


                            /* - transformer les tableaux php en tableau javascript */

                            var tabAllMonth = @php echo json_encode($tableauAllMonth); @endphp;
                            var tabValidationEnCours = @php echo json_encode($tableauValidationEnCours); @endphp;
                            var tabMoisValide = @php echo json_encode($tableauDesMoisValide); @endphp;



                            var isCurrentMonthLocked = false;
                            var dragable = false;


                            for (let i = 0; i < tabAllMonth.length; i++) {
                                if (tabMoisValide[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la ndf n'est pas validée */
                                    isCurrentMonthLocked = true;

                                    $calendar
                                    break;

                                } else if (tabValidationEnCours[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la NDF est en cours de validation */
                                    isCurrentMonthLocked = true;

                                    break;
                                } else {
                                    /* sinon laisse le mois cliquable */
                                    isCurrentMonthLocked = false;

                                };
                            };
                            if (isCurrentMonthLocked == false) {
                                $('#event-modal2').modal('toggle')

                                $('#duplicate').html('');

                                info.el.style.borderColor = 'red';

                                //gestion de fermeture d'événement
                                $('#closing_button2').on('click', function() {
                                    $('#event-modal2').modal('toggle');

                                });
                                $('#cancel_button2').on('click', function() {
                                    $('#event-modal2').modal('toggle');


                                });
                                $('#event-modal2').on('hidden.bs.modal', function() {
                                    info.el.style.borderColor = 'rgb(58,135,173)';

                                    $("#2essence").prop('readonly', false);
                                    $("#2kilometrage").prop('readonly', false);
                                });

                                //remplir les input avec les valeurs de l'événement
                                // console.log(info.event);


                                $('#2start').val(startDate);
                                $('#2end').val(endDate);
                                $('#2mois').val(dateactuelle);
                                $("#eventID").val(info.event.id);
                                $("#2eventID").val(info.event.id);
                                $('#2title').val(info.event.title);
                                $('#2ville').val(info.event._def.extendedProps.ville);
                                $('#2code_postal').val(info.event._def.extendedProps.code_postal);
                                $('#2essence').val(info.event._def.extendedProps.essence);
                                $('#2peage').val(info.event._def.extendedProps.peage);
                                $('#2peage2').val(info.event._def.extendedProps.peage2);
                                $('#2peage3').val(info.event._def.extendedProps.peage3);
                                $('#2peage4').val(info.event._def.extendedProps.peage4);
                                $('#2parking').val(info.event._def.extendedProps.parking);
                                $('#2divers').val(info.event._def.extendedProps.divers);
                                $('#2petitDej').val(info.event._def.extendedProps.petitDej);
                                $('#2dejeuner').val(info.event._def.extendedProps.dejeuner);
                                $('#2diner').val(info.event._def.extendedProps.diner);
                                $('#2hotel').val(info.event._def.extendedProps.hotel);
                                $('#2kilometrage').val(info.event._def.extendedProps.kilometrage);
                                $('#2description').val(info.event._def.extendedProps.description);
                                $('#2heure_debut').val(info.event._def.extendedProps.heure_debut);
                                $('#2heure_fin').val(info.event._def.extendedProps.heure_fin);

                                /* permet la gestion des input dans la modale de modification */

                                const modifKilometrage = document.getElementById('2kilometrage');
                                const modifEssence = document.getElementById('2essence');

                                if (modifKilometrage.value == 0) {
                                    modifKilometrage.readOnly = "true";
                                }
                                if (modifEssence.value == 0) {
                                    modifEssence.readOnly = "true";
                                }



                                $('#supprimer').on('click', function() {
                                    $("#formSupprimerEvent").submit();
                                });

                                const id = info.event.id;

                                //ajouter le bouton supprimer dans le modal


                                //appliquer les changement
                                $('#2validation').on('click', function() {

                                    if(modifEssence.value == ""){
                                        $("#2essence").val(0);
                                    }
                                    if(modifKilometrage.value == ""){
                                        $("#2kilometrage").val(0);
                                    }


                                 $("#formModificationEvent").submit();

                                });


                                //bouton de suppression d'événement


                            }


                        },

                        headerToolbar: {
                            left: 'prev,next',
                            center: 'title',
                            right: '',
                        },
                        locale: '{{ config('app.locale') }}',

                        events: JSON.parse(@this.events),
                        editable: true,
                        eventResize: info => @this.eventChange(info.event),
                        //eventDrop: info => @this.eventChange(info.event)

                    });
                    $('#genendf').on('click', function() {
                        $('#inputdate').val(getMonth());
                        $('#formndf').submit();
                    })
                    $('#unlockMonth').on('click', function() {
                        $('#inputdateunlock').val(getMonth());
                        $('#formunlock').submit();
                    })
                    $('#lockMonth').on('click', function() {
                        $('#inputdatelock').val(getMonth());
                        $('#formlock').submit();
                    })
                    $('#salarievisuNDF').on('click', function() {
                        $('#inputmonthsalarie').val(getMonth());
                        $('#formsalarievisu').submit();
                    })


                    calendar.render();





                });
            </script>



            <script type="text/javascript">
                window.addEventListener('onclick', () => {
                    $("#eventClicked").removeData();
                })
            </script>


            <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
        @endpush
    </div>
</div>
