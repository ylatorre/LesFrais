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
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    locale: '{{ config('app.locale') }}',
                    events: JSON.parse(@this.events),
                    editable: true,
                    eventResize: info => @this.eventChange(info.event),
                    eventDrop: info => @this.eventChange(info.event),

                    selectable: true,


                    select: function(start, end, allDays) {
                        const id = create_UUID();
                        $('#event').modal('toggle')



                        let i = 0

                        // console.log($("#client").val())
                        let description = $("#description").val();
                        let client = $("#client").val();
                        let ville = $("#ville").val();
                        let code_postal = $("#code_postal").val();
                        let peage = $("#peage").val();
                        let parking = $("#parking").val();
                        let divers = $("#divers").val();
                        let repas = $("#repas").val();
                        let hotel = $("#hotel").val();
                        let kilometrage = $("#kilometrage").val();
                        // console.log($("#Validation").on('click'));
                        $("#Validation").on('click', function() {
                            let i = 50
                            calendar.addEvent({
                                id: id,
                                start: start,
                                end: end,
                                allDay: allDays,
                                description: description,
                                client: client,
                                ville: ville,
                                code_postal: code_postal,
                                peage: peage,
                                parking: parking,
                                divers: divers,
                                repas: repas,
                                hotel: hotel,
                                kilometrage: kilometrage,
                            });

                            @this.eventAdd(calendar.getEventById(id));
                            calendar.unselect();

                        });

                        if ( i == 50) {
                            // console.log($("#Validation").on('click'))
                            // calendar.addEvent({
                            //     id: id,
                            //     start: start,
                            //     end: end,
                            //     allDay: allDays,
                            //     description: description,
                            //     client: client,
                            //     ville: ville,
                            //     code_postal: code_postal,
                            //     peage: peage,
                            //     parking: parking,
                            //     divers: divers,
                            //     repas: repas,
                            //     hotel: hotel,
                            //     kilometrage: kilometrage,
                            // });

                            // @this.eventAdd(calendar.getEventById(id));
                            console.log("test")

                        }
                        calendar.unselect();
                    },



                });
                calendar.render();
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>
