@props(['start' => '00:00:00'])

<div x-data="{
    start: '{{ $start }}',
    hrs: 0,
    mins: 0,
    secs: 0,
}" x-init="let [startHrs, startMins, startSecs] = start.split(':').map(Number);
secs = startSecs;
mins = startMins;
hrs = startHrs;
setInterval(() => {
    if (secs == 59) {
        secs = 0;
        if (mins == 59) {
            mins = 0;
            hrs++;
        } else {
            mins++;
        }
    } else {
        secs++;
    }
}, 1000);">
    <span
        x-text="`${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`">
    </span>
</div>
