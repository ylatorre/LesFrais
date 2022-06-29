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
                    initialView: 'dayGridMonth',
                    dateClick: function() {
                        $('#event').modal('toggle')

                    },

                    eventClick: function(info) {
                        // alert('Event: ' + info.event.start);
                        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        // alert('View: ' + info.view.type);

                        // change the border color just for fun
                        $('#eventClicked').modal('toggle')
                        info.el.style.borderColor = 'red';
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




                        let i = 0

                        // console.log($("#client").val())
                        // let descriptionVal =  document.getElementById("descriptionArea").value

                        // console.log($("#Validation").on('click'));
                        $("#Validation").on('click', function() {
                            const id = create_UUID();
                            let descriptionVal = $("textarea#description").val();
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
                            console.log(descriptionVal, "description")
                            console.log(clientVal, "client")
                            console.log({{ Auth::user()->id }})
                            calendar.addEvent({
                                id: id,
                                start: start,
                                end: end,
                                allDay: allDays,
                                description: descriptionVal,
                                title: clientVal,
                                ville: villeVal,
                                code_postal: code_postalVal,
                                peage: peageVal,
                                parking: parkingVal,
                                divers: diversVal,
                                repas: repasVal,
                                hotel: hotelVal,
                                kilometrage: kilometrageVal,
                                idUser: {{ Auth::user()->id }}
                            });
                            console.log(start)
                            // return calendar
                            // let eventAdd = {calendar}
                            // console.log(start.start,"test54")
                            @this.eventAdd({
                                id: id,
                                start: start.start,
                                end: start.end,
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


                            })
                            calendar.unselect();

                        });

                        // calendar.unselect();
                    },



                });
                calendar.render();
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>
