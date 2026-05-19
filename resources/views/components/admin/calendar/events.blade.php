@php
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
    rounded-3xl p-4 sm:p-6 space-y-5 transition-colors duration-300">

    {{-- TITLE --}}
    <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            Thursday, May 15, 2025
        </h2>
    </div>

    {{-- EVENTS --}}
    @foreach($events as $event)

        <div class="flex flex-col md:flex-row justify-between md:items-center 
            border-b border-gray-200 dark:border-white/5 
            pb-5 gap-4 last:border-none last:pb-0">

            {{-- LEFT SIDE --}}
            <div class="flex gap-4 sm:gap-5">

                {{-- TIME --}}
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $event['start'] }}
                    </p>

                    <p class="text-sm text-gray-400 dark:text-gray-500">
                        {{ $event['end'] }}
                    </p>
                </div>

                {{-- EVENT INFO --}}
                <div class="flex gap-3 sm:gap-4">

                    <span class="w-3 h-3 rounded-full mt-2 {{ $event['color'] }}"></span>

                    <div>
                        <h3 class="font-semibold text-base sm:text-lg text-gray-900 dark:text-white">
                            {{ $event['title'] }}
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $event['desc'] }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center gap-2">

                {{-- JOIN BUTTON --}}
                <button class="px-4 sm:px-5 py-2 rounded-xl 
                    bg-gray-100 dark:bg-white/5 
                    border border-gray-200 dark:border-white/10 
                    hover:bg-gray-200 dark:hover:bg-white/10 
                    transition text-sm text-gray-700 dark:text-white w-full md:w-auto">
                    Join
                </button>

                {{-- MORE BUTTON --}}
                <button class="w-9 h-9 flex items-center justify-center rounded-xl 
                    bg-gray-100 dark:bg-white/5 
                    border border-gray-200 dark:border-white/10 
                    hover:bg-gray-200 dark:hover:bg-white/10 
                    transition text-lg text-gray-700 dark:text-white">
                    ⋯
                </button>

            </div>

        </div>

    @endforeach

</div>