<div class="space-y-6">

    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Appearance Settings
            </h2>

            <p class="text-gray-500 dark:text-slate-400 mt-1">
                Customize your dashboard appearance and experience
            </p>
        </div>

        @php
            $theme = $settings['theme'] ?? 'light';
        @endphp

        <form method="POST" action="{{ route('settings.update') }}">
            @csrf

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">
                Theme Mode
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- LIGHT --}}
                <label class="cursor-pointer" data-theme="light">

                    <input type="radio"
                           name="settings[theme]"
                           value="light"
                           onclick="setTheme('light')"
                           class="hidden"
                           {{ $theme == 'light' ? 'checked' : '' }}>

                    <div class="theme-card border-2 rounded-3xl p-4 transition
                        {{ $theme == 'light' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-500/10' : 'border-gray-200 dark:border-slate-700' }}">

                        <div class="h-36 rounded-2xl bg-white border mb-4"></div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Light Mode
                        </h4>

                    </div>
                </label>

                {{-- DARK --}}
                <label class="cursor-pointer" data-theme="dark">

                    <input type="radio"
                           name="settings[theme]"
                           value="dark"
                           onclick="setTheme('dark')"
                           class="hidden"
                           {{ $theme == 'dark' ? 'checked' : '' }}>

                    <div class="theme-card border-2 rounded-3xl p-4 transition
                        {{ $theme == 'dark' ? 'border-indigo-500 bg-slate-900/20' : 'border-gray-200 dark:border-slate-700' }}">

                        <div class="h-36 rounded-2xl bg-slate-900 border mb-4"></div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Dark Mode
                        </h4>

                    </div>
                </label>

                {{-- SYSTEM --}}
                <label class="cursor-pointer" data-theme="system">

                    <input type="radio"
                           name="settings[theme]"
                           value="system"
                           onclick="setTheme('system')"
                           class="hidden"
                           {{ $theme == 'system' ? 'checked' : '' }}>

                    <div class="theme-card border-2 rounded-3xl p-4 transition
                        {{ $theme == 'system' ? 'border-indigo-500 bg-gray-100 dark:bg-slate-800/30' : 'border-gray-200 dark:border-slate-700' }}">

                        <div class="h-36 rounded-2xl flex">
                            <div class="w-1/2 bg-white"></div>
                            <div class="w-1/2 bg-slate-900"></div>
                        </div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            System
                        </h4>

                    </div>
                </label>

            </div>

            <div class="mt-6">
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl">
                    Save Changes
                </button>
            </div>

        </form>

    </div>

</div>
<script>
    function setTheme(theme) {
        const html = document.documentElement;

        if (theme === 'dark') {
            html.classList.add('dark');
        } 
        else if (theme === 'light') {
            html.classList.remove('dark');
        } 
        else {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        }

        localStorage.setItem('theme', theme);

        updateActive(theme);
    }

    function updateActive(theme) {
        document.querySelectorAll('[data-theme]').forEach(card => {

            const type = card.getAttribute('data-theme');
            const box = card.querySelector('.theme-card');

            if (type === theme) {
                box.classList.add('border-indigo-500');
                box.classList.remove('border-gray-200', 'dark:border-slate-700');
            } else {
                box.classList.remove('border-indigo-500');
                box.classList.add('border-gray-200', 'dark:border-slate-700');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const saved = localStorage.getItem('theme') || 'light';
        setTheme(saved);
    });

    window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', () => {
        const theme = localStorage.getItem('theme');
        if (theme === 'system') {
            setTheme('system');
        }
    });
</script>