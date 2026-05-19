<x-layouts.app>

@php
    $tab = request('tab','profile');
@endphp

<div class="flex gap-6">

    {{-- SIDEBAR --}}
    <aside class="w-72 shrink-0">

        <div class="sticky top-6">

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 px-2">
                Settings
            </h2>

            <div class="space-y-1">

                {{-- PROFILE --}}
                <a href="?tab=profile"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                   {{ $tab == 'profile'
                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                        : 'text-gray-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800'
                   }}">

                    <i class="ri-user-line text-lg"></i>

                    <span>Profile</span>

                </a>



                {{-- SECURITY --}}
                <a href="?tab=security"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                   {{ $tab == 'security'
                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                        : 'text-gray-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800'
                   }}">

                    <i class="ri-lock-line text-lg"></i>

                    <span>Security</span>

                </a>



                {{-- APPEARANCE --}}
                <a href="?tab=appearance"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                   {{ $tab == 'appearance'
                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                        : 'text-gray-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800'
                   }}">

                    <i class="ri-palette-line text-lg"></i>

                    <span>Appearance</span>

                </a>



                {{-- NOTIFICATION --}}
                <a href="?tab=notification"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
                   {{ $tab == 'notification'
                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-medium'
                        : 'text-gray-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800'
                   }}">

                    <i class="ri-notification-3-line text-lg"></i>

                    <span>Notification</span>

                </a>

            </div>

        </div>

    </aside>



    {{-- CONTENT --}}
    <main class="flex-1">

        @if($tab == 'profile')

            <x-admin.settings.profile />

        @elseif($tab == 'security')

            <x-admin.settings.security />

        @elseif($tab == 'appearance')

            <x-admin.settings.appearance />

        @elseif($tab == 'notification')

            <x-admin.settings.notification />

        @endif

    </main>

</div>

</x-layouts.app>