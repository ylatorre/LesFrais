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
            document.addEventListener('livewire:load', function() {
                        const Calendar = FullCalendar.Calendar;
                        const calendarEl = document.getElementById('calendar');
                        const calendar = new Calendar(calendarEl, {
                                locale: '{{ config('app.locale') }}',

                                selectable: true,
                                selectHelper: true,
                                select: function(start, end, allDays) {
                                    $('#event').modal('toggle')

                                }}); calendar.render();

                        });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>
