<x-layouts.app>
{{-- MAIN WRAPPER --}}
<div class="min-h-screen text-gray-900 dark:text-white transition-colors duration-300 p-4 lg:p-6">

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">

        {{-- LEFT SIDE --}}
        <div class="xl:col-span-8 space-y-5">

            {{-- CALENDAR --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
                <x-admin.calendar.main-calendar :date="$date" :calendarDays="$calendarDays" :groupedEvents="$groupedEvents" :events="$events" :selectedDay="$selectedDay ?? now()->day"
 />            </div>


        </div>

        {{-- RIGHT SIDE --}}
        <div class="xl:col-span-4">

            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
                <x-admin.calendar.mini-calendar :date="$date" :events="$events" :calendarDays="$calendarDays" :selectedDay="$selectedDay ?? now()->day"/>
            </div>

        </div>

    </div>

</div>

</x-layouts.app>