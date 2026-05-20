@php
    $sections = [
    [
        'key' => 'email',
        'title' => 'Email Notifications',
        'desc' => 'Receive important updates via email',
        'icon' => 'ri-mail-line',
        'color' => 'indigo',
        'items' => [
            [
                'key' => 'account_activity',
                'title' => 'Account Activity',
                'desc' => 'Login attempts and security updates',
            ],
            [
                'key' => 'new_orders',
                'title' => 'New Orders',
                'desc' => 'Get notified when new orders arrive',
            ],
            [
                'key' => 'messages',
                'title' => 'Messages',
                'desc' => 'Receive notifications for new messages',
            ],
        ]
    ]
];
@endphp
<form method="POST" action="{{ route('settings.notifications.update') }}">
@csrf

<div class="grid gap-6 lg:grid-cols-2">

@foreach($sections as $section)

@php
    $sectionKey = "notifications.{$section['key']}";
@endphp

<div class="rounded-[30px] border border-gray-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 p-6">

    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-6">

        <div class="h-14 w-14 rounded-2xl flex items-center justify-center
            bg-{{ $section['color'] }}-100 text-{{ $section['color'] }}-600
            dark:bg-{{ $section['color'] }}-500/10 dark:text-{{ $section['color'] }}-400">

            <i class="{{ $section['icon'] }} text-2xl"></i>
        </div>

        <div>
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                {{ $section['title'] }}
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                {{ $section['desc'] }}
            </p>
        </div>

    </div>

    {{-- ITEMS --}}
    <div class="space-y-4">

        @foreach($section['items'] as $item)

        @php
            $key = "notifications.{$section['key']}.{$item['key']}";
            $checked = isset($settings[$key]) && $settings[$key] == 1;
        @endphp

        <div class="flex items-center justify-between bg-white dark:bg-slate-950 border border-gray-200 dark:border-slate-800 p-4 rounded-2xl">

            <div>
                <h3 class="font-semibold text-slate-900 dark:text-white">
                    {{ $item['title'] }}
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    {{ $item['desc'] }}
                </p>
            </div>

            {{-- TOGGLE --}}
            <label class="relative inline-flex items-center cursor-pointer">

                <input type="checkbox"
                       name="settings[{{ $section['key'] }}][{{ $item['key'] }}]"
                       value="1"
                       class="sr-only peer"
                       {{ $checked ? 'checked' : '' }}>

                <div class="w-11 h-6 bg-gray-300 dark:bg-slate-700 rounded-full peer peer-checked:bg-indigo-600 relative transition">

                    <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-all peer-checked:translate-x-5"></div>

                </div>

            </label>

        </div>

        @endforeach

    </div>

</div>

@endforeach

</div>

{{-- SAVE BUTTON --}}
<div class="mt-6">
    <button type="submit"
        class="px-6 py-3 bg-indigo-600 text-white rounded-xl">
        Save Changes
    </button>
</div>

</form>