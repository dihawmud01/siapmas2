import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import idLocale from '@fullcalendar/core/locales/id'; // Import bahasa Indonesia

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        var calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: 'id', // Set ke bahasa Indonesia
            events: function(fetchInfo, successCallback, failureCallback) {
                Promise.all([
                    fetch('/agenda/events').then(res => res.json()),
                    fetch('/hbn/events').then(res => res.json())
                ]).then(data => {
                    let [agendaEvents, hbnEvents] = data;
                    successCallback([...agendaEvents, ...hbnEvents]);
                }).catch(error => {
                    console.error("Gagal memuat data:", error);
                    failureCallback(error);
                });
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title + '\nTanggal: ' + info.event.start.toLocaleString());
            },
        });
        calendar.render(); // Render kalender pertama kali

        // Panggil updateSize saat jendela di-resize untuk responsifitas
        window.addEventListener('resize', function() {
            calendar.updateSize();
        });
    }
});