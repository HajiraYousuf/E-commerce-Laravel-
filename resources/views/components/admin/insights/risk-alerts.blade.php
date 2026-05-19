@php
$alerts = [
[
'title' => 'Refund Rate',
'desc' => 'Refunds increased by 12%',
'icon' => 'ri-error-warning-line',
'color' => 'red'
],

[
'title' => 'Low Stock',
'desc' => '12 items running low',
'icon' => 'ri-alarm-warning-line',
'color' => 'orange'
],

[
'title' => 'Payment Failures',
'desc' => '4.8% failed transactions',
'icon' => 'ri-close-circle-line',
'color' => 'pink'
],

[
'title' => 'High Traffic Spike',
'desc' => 'Unusual traffic detected on store',
'icon' => 'ri-bar-chart-line',
'color' => 'blue'
],
[
    'title' => 'Server Downtime',
    'desc' => 'Backend API response delay detected',
    'icon' => 'ri-server-line',
    'color' => 'purple'
],

];
@endphp

<div class="bg-white dark:bg-gray-900 rounded-3xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm h-full flex flex-col transition-colors duration-300">

    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-5">
        Risk Alerts
    </h2>

    <div class="space-y-4 flex-1 overflow-auto">

        @foreach($alerts as $alert)

        <div class="p-4 rounded-2xl border border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition">

            <div class="flex items-start justify-between gap-4">

                <div class="flex gap-3">

                    <div class="w-10 h-10 rounded-xl bg-{{ $alert['color'] }}-100 dark:bg-{{ $alert['color'] }}-500/15 flex items-center justify-center">
                        <i class="{{ $alert['icon'] }} text-{{ $alert['color'] }}-600 dark:text-{{ $alert['color'] }}-400"></i>
                    </div>

                    <div>
                        <h4 class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                            {{ $alert['title'] }}
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $alert['desc'] }}
                        </p>
                    </div>

                </div>

                <button class="text-xs px-3 py-1.5 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg whitespace-nowrap">
                    View
                </button>

            </div>

        </div>

        @endforeach

    </div>

</div>