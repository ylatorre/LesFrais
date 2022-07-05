<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <style>
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
    </style>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
        <script>
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
                    unselectAuto:true,
                    initialView: 'dayGridMonth',
                    dateClick: function() {
                        $('#event').modal('toggle')


                    },


                    eventClick: function(info) {
                        // alert('Event: ' + info.event.start);
                        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        // alert('View: ' + info.view.type);

                        // change the border color just for fun
                        $('#eventClicked').removeData()
                        $('#eventClicked').modal('toggle')
                        info.el.style.borderColor = 'red';

                        $('#closing_button').on('click', function() {
                            info.el.style.borderColor = 'rgb(58,135,173)';
                        });
                        $('#cancel_button').on('click', function() {
                            info.el.style.borderColor = 'rgb(58,135,173)';
                        });

                        console.log(info.event);
                        $('#title2').val(info.event.title);
                        $('#ville2').val(info.event._def.extendedProps.ville);
                        $('#code_postal2').val(info.event._def.extendedProps.code_postal);
                        $('#essence2').val(info.event._def.extendedProps.essence);
                        $('#peage2').val(info.event._def.extendedProps.peage);
                        $('#parking2').val(info.event._def.extendedProps.parking);
                        $('#divers2').val(info.event._def.extendedProps.divers);
                        $('#repas2').val(info.event._def.extendedProps.repas);
                        $('#hotel2').val(info.event._def.extendedProps.hotel);
                        $('#kilometrage2').val(info.event._def.extendedProps.kilometrage);
                        $('#description2').val(info.event._def.extendedProps.description);
                        $('#heureDebut2').val(info.event._def.extendedProps.heure_debut);
                        $('#heureFin2').val(info.event._def.extendedProps.heure_fin);

                        const id = info.event._def.publicId;

                        $('#validation2').on('click', function() {

                            oldStart = info.event.start;
                            let day = oldStart.getDate();
                            if (day < 10) {
                                day = "0" + day
                            };
                            let month = oldStart.getMonth() + 1;
                            if (month < 10) {
                                month = "0" + month
                            };
                            var newStartDate =
                                oldStart.getFullYear() + "-" +
                                month + "-" +
                                day + " " +
                                $('#heureDebut2').val();
                            var newEndDate =
                                oldStart.getFullYear() + "-" +
                                month + "-" +
                                day + " " +
                                $('#heureFin2').val();

                            newStartDate = info.event.start;
                            newEndDate = info.event.end;


                            let descriptionVal = $("#description2").val();
                            let clientVal = $("#title2").val();
                            let villeVal = $("#ville2").val();
                            let code_postalVal = $("#code_postal2").val();
                            let peageVal = $("#peage2").val();
                            let parkingVal = $("#parking2").val();
                            let diversVal = $("#divers2").val();
                            let repasVal = $("#repas2").val();
                            let hotelVal = $("#hotel2").val();
                            let kilometrageVal = $("#kilometrage2").val();
                            let essenceVal = $("#essence2").val();
                            let heureDebutVal = $("#heureDebut2").val();
                            let heureFinVal = $("#heureFin2").val();

                            let check = @this.checkEvent({
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
                                heure_debut: heureDebutVal,
                                heure_fin: heureFinVal,
                            });

                            check.then((value) => {
                                //console.log(value);
                                if (value == null) {
                                    @this.eventChange({
                                        id: id,
                                        start: newStartDate,
                                        end: newEndDate,
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
                                    });
                                } else {
                                    value.forEach(element => {
                                        let text = $('#errors2').html();
                                        $('#errors2').html(text + " " + element +
                                            ", ");
                                    });
                                    let text = $('#errors2').html();
                                    $('#errors2').html("Les entrées : " + text +
                                        " ne sont pas correct");
                                    $('#errors2').show();
                                };
                            });

                        });

                        $('#supprimer').on('click', function() {
                            @this.suppressEvent(id);
                        })

                    },

                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                    },
                    locale: '{{ config('app.locale') }}',
                    // console.log
                    events: JSON.parse(@this.events),
                    editable: true,
                    eventResize: info => @this.eventChange(info.event),
                    eventDrop: info => @this.eventChange(info.event),

                    selectable: true,


                    select: function(start, end, allDays) {




                        let i = 0;
                        // window.addEventListener('onclick',()=>{
                        //     $("#eventClicked").style.display = "none";
                        // })
                        // console.log($("#client").val())
                        // let descriptionVal =  document.getElementById("descriptionArea").value

                        // console.log($("#Validation").on('click'));
                        $("#Validation").on('click', function() {
                            $('#errors').html('')
                            let day = start.start.getDate();
                            if (day < 10) {
                                day = "0" + day
                            };
                            let month = start.start.getMonth() + 1;
                            if (month < 10) {
                                month = "0" + month
                            };
                            var startDate =
                                start.start.getFullYear() + "-" +
                                month + "-" +
                                day + " " +
                                $('#heureDebut').val();
                            var endDate =
                                start.start.getFullYear() + "-" +
                                month + "-" +
                                day + " " +
                                $('#heureFin').val();
                            $('#start').val(startDate);
                            $('#end').val(endDate);

                            const id = create_UUID();
                            let descriptionVal = $("#description").val();
                            let clientVal = $("#title1").val();
                            let villeVal = $("#ville").val();
                            let code_postalVal = $("#code_postal").val();
                            let peageVal = $("#peage").val();
                            let parkingVal = $("#parking").val();
                            let diversVal = $("#divers").val();
                            let repasVal = $("#repas").val();
                            let hotelVal = $("#hotel").val();
                            let kilometrageVal = $("#kilometrage").val();
                            let essenceVal = $("#essence").val();
                            let heureDebutVal = $("#heureDebut").val();
                            let heureFinVal = $("#heureFin").val();
                            // console.log(heureDebutVal);


                            // console.log(clientVal, "client")
                            // console.log({{ Auth::user()->id }})

                            // console.log(start)
                            // return calendar
                            // let eventAdd = {calendar}
                            // console.log(start.start,"test54")

                            let check = @this.checkEvent({
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
                                heure_debut: heureDebutVal,
                                heure_fin: heureFinVal,
                            });

                            check.then((value) => {
                                //console.log(value);
                                if (value == null) {
                                    @this.eventAdd({
                                        id: id,
                                        start: startDate,
                                        end: endDate,
                                        allDay: start.allDays,
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
                                    });
                                } else {
                                    value.forEach(element => {
                                        let text = $('#errors').html();
                                        $('#errors').html(text + " " + element +
                                            ", ");
                                    });
                                    let text = $('#errors').html();
                                    $('#errors').html("Les entrées : " + text +
                                        " ne sont pas correct");
                                    $('#errors').show();
                                };
                            });
                            calendar.unselect();
                        });
                    },
                });
                calendar.render();
            });
        </script>

         <script type="text/javascript">
          window.addEventListener('onclick',()=>{
            $("#eventClicked").removeData();

        })
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>
