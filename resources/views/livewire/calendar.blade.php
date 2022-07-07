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
                    editable: true,
                    unselectAuto: true,

                    initialView: 'dayGridMonth',
                    dateClick: function(info) {
                        $('#event-modal').modal('toggle')

                        $('#errors').html('');
                        $('#duplicate').html('');

                        $('#closing_button').on('click', function() {
                            $('#event-modal').modal('toggle');
                        });
                        $('#cancel_button').on('click', function() {
                            $('#event-modal').modal('toggle');
                        });
                        $('#event-modal').on('hidden.bs.modal', function() {
                            $('#Validation').unbind();
                        });
                        $("#validation").on('click', function() {

                            var startDate =
                                info.dateStr + " " +
                                $('#heure_debut').val();
                            var endDate =
                                info.dateStr + " " +
                                $('#heure_fin').val();
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
                            }


                            let check = @this.checkEvent(event);

                            $('div#error').remove();

                            //console.log(event);
                            check.then((value) => {
                                //console.log(value);
                                if (value == null) {
                                    @this.eventAdd(event);
                                } else {
                                    var isDuplicate = false;
                                    $('#errors').html('');
                                    value.forEach(element => {
                                        if (element == "duplicate") {
                                            isDuplicate = true;
                                            $('#duplicate').html(
                                                'The event is a duplicate');
                                        } else {
                                            $("label[for='" + element + "']")
                                                .parent().append(
                                                    '<div class="text-[rgb(169,68,66)] text-[12px]" id="error">L\'entré n\'est pas correct</div>'
                                                );
                                        };
                                    });
                                    $('#duplicate').show();
                                };
                            });

                            calendar.unselect();

                        });
                    },

                    eventDrop: function(info) {
                        @this.dateChange(info.event.id, info.event.start);
                    },

                    eventClick: function(info) {
                        $('#event-modal').removeData()
                        $('#event-modal').modal('toggle')
                        info.el.style.borderColor = 'red';

                        $('#closing_button').on('click', function() {
                            $('#event-modal').modal('toggle');
                        });
                        $('#cancel_button').on('click', function() {
                            $('#event-modal').modal('toggle');
                        });
                        $('#event-modal').on('hidden.bs.modal', function() {
                            info.el.style.borderColor = 'rgb(58,135,173)';
                            $('#Validation').unbind();
                            $('#supprimer').remove();
                        });

                        console.log(info.event);
                        $('#title1').val(info.event.title);
                        $('#ville').val(info.event._def.extendedProps.ville);
                        $('#code_postal').val(info.event._def.extendedProps.code_postal);
                        $('#essence').val(info.event._def.extendedProps.essence);
                        $('#peage').val(info.event._def.extendedProps.peage);
                        $('#parking').val(info.event._def.extendedProps.parking);
                        $('#divers').val(info.event._def.extendedProps.divers);
                        $('#repas').val(info.event._def.extendedProps.repas);
                        $('#hotel').val(info.event._def.extendedProps.hotel);
                        $('#kilometrage').val(info.event._def.extendedProps.kilometrage);
                        $('#description').val(info.event._def.extendedProps.description);
                        $('#heure_debut').val(info.event._def.extendedProps.heure_debut);
                        $('#heure_fin').val(info.event._def.extendedProps.heure_fin);

                        const id = info.event._def.publicId;

                        $("#validation").parent().append(
                            '<button class="inline-flex justify-end items-start bg-red-700 focus:bg-red-800 hover:bg-red-800 shadow-[0_2px_5px_0_rgba(0,0,0,0.2)] rounded-[2.5px] font-medium leading-[11.25px] overflow-hidden px-[15px] pb-[5px] pt-[6.25px] text-white" id="supprimer">SUPPRIMER</button>'
                        );

                        $('#validation').on('click', function() {

                            var startDate =
                                info.dateStr + " " +
                                $('#heure_debut').val();
                            var endDate =
                                info.dateStr + " " +
                                $('#heure_fin').val();


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
                            }
                            let check = @this.checkEvent(event);

                            $('div#error').remove(),


                                check.then((value) => {
                                    //console.log(value);
                                    if (value == null) {
                                        @this.eventChange(event, info.event.start)
                                    } else {
                                        value.forEach(element => {
                                            $("label[for='" + element + "']").parent()
                                                .append(
                                                    '<div class="text-[rgb(169,68,66)] text-[12px]" id="error">L\'entré n\'est pas correct</div>'
                                                );
                                        });
                                    };
                                });

                        });

                        $('#supprimer').on('click', function() {
                            @this.suppressEvent(id);
                        });

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
                    //eventDrop: info => @this.eventChange(info.event)
                });
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
