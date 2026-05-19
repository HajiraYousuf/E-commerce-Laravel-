<x-layouts.app>
{{-- MAIN WRAPPER --}}
<div class="min-h-screen text-gray-900 dark:text-white transition-colors duration-300 p-4 lg:p-6">

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">

        {{-- LEFT SIDE --}}
        <div class="xl:col-span-8 space-y-5">

            {{-- CALENDAR --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
                <x-admin.calendar.main-calendar :calendarDays="$calendarDays" />
            </div>

            {{-- EVENTS --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
                <x-admin.calendar.events :events="$events" />
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="xl:col-span-4">

            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
                <x-admin.calendar.mini-calendar 
                    :calendarDays="$calendarDays"
                    :events="$events"
                />
            </div>

        </div>

    </div>

</div>

</x-layouts.app>