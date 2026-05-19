@php

$sections = [

    [
        'title' => 'Email Notifications',
        'desc' => 'Receive important updates via email',
        'icon' => 'ri-mail-line',
        'color' => 'indigo',
        'items' => [
            [
                'title' => 'Account Activity',
                'desc' => 'Login attempts and security updates',
                'enabled' => true,
            ],
            [
                'title' => 'New Orders',
                'desc' => 'Get notified when new orders arrive',
                'enabled' => true,
            ],
            [
                'title' => 'Messages',
                'desc' => 'Receive notifications for new messages',
                'enabled' => false,
            ],
        ]
    ],

    [
        'title' => 'Push Notifications',
        'desc' => 'Browser and mobile push alerts',
        'icon' => 'ri-notification-3-line',
        'color' => 'emerald',
        'items' => [
            [
                'title' => 'Live Sales Alerts',
                'desc' => 'Instant notifications for every sale',
                'enabled' => true,
            ],
            [
                'title' => 'Inventory Alerts',
                'desc' => 'Low stock and inventory warnings',
                'enabled' => true,
            ],
            [
                'title' => 'Weekly Reports',
                'desc' => 'Weekly analytics and business reports',
                'enabled' => false,
            ],
        ]
    ]

];

@endphp
<div class="rounded-[32px] border border-gray-200 dark:border-slate-800
    bg-white dark:bg-slate-950 p-5 md:p-8 space-y-8 overflow-hidden">
{{-- HEADER --}}
<div class="relative overflow-hidden rounded-[28px]
    bg-white text-slate-900
    dark:bg-gradient-to-br dark:from-slate-900 dark:via-slate-950 dark:to-black
    dark:text-white
    border border-slate-200 dark:border-slate-800
    p-6 md:p-8">

    {{-- Glow Background (dark only) --}}
    <div class="absolute inset-0 hidden dark:block
        bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,.18),transparent_35%)]">
    </div>

    <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        {{-- LEFT --}}
        <div>

            {{-- Badge --}}
            <div class="mb-4 inline-flex items-center gap-2 rounded-full
                border border-slate-200 bg-slate-100 text-slate-700
                dark:border-white/10 dark:bg-white/5 dark:text-slate-300
                px-4 py-2">

                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                <span class="text-sm font-medium">
                    Smart Notification Center
                </span>

            </div>

            {{-- Title --}}
            <h1 class="text-3xl md:text-4xl font-black tracking-tight">
                Notification Settings
            </h1>

            {{-- Description --}}
            <p class="mt-3 max-w-2xl text-sm md:text-base
                text-slate-600 dark:text-slate-400 leading-relaxed">
                Customize alerts, activity updates and communication preferences.
            </p>

        </div>

        {{-- STATUS CARD --}}
        <div class="rounded-3xl border border-slate-200 bg-slate-50
            dark:border-white/10 dark:bg-white/5
            p-5 backdrop-blur-xl w-full lg:w-auto">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                    bg-emerald-100 text-emerald-600
                    dark:bg-emerald-500/15 dark:text-emerald-400">

                    <i class="ri-shield-check-line text-2xl"></i>

                </div>

                <div>

                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Status
                    </p>

                    <h3 class="mt-1 text-lg font-bold">
                        All Active
                    </h3>

                </div>

            </div>

        </div>

    </div>

</div>


    {{-- SECTIONS --}}
    <div class="grid gap-6 lg:grid-cols-2">

        @foreach($sections as $section)

        <div class="relative overflow-hidden rounded-[30px]
            border border-gray-200 dark:border-slate-800
            bg-gray-50 dark:bg-slate-900
            p-6">

            {{-- GLOW --}}
            <div class="absolute right-0 top-0 h-40 w-40 rounded-full
                bg-{{ $section['color'] }}-500/10 blur-3xl">
            </div>



            {{-- HEADER --}}
            <div class="relative z-10 flex items-center gap-4">

                <div class="flex h-16 w-16 items-center justify-center rounded-3xl
                    bg-{{ $section['color'] }}-100
                    text-{{ $section['color'] }}-600
                    dark:bg-{{ $section['color'] }}-500/10
                    dark:text-{{ $section['color'] }}-400">

                    <i class="{{ $section['icon'] }} text-3xl"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                        {{ $section['title'] }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ $section['desc'] }}
                    </p>

                </div>

            </div>



            {{-- ITEMS --}}
            <div class="relative z-10 mt-8 space-y-4">

                @foreach($section['items'] as $item)

                <div class="flex items-center justify-between gap-4
                    rounded-2xl border border-gray-200 dark:border-slate-800
                    bg-white dark:bg-slate-950 p-5">

                    <div class="flex-1">

                        <h3 class="font-semibold text-slate-900 dark:text-white">
                            {{ $item['title'] }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ $item['desc'] }}
                        </p>

                    </div>



                    {{-- TOGGLE --}}
                    <label class="relative inline-flex cursor-pointer items-center">

                        <input
                            type="checkbox"
                            class="peer sr-only"
                            {{ $item['enabled'] ? 'checked' : '' }}
                        >

                        <div class="h-8 w-14 rounded-full
                            bg-slate-300 dark:bg-slate-700
                            peer-checked:bg-{{ $section['color'] }}-600

                            after:absolute
                            after:left-1
                            after:top-1
                            after:h-6
                            after:w-6
                            after:rounded-full
                            after:bg-white
                            after:transition-all
                            peer-checked:after:translate-x-6">
                        </div>

                    </label>

                </div>

                @endforeach

            </div>

        </div>

        @endforeach

    </div>



    {{-- FOOTER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                Ready to apply changes?
            </h3>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Your notification preferences will update instantly.
            </p>

        </div>



        <div class="flex items-center gap-4">

            <button class="h-12 rounded-2xl border border-gray-300
                dark:border-slate-700 px-6 font-medium
                text-slate-700 dark:text-slate-300
                hover:bg-gray-100 dark:hover:bg-slate-800 transition">

                Cancel

            </button>



            <button class="rounded-2xl bg-gradient-to-r
                from-indigo-600 to-violet-600
                px-8 py-3 font-semibold text-white
                shadow-xl shadow-indigo-500/20
                hover:scale-[1.02] transition">

                <span class="flex items-center gap-2">

                    <i class="ri-save-line text-lg"></i>

                    Save Changes

                </span>

            </button>

        </div>

    </div>

</div>