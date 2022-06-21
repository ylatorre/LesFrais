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
                        const boutonVal = document.getElementById('Validation');
                        boutonVal.addEventlistener('onclick',()=> {
                            calendar.addEvent({
                                id: id,
                                start: start,
                                end: end,
                                allDay: allDays,
                                description: arg.description,
                                client: client,
                                ville: arg.ville,
                                code_postal: arg.code_postal,
                                peage: arg.peage,
                                parking: arg.parking,
                                divers: arg.divers,
                                repas: arg.repas,
                                hotel: arg.hotel,
                                kilometrage: arg.kilometrage,
                            });

                        @this.eventAdd(calendar.getEventById(id));
                        })


                        calendar.unselect();
                    },



                });
                calendar.render();
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>



