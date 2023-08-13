<div x-data="{
    holidays: [],
    async getAllHolidays() {
        const data = await fetch('/api/holidays');
        const json = await data.json();
        this.holidays = json;
    },
    renderCalendar() {
        const calendar = new FullCalendar.Calendar($refs.calendar, {
            initialView: 'dayGridMonth',
            timezode: 'UTC',
            events: this.holidays,
            dateClick: function(info) {
                $wire.create(info.dateStr);
            },
            eventClick: function(info) {
                $wire.edit(info.event.id);
            }
        })
        calendar.render()
    }
}" x-init="await getAllHolidays()
renderCalendar()"
    x-on:new-holiday-added.window="await getAllHolidays();renderCalendar()">
    <div class="bg-white border p-4 rounded-lg">
        <div wire:ignore x-ref="calendar"></div>
    </div>
    <div>
        @include('includes.modals._holiday-create')
    </div>
    <div>
        @include('includes.modals._holiday-edit')
    </div>
</div>
