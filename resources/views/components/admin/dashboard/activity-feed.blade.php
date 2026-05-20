<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl border">

    {{-- Header --}}
    <div class="p-6 border-b flex justify-between items-center">

        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                Activity Feed
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Recent System Activities
            </p>
        </div>

    </div>

    {{-- Body --}}
    <div class="p-6 space-y-4">

        @forelse($activities as $activity)

            <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50">

                {{-- ICON (simple fallback) --}}
                <div class="p-2 rounded bg-slate-100 dark:bg-slate-800">
                    <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i>
                </div>

                {{-- CONTENT --}}
                <div class="flex-1 min-w-0">

                    <h4 class="text-sm font-semibold text-slate-800 dark:text-white">
                        {{ $activity->action }}
                    </h4>

                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        {{ $activity->module }}
                    </p>

                    <div class="flex items-center space-x-1 mt-1">
                        <i class="w-3 h-3 text-slate-400" data-lucide="clock"></i>
                        <span class="text-xs text-slate-500 dark:text-slate-400">
                            {{ $activity->created_at->diffForHumans() }}
                        </span>
                    </div>

                </div>

            </div>

        @empty

            <p class="text-sm text-gray-500">No activities yet</p>

        @endforelse

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
});
</script>