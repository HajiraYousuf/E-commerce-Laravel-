@php
    $calendarDays = range(1,31);

    $events = [
        [
            'day' => 4,
            'title' => 'Project Meeting',
            'time' => '10:00 AM',
            'color' => 'bg-violet-500',
        ],
        [
            'day' => 5,
            'title' => 'UI/UX Review',
            'time' => '01:00 PM',
            'color' => 'bg-green-500',
        ],
        [
            'day' => 8,
            'title' => 'Team Standup',
            'time' => '04:00 PM',
            'color' => 'bg-orange-400',
        ],
        [
            'day' => 15,
            'title' => 'Client Call',
            'time' => '11:00 AM',
            'color' => 'bg-pink-500',
        ],
        [
            'day' => 15,
            'title' => 'Design Review',
            'time' => '02:00 PM',
            'color' => 'bg-blue-500',
        ],
    ];

    // group events by day (VERY IMPORTANT)
    $groupedEvents = collect($events)->groupBy('day');
@endphp

<div class="bg-white dark:bg-[#0D1320] border border-gray-200 dark:border-white/10 rounded-3xl p-4 sm:p-5 transition-colors duration-300">

    {{-- TOP --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div class="flex items-center gap-3 flex-wrap">

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                Calendar
            </h1>

            <button class="px-4 py-2 rounded-xl text-sm 
                bg-gray-100 dark:bg-white/5 
                border border-gray-200 dark:border-white/10 
                text-gray-700 dark:text-white">
                Today
            </button>

            <div class="flex gap-2">

                <button class="w-10 h-10 rounded-xl 
                    bg-gray-100 dark:bg-white/5 
                    border border-gray-200 dark:border-white/10 
                    text-gray-700 dark:text-white">
                    ←
                </button>

                <button class="w-10 h-10 rounded-xl 
                    bg-gray-100 dark:bg-white/5 
                    border border-gray-200 dark:border-white/10 
                    text-gray-700 dark:text-white">
                    →
                </button>

            </div>

        </div>

        <button class="bg-violet-600 hover:bg-violet-700 text-white px-5 py-3 rounded-2xl font-medium transition w-full lg:w-auto">
            + Add Event
        </button>

    </div>

    {{-- MONTH --}}
    <div class="mb-5">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
            May 2025
        </h2>
    </div>

    {{-- DAYS --}}
    <div class="grid grid-cols-7 text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-4">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>

    {{-- CALENDAR GRID --}}
    <div class="grid grid-cols-7 gap-2 sm:gap-3">

    @foreach($calendarDays as $day)

        @php
            $dayEvents = $groupedEvents[$day] ?? [];
        @endphp

        <div class="aspect-square rounded-xl sm:rounded-2xl border 
            border-gray-200 dark:border-white/5 
            bg-gray-50 dark:bg-white/[0.02] 
            hover:bg-gray-100 dark:hover:bg-white/[0.05] 
            p-2 sm:p-3 relative transition overflow-hidden">

            {{-- DAY NUMBER --}}
            <div class="
                {{ $day == 15 ? 'bg-violet-600 text-white' : 'text-gray-700 dark:text-gray-200' }}
                w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs sm:text-sm font-medium
            ">
                {{ $day }}
            </div>

            {{-- EVENTS LIST (INSIDE DAY) --}}
            <div class="mt-2 space-y-1">

                @foreach($dayEvents as $event)
                    <div class="flex items-center gap-1">

                        <span class="w-2 h-2 rounded-full {{ $event['color'] }}"></span>

                        <p class="text-[10px] sm:text-xs text-gray-600 dark:text-gray-300 truncate">
                            {{ $event['title'] }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    @endforeach

</div>
</div>