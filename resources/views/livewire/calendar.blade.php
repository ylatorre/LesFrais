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


                /* vérrouillage des inputs de péages dans la création d'évènement*/

                const peage = document.getElementById('peage');
                const peage2 = document.getElementById('peage2');
                const peage3 = document.getElementById('peage3');
                const peage4 = document.getElementById('peage4');
                const ipeage = document.getElementById('2peage');
                const ipeage2 = document.getElementById('2peage2');
                const ipeage3 = document.getElementById('2peage3');
                const ipeage4 = document.getElementById('2peage4');

                peage.addEventListener('change',()=>{
                    $('#peage2').val(0);
                    $('#peage3').val(0);
                    $('#peage4').val(0);
                })
                peage2.addEventListener('change',()=>{
                    $('#peage3').val(0);
                    $('#peage4').val(0);
                })
                peage3.addEventListener('change',()=>{
                    $('#peage4').val(0);
                })


                peage2.addEventListener('click',()=>{
                    if( peage.value == 0 || peage.value == null){
                        peage2.readOnly = true;
                    }else{
                        peage2.readOnly = false;
                    }
                })
                peage3.addEventListener('click',()=>{
                    if (peage.value == 0 || peage.value == null || peage2.value == 0 || peage2.value == null){
                        peage3.readOnly = true;
                    }else{
                        peage3.readOnly = false;
                    }
                })
                peage4.addEventListener('click',()=>{
                    if (peage.value == 0 || peage.value == null || peage2.value == 0 || peage2.value == null || peage3.value == 0 || peage3.value == null){
                        peage4.readOnly = true;
                    }else{
                        peage4.readOnly = false;
                    }
                })
                /* gestion des input dans la modale de modification de l'évènement */

                ipeage.addEventListener('change',()=>{
                    $('#2peage2').val(0);
                    $('#2peage3').val(0);
                    $('#2peage4').val(0);
                })
                ipeage2.addEventListener('change',()=>{
                    $('#2peage3').val(0);
                    $('#2peage4').val(0);
                })
                ipeage3.addEventListener('change',()=>{
                    $('#2peage4').val(0);
                })


                ipeage2.addEventListener('click',()=>{
                    if( ipeage.value == 0 || ipeage.value == null){
                        ipeage2.readOnly = true;
                    }else{
                        ipeage2.readOnly = false;
                    }
                })
                ipeage3.addEventListener('click',()=>{
                    if (ipeage.value == 0 || ipeage.value == null || ipeage2.value == 0 || ipeage2.value == null){
                        ipeage3.readOnly = true;
                    }else{
                        ipeage3.readOnly = false;
                    }
                })
                ipeage4.addEventListener('click',()=>{
                    if (ipeage.value == 0 || ipeage.value == null || ipeage2.value == 0 || ipeage2.value == null || ipeage3.value == 0 || ipeage3.value == null){
                        ipeage4.readOnly = true;
                    }else{
                        ipeage4.readOnly = false;
                    }
                })

                /* -- changement de logo quand l'input type="file" est saisi -- */

                const inputFactureParking = document.getElementById('factureParking');
                const buttonFactureParking = document.getElementById('buttonFactureParking');

                const inputFacturePeage = document.getElementById('facturePeage');
                const buttonFacturePeage = document.getElementById('buttonFacturePeage');

                const inputFacturePeage2 = document.getElementById('facturePeage2');
                const buttonFacturePeage2 = document.getElementById('buttonFacturePeage2');

                const inputFacturePeage3 = document.getElementById('facturePeage3');
                const buttonFacturePeage3 = document.getElementById('buttonFacturePeage3');

                const inputFacturePeage4 = document.getElementById('facturePeage4');
                const buttonFacturePeage4 = document.getElementById('buttonFacturePeage4');

                const inputFactureDivers = document.getElementById('factureDivers');
                const buttonFactureDivers = document.getElementById('buttonFactureDivers');

                const inputFacturePetitDej = document.getElementById('facturePetitDej');
                const buttonFacturePetitDej = document.getElementById('buttonFacturePetitDej');

                const inputFactureDejeuner = document.getElementById('factureDejeuner');
                const buttonFactureDejeuner = document.getElementById('buttonFactureDejeuner');

                const inputFactureDiner = document.getElementById('factureDiner');
                const buttonFactureDiner = document.getElementById('buttonFactureDiner');

                const inputFactureAemporter = document.getElementById('factureAemporter');
                const buttonFactureAemporter = document.getElementById('buttonFactureAemporter');

                const inputFactureHotel = document.getElementById('factureHotel');
                const buttonFactureHotel = document.getElementById('buttonFactureHotel');

                const inputFactureEssence = document.getElementById('factureEssence');
                const buttonFactureEssence = document.getElementById('buttonFactureEssence');


                inputFactureParking.addEventListener('change',()=>{
                    buttonFactureParking.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFacturePeage.addEventListener('change',()=>{
                    buttonFacturePeage.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFacturePeage2.addEventListener('change',()=>{
                    buttonFacturePeage2.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFacturePeage3.addEventListener('change',()=>{
                    buttonFacturePeage3.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFacturePeage4.addEventListener('change',()=>{
                    buttonFacturePeage4.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureDivers.addEventListener('change',()=>{
                    buttonFactureDivers.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFacturePetitDej.addEventListener('change',()=>{
                    buttonFacturePetitDej.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureDejeuner.addEventListener('change',()=>{
                    buttonFactureDejeuner.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureDiner.addEventListener('change',()=>{
                    buttonFactureDiner.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureAemporter.addEventListener('change',()=>{
                    buttonFactureAemporter.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureHotel.addEventListener('change',()=>{
                    buttonFactureHotel.style.background = "no-repeat url('./images/mini-check.png')";
                });
                inputFactureEssence.addEventListener('change',()=>{
                    buttonFactureEssence.style.background = "no-repeat url('./images/mini-check.png')";
                });

///////////////////////////////
// - Gestion des inputs file dans la modale de modification
///////////////////////////////

                const buttonModifFactureParking = document.getElementById('buttonModifFactureParking');
                const modifFactureParking = document.getElementById('modifFactureParking');
                modifFactureParking.addEventListener('change',()=>{
                    buttonModifFactureParking.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFacturePeage = document.getElementById('buttonModifFacturePeage');
                const modifFacturePeage = document.getElementById('modifFacturePeage');
                modifFacturePeage.addEventListener('change',()=>{
                    buttonModifFacturePeage.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFacturePeage2 = document.getElementById('buttonModifFacturePeage2');
                const modifFacturePeage2 = document.getElementById('modifFacturePeage2');
                modifFacturePeage2.addEventListener('change',()=>{
                    buttonModifFacturePeage2.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFacturePeage3 = document.getElementById('buttonModifFacturePeage3');
                const modifFacturePeage3 = document.getElementById('modifFacturePeage3');
                modifFacturePeage3.addEventListener('change',()=>{
                    buttonModifFacturePeage3.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFacturePeage4 = document.getElementById('buttonModifFacturePeage4');
                const modifFacturePeage4 = document.getElementById('modifFacturePeage4');
                modifFacturePeage4.addEventListener('change',()=>{
                    buttonModifFacturePeage4.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureDivers = document.getElementById('buttonModifFactureDivers');
                const modifFactureDivers = document.getElementById('modifFactureDivers');
                modifFactureDivers.addEventListener('change',()=>{
                    buttonModifFactureDivers.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFacturePetitDej = document.getElementById('buttonModifFacturePetitDej');
                const modifFacturePetitDej = document.getElementById('modifFacturePetitDej');
                modifFacturePetitDej.addEventListener('change',()=>{
                    buttonModifFacturePetitDej.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureDejeuner = document.getElementById('buttonModifFactureDejeuner');
                const modifFactureDejeuner = document.getElementById('modifFactureDejeuner');
                modifFactureDejeuner.addEventListener('change',()=>{
                    buttonModifFactureDejeuner.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureDiner = document.getElementById('buttonModifFactureDiner');
                const modifFactureDiner = document.getElementById('modifFactureDiner');
                modifFactureDiner.addEventListener('change',()=>{
                    buttonModifFactureDiner.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureAemporter = document.getElementById('buttonModifFactureAemporter');
                const modifFactureAemporter = document.getElementById('modifFactureAemporter');
                modifFactureAemporter.addEventListener('change',()=>{
                    buttonModifFactureAemporter.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureHotel = document.getElementById('buttonModifFactureHotel');
                const modifFactureHotel = document.getElementById('modifFactureHotel');
                modifFactureHotel.addEventListener('change',()=>{
                    buttonModifFactureHotel.style.background = "no-repeat url('./images/remplacer.png')";
                });

                const buttonModifFactureEssence = document.getElementById('buttonModifFactureEssence');
                const modifFactureEssence = document.getElementById('modifFactureEssence');
                modifFactureEssence.addEventListener('change',()=>{
                    buttonModifFactureEssence.style.background = "no-repeat url('./images/remplacer.png')";
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

                            nombreDuJour = info.dateStr.slice(8);
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

                            let dateactuelle = selectedyear + "-" + selectedMonth;

                            /*içi le clique influe vraiment sur les events*/


                            /* - transformer les tableaux php en tableau javascript */

                            var tabAllMonth = @php echo json_encode($tableauAllMonth); @endphp;
                            var tabValidationEnCours = @php echo json_encode($tableauValidationEnCours); @endphp;
                            var tabMoisValide = @php echo json_encode($tableauDesMoisValide); @endphp;

                            let calendarExterne = document.getElementById('calendrier-externe');

                            var isCurrentMonthLocked = false;

                            for (let i = 0; i < tabAllMonth.length; i++) {
                                if (tabMoisValide[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la ndf n'ets pas validée */
                                    calendarExterne.style.borderColor = "rgba(192, 44, 44, 0.7)";
                                    setTimeout(() => {
                                        calendarExterne.style.borderColor = "transparent";
                                    }, 300);

                                    isCurrentMonthLocked = true;
                                    break;

                                } else if (tabValidationEnCours[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la NDF est en cours de validation */

                                    calendarExterne.style.borderColor = "rgba(192, 44, 44, 0.7)";
                                    setTimeout(() => {
                                        calendarExterne.style.borderColor = "transparent";
                                    }, 300);
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
                            let calendarExterne = document.getElementById('calendrier-externe');


                            for (let i = 0; i < tabAllMonth.length; i++) {
                                if (tabMoisValide[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la ndf n'est pas validée */
                                    calendarExterne.style.borderColor = "rgba(192, 44, 44, 0.7)";
                                    setTimeout(() => {
                                        calendarExterne.style.borderColor = "transparent";
                                    }, 300);

                                    isCurrentMonthLocked = true;
                                    break;

                                } else if (tabValidationEnCours[i] === dateactuelle) {
                                    /* - Vérrouille le mois si la NDF est en cours de validation */
                                    calendarExterne.style.borderColor = "rgba(192, 44, 44, 0.7)";
                                    setTimeout(() => {
                                        calendarExterne.style.borderColor = "transparent";
                                    }, 300);
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
                                $('#2aEmporter').val(info.event._def.extendedProps.aEmporter);
                                $('#2hotel').val(info.event._def.extendedProps.hotel);
                                $('#2kilometrage').val(info.event._def.extendedProps.kilometrage);
                                $('#2description').val(info.event._def.extendedProps.description);
                                $('#2heure_debut').val(info.event._def.extendedProps.heure_debut);
                                $('#2heure_fin').val(info.event._def.extendedProps.heure_fin);

                                /////////////////////////////////
                                // - JS pour la modification des images - //
                                /////////////////////////////////


                                $('#pathFactureParking').val(info.event._def.extendedProps.pathParking);
                                const pathFactureParking = document.getElementById('pathFactureParking');
                                if(pathFactureParking.value != '0'){
                                    buttonModifFactureParking.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureParking.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFacturePeage').val(info.event._def.extendedProps.pathPeage);
                                const pathFacturePeage = document.getElementById('pathFacturePeage');
                                if(pathFacturePeage.value != '0'){
                                    buttonModifFacturePeage.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFacturePeage.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFacturePeage2').val(info.event._def.extendedProps.pathPeage2);
                                const pathFacturePeage2 = document.getElementById('pathFacturePeage2');
                                if(pathFacturePeage2.value != '0'){
                                    buttonModifFacturePeage2.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFacturePeage2.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFacturePeage3').val(info.event._def.extendedProps.pathPeage3);
                                const pathFacturePeage3 = document.getElementById('pathFacturePeage3');
                                if(pathFacturePeage3.value != '0'){
                                    buttonModifFacturePeage3.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFacturePeage3.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFacturePeage4').val(info.event._def.extendedProps.pathPeage4);
                                const pathFacturePeage4 = document.getElementById('pathFacturePeage4');
                                if(pathFacturePeage4.value != '0'){
                                    buttonModifFacturePeage4.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFacturePeage4.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureDivers').val(info.event._def.extendedProps.pathDivers);
                                const pathFactureDivers = document.getElementById('pathFactureDivers');
                                if(pathFactureDivers.value != '0'){
                                    buttonModifFactureDivers.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureDivers.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFacturePetitDej').val(info.event._def.extendedProps.pathPetitDej);
                                const pathFacturePetitDej = document.getElementById('pathFacturePetitDej');
                                if(pathFacturePetitDej.value != '0'){
                                    buttonModifFacturePetitDej.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFacturePetitDej.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureDejeuner').val(info.event._def.extendedProps.pathDejeuner);
                                const pathFactureDejeuner = document.getElementById('pathFactureDejeuner');
                                if(pathFactureDejeuner.value != '0'){
                                    buttonModifFactureDejeuner.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureDejeuner.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureDiner').val(info.event._def.extendedProps.pathDiner);
                                const pathFactureDiner = document.getElementById('pathFactureDiner');
                                if(pathFactureDiner.value != '0'){
                                    buttonModifFactureDiner.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureDiner.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureAemporter').val(info.event._def.extendedProps.pathAemporter);
                                const pathFactureAemporter = document.getElementById('pathFactureAemporter');
                                if(pathFactureAemporter.value != '0'){
                                    buttonModifFactureAemporter.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureAemporter.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureHotel').val(info.event._def.extendedProps.pathHotel);
                                const pathFactureHotel = document.getElementById('pathFactureHotel');
                                if(pathFactureHotel.value != '0'){
                                    buttonModifFactureHotel.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureHotel.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                $('#pathFactureEssence').val(info.event._def.extendedProps.pathEssence);
                                const pathFactureEssence = document.getElementById('pathFactureEssence');
                                if(pathFactureEssence.value != '0'){
                                    buttonModifFactureEssence.style.background = "no-repeat url('./images/mini-check.png')";
                                }else{
                                    buttonModifFactureEssence.style.background = "no-repeat url('./images/iconDL.png')";
                                }

                                ///////////////////////////////////////////////////////////////////////////////////////////////

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
