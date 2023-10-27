@props(['remarks' => ''])
<div x-data="{
    hoverCardHovered: false,
    hoverCardDelay: 600,
    hoverCardLeaveDelay: 500,
    hoverCardTimout: null,
    hoverCardLeaveTimeout: null,
    hoverCardEnter() {
        clearTimeout(this.hoverCardLeaveTimeout);
        if (this.hoverCardHovered) return;
        clearTimeout(this.hoverCardTimout);
        this.hoverCardTimout = setTimeout(() => {
            this.hoverCardHovered = true;
        }, this.hoverCardDelay);
    },
    hoverCardLeave() {
        clearTimeout(this.hoverCardTimout);
        if (!this.hoverCardHovered) return;
        clearTimeout(this.hoverCardLeaveTimeout);
        this.hoverCardLeaveTimeout = setTimeout(() => {
            this.hoverCardHovered = false;
        }, this.hoverCardLeaveDelay);
    }
}" class="relative" @mouseover="hoverCardEnter()" @mouseleave="hoverCardLeave()">
    {{ $slot }}
    <div x-show="hoverCardHovered"
        class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2" x-cloak>
        <div x-show="hoverCardHovered"
            class="w-[full] h-auto  border-indigo-500 bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border "
            x-transition>
            <div class="relative">
                <p class="mb-1 text-sm text-gray-600">{{ $remarks }}</p>
            </div>
        </div>
    </div>
</div>
