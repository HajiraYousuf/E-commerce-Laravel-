@php 
    $activities = [
        [
            'id' => 1,
            'type' => 'user',
            'icon' => 'user',
            'title' => 'New user registered',
            'description' => 'Ahmed created an account',
            'time' => '2 minutes ago',
            'color' => 'text-blue-500',
            'bgColor' => 'bg-blue-100 dark:bg-blue-900/30',
        ],
        [
            'id' => 2,
            'type' => 'order',
            'icon' => 'shopping-cart',
            'title' => 'New order received',
            'description' => 'Order #3847 for $2,399',
            'time' => '5 minutes ago',
            'color' => 'text-emerald-500',
            'bgColor' => 'bg-emerald-100 dark:bg-emerald-900/30',
        ],
        [
            'id' => 3,
            'type' => 'payment',
            'icon' => 'credit-card',
            'title' => 'Payment processed',
            'description' => 'Payment of $1,199 completed',
            'time' => '12 minutes ago',
            'color' => 'text-purple-500',
            'bgColor' => 'bg-purple-100 dark:bg-purple-900/30',
        ],
        [
            'id' => 4,
            'type' => 'system',
            'icon' => 'settings',
            'title' => 'System update',
            'description' => 'Database backup completed',
            'time' => '1 hour ago',
            'color' => 'text-orange-500',
            'bgColor' => 'bg-orange-100 dark:bg-orange-900/30',
        ],
        [
            'id' => 5,
            'type' => 'notification',
            'icon' => 'bell',
            'title' => 'Low stock alert',
            'description' => 'iPhone 15 Pro stock is low',
            'time' => '2 hours ago',
            'color' => 'text-red-500',
            'bgColor' => 'bg-red-100 dark:bg-red-900/30',
        ],
    ];

@endphp
<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-slate-200/50 dark:border-slate-700/50">

    {{-- Header --}}
    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between">

        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                Activity Feed
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Recent System Activities
            </p>
        </div>

        <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">
            View All
        </button>

    </div>

    {{-- Body --}}
    <div class="p-6">

        <div class="space-y-4">

            @foreach($activities as $activity)
                <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">

                    {{-- Icon --}}
                    <div class="p-2 rounded-lg {{ $activity['bgColor'] }}">
                        <i class="w-4 h-4 {{ $activity['color'] }}" data-lucide="{{ $activity['icon'] }}"></i>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">

                        <h4 class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $activity['title'] }}
                        </h4>

                        <p class="text-sm text-slate-600 dark:text-slate-400 truncate">
                            {{ $activity['description'] }}
                        </p>

                        <div class="flex items-center space-x-1 mt-1">
                            <i class="w-3 h-3 text-slate-400" data-lucide="clock"></i>
                            <span class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $activity['time'] }}
                            </span>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</div>