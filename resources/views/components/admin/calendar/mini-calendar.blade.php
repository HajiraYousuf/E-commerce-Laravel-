@php
$calendarDays = range(1,31);

$events = [
    [
        'title' => 'Project Meeting',
        'desc' => 'Discuss project roadmap and milestones',
        'start' => '10:00 AM',
        'end' => '11:00 AM',
        'color' => 'bg-violet-500',
    ],
    [
        'title' => 'UI/UX Review',
        'desc' => 'Review new designs and prototypes',
        'start' => '01:00 PM',
        'end' => '02:30 PM',
        'color' => 'bg-green-500',
    ],
    [
        'title' => 'Team Standup',
        'desc' => 'Daily update and tasks',
        'start' => '04:00 PM',
        'end' => '04:30 PM',
        'color' => 'bg-orange-400',
    ],
];
@endphp


<div class="bg-white dark:bg-[#0D1320] border border-gray-200 dark:border-white/10 
    rounded-3xl p-4 sm:p-5 h-full space-y-6 transition-colors duration-300">

    {{-- MINI CALENDAR --}}
    <div class="border border-gray-200 dark:border-white/10 rounded-2xl p-4 
        bg-gray-50 dark:bg-white/[0.02]">

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                May 2025
            </h3>

            <span class="text-xs text-gray-500 dark:text-gray-400">
                Month View
            </span>

        </div>

        {{-- WEEK DAYS --}}
        <div class="grid grid-cols-7 text-center text-[11px] 
            text-gray-500 dark:text-gray-400 mb-3">
            <div>Su</div>
            <div>Mo</div>
            <div>Tu</div>
            <div>We</div>
            <div>Th</div>
            <div>Fr</div>
            <div>Sa</div>
        </div>

        {{-- DAYS --}}
        <div class="grid grid-cols-7 gap-y-2 text-sm text-center">

            @foreach($calendarDays as $day)

                <div class="flex justify-center">

                    <div class="
                        w-8 h-8 flex items-center justify-center rounded-full
                        transition cursor-pointer

                        hover:bg-gray-200 dark:hover:bg-white/10

                        {{ $day == 15 
                            ? 'bg-violet-600 text-white shadow-md' 
                            : 'text-gray-700 dark:text-gray-300' 
                        }}
                    ">
                        {{ $day }}
                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- EVENTS --}}
    <div>

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Events
            </h3>

            <button class="text-violet-500 hover:text-violet-600 text-sm transition">
                View all
            </button>

        </div>

        <div class="space-y-5">

            @foreach($events as $event)

                <div class="flex items-start gap-4 group">

                    {{-- DOT --}}
                    <span class="w-3 h-3 rounded-full mt-2 {{ $event['color'] }}"></span>

                    {{-- CONTENT --}}
                    <div class="flex-1">

                        <h4 class="font-medium text-gray-900 dark:text-white group-hover:text-violet-400 transition">
                            {{ $event['title'] }}
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $event['start'] }} - {{ $event['end'] }}
                        </p>

                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            {{ $event['desc'] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>