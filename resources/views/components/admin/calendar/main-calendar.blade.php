@props(['calendarDays', 'groupedEvents', 'events', 'date', 'selectedDay'])

@php
    use Carbon\Carbon;

    $monthName = $date->format('F Y');
    $prevMonth = $date->copy()->subMonth()->format('Y-m');
    $nextMonth = $date->copy()->addMonth()->format('Y-m');

    $today = now()->day;
    $selected = request('day', $today);

    $formattedDate = Carbon::create(
        $date->year,
        $date->month,
        $selected
    )->format('l, F d, Y');
@endphp

<div class="space-y-6">

    {{-- CALENDAR --}}
    <div class="bg-white dark:bg-[#0D1320] border border-gray-200 dark:border-white/10 rounded-3xl p-5 transition">

        {{-- TOP BAR --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Calendar
                </h1>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manage your events and schedule
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">

                {{-- PREV --}}
                <a href="{{ route('admin.calendar', ['month' => $prevMonth]) }}"
                   class="w-11 h-11 flex items-center justify-center rounded-2xl
                   bg-gray-100 dark:bg-white/5
                   hover:bg-gray-200 dark:hover:bg-white/10
                   transition text-gray-700 dark:text-white">

                    ←
                </a>

                {{-- TODAY --}}
                <a href="{{ route('admin.calendar') }}"
                   class="px-5 h-11 flex items-center justify-center rounded-2xl
                   bg-violet-600 text-white font-medium
                   hover:bg-violet-700 transition">

                    Today
                </a>

                {{-- NEXT --}}
                <a href="{{ route('admin.calendar', ['month' => $nextMonth]) }}"
                   class="w-11 h-11 flex items-center justify-center rounded-2xl
                   bg-gray-100 dark:bg-white/5
                   hover:bg-gray-200 dark:hover:bg-white/10
                   transition text-gray-700 dark:text-white">

                    →
                </a>

                {{-- ADD EVENT --}}
                <div class="w-full lg:w-auto">
    <form method="POST" action="{{ route('admin.events.store') }}"
        class="flex flex-col lg:flex-row items-stretch lg:items-center gap-2">

        @csrf

        {{-- TITLE --}}
        <input type="text" name="title" placeholder="Event title"
            class="w-full lg:w-40 px-3 py-2 rounded-xl
            border border-gray-200 dark:border-white/10
            bg-white dark:bg-white/[0.03]
            text-gray-900 dark:text-white
            placeholder-gray-400 dark:placeholder-gray-500
            focus:outline-none focus:ring-2 focus:ring-violet-500 text-sm">

        {{-- DATE --}}
        <input type="date" name="date"
            class="w-full lg:w-40 px-3 py-2 rounded-xl
            border border-gray-200 dark:border-white/10
            bg-white dark:bg-white/[0.03]
            text-gray-900 dark:text-white
            focus:outline-none focus:ring-2 focus:ring-violet-500 text-sm">

        {{-- COLOR --}}
        <input type="color" name="color"
            class="w-12 h-10 rounded-xl border border-gray-200 dark:border-white/10 bg-transparent">

        {{-- BUTTON --}}
        <button type="submit"
            class="px-5 py-2.5 rounded-xl
            bg-violet-600 hover:bg-violet-700
            text-white font-medium text-sm
            transition shadow-md shadow-violet-500/20">

            + Add
        </button>

    </form>
</div>
            </div>

        </div>

        {{-- MONTH --}}
        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $monthName }}
            </h2>

            <div class="hidden md:flex items-center gap-4 text-sm">

                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-violet-500"></span>
                    <span class="text-gray-500 dark:text-gray-400">Selected</span>
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    <span class="text-gray-500 dark:text-gray-400">Today</span>
                </div>

            </div>

        </div>

        {{-- WEEK DAYS --}}
        <div class="grid grid-cols-7 mb-3">

            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $weekDay)

                <div class="text-center text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 py-2">
                    {{ $weekDay }}
                </div>

            @endforeach

        </div>

        {{-- CALENDAR GRID --}}
<div class="grid grid-cols-7 gap-2 sm:gap-3">

    @foreach($calendarDays as $day)

        @php
            $dayEvents = $groupedEvents[$day] ?? collect();

            $isToday = $day == $today;
            $isSelected = $day == $selected;
        @endphp

        <a href="{{ route('admin.calendar', [
            'month' => $date->format('Y-m'),
            'day' => $day
        ]) }}"

           class="group relative aspect-square rounded-3xl border overflow-hidden
           bg-white dark:bg-white/[0.02]
           border-gray-200 dark:border-white/5
           hover:border-violet-300 dark:hover:border-violet-500/30
           hover:shadow-lg hover:shadow-violet-500/5
           transition-all duration-300 p-2 sm:p-3">

            {{-- TOP --}}
            <div class="flex items-start justify-between mb-3">

                {{-- DAY NUMBER --}}
                <div class="w-10 h-10 flex items-center justify-center rounded-2xl text-sm font-bold transition-all duration-300

                    {{ $isSelected
                        ? 'bg-violet-600 text-white shadow-lg shadow-violet-500/30'
                        : ($isToday
                            ? 'bg-green-500 text-white shadow-lg shadow-green-500/20'
                            : 'bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-white group-hover:bg-violet-50 dark:group-hover:bg-violet-500/10')
                    }}">

                    {{ $day }}

                </div>

                {{-- EVENT COUNT --}}
                @if(count($dayEvents))
                    <div class="min-w-[24px] h-6 px-2 rounded-full
                        flex items-center justify-center
                        bg-gray-100 dark:bg-white/5
                        text-[10px] font-semibold
                        text-gray-600 dark:text-gray-300">

                        {{ count($dayEvents) }}

                    </div>
                @endif

            </div>

            {{-- EVENTS --}}
            <div class="space-y-1.5">

                @foreach($dayEvents->take(3) as $event)

                    <div class="flex items-center gap-2">

                        <span class="w-2 h-2 rounded-full"
                            style="background-color: {{ $event->color }}">
                        </span>
                        <p class="text-[10px] sm:text-xs truncate
                            text-gray-600 dark:text-gray-300
                            group-hover:text-gray-900 dark:group-hover:text-white
                            transition">

                            {{ $event->title }}

                        </p>

                    </div>

                @endforeach

                {{-- MORE --}}
                @if(count($dayEvents) > 3)

                    <p class="text-[10px] text-violet-500 font-medium pt-1">
                        +{{ count($dayEvents) - 3 }} more
                    </p>

                @endif

            </div>

            {{-- SELECTED BORDER EFFECT --}}
            @if($isSelected)

                <div class="absolute inset-0 rounded-3xl ring-2 ring-violet-500/20 pointer-events-none"></div>

            @endif

        </a>

    @endforeach

</div>
    </div>

    {{-- EVENTS SECTION --}}
    <div class="bg-white dark:bg-[#0D1320]
        border border-gray-200 dark:border-white/10
        rounded-3xl p-5 sm:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $formattedDate }}
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ count($events) }} event(s) scheduled
                </p>

            </div>

        </div>

        {{-- EVENTS --}}
        <div class="space-y-4">

            @forelse($events as $event)

                <div
                    class="group relative overflow-hidden rounded-2xl border border-gray-200 dark:border-white/5
                    bg-gray-50 dark:bg-white/[0.02]
                    hover:bg-gray-100 dark:hover:bg-white/[0.04]
                    transition-all duration-300 p-5">

                    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5">

                        {{-- LEFT --}}
                        <div class="flex gap-4">

                            {{-- TIME --}}
                            <div
                                class="min-w-[70px] text-center rounded-2xl p-3
                                bg-white dark:bg-white/[0.03]
                                border border-gray-200 dark:border-white/5">

                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $event->start }}
                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $event->end }}
                                </p>

                            </div>

                            {{-- INFO --}}
                            <div class="flex gap-4">

                                <span class="w-3 h-3 rounded-full mt-2 shrink-0 {{ $event->color }}"></span>

                                <div>

                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $event->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                                        {{ $event->desc }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- ACTIONS --}}
                        <div class="flex items-center gap-2">

                            <button
                                class="px-5 py-2.5 rounded-xl bg-violet-600 text-white hover:bg-violet-700 transition text-sm font-medium">
                                Join
                            </button>

                            <button
                                class="w-11 h-11 flex items-center justify-center rounded-xl
                                bg-white dark:bg-white/[0.03]
                                border border-gray-200 dark:border-white/10
                                hover:bg-gray-100 dark:hover:bg-white/[0.08]
                                transition text-gray-700 dark:text-white">

                                ⋯

                            </button>

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div
                    class="rounded-3xl border border-dashed border-gray-300 dark:border-white/10
                    p-12 text-center">

                    <div
                        class="w-16 h-16 mx-auto rounded-2xl
                        bg-gray-100 dark:bg-white/5
                        flex items-center justify-center text-2xl mb-4">

                        📅

                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        No Events
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        There are no scheduled events for this day.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>