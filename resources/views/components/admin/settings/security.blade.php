{{-- resources/views/components/admin/settings/security.blade.php --}}

<div class="space-y-6">

    {{-- PASSWORD SETTINGS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        {{-- HEADER --}}
        <div class="mb-8">

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Security Settings
            </h2>

            <p class="text-gray-500 dark:text-slate-400 mt-1">
                Manage your password and account security
            </p>

        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="mb-6 p-4 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">

                {{ session('success') }}

            </div>

        @endif

        {{-- FORM --}}
        <form
            action="{{ route('settings.password') }}"
            method="POST"
            class="space-y-6"
        >

            @csrf

            {{-- CURRENT PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Current Password
                </label>

                <div class="relative">

                    <input
                        id="currentPassword"
                        type="password"
                        name="current_password"
                        placeholder="Enter current password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('currentPassword', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300"
                    >

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

                @error('current_password')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- NEW PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    New Password
                </label>

                <div class="relative">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter new password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300"
                    >

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

                @error('password')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- CONFIRM PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Confirm Password
                </label>

                <div class="relative">

                    <input
                        id="confirmPassword"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('confirmPassword', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300"
                    >

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

            </div>

            {{-- PASSWORD STRENGTH --}}
            <div>

                <div class="flex items-center justify-between mb-2">

                    <span class="text-sm font-medium text-gray-700 dark:text-slate-300">
                        Password Strength
                    </span>

                    <span
                        id="strengthText"
                        class="text-sm font-semibold text-gray-500"
                    >
                        Weak
                    </span>

                </div>

                <div class="w-full h-2 rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">

                    <div
                        id="strengthBar"
                        class="h-full w-[10%] bg-red-500 transition-all duration-300 rounded-full"
                    ></div>

                </div>

                {{-- RULES --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">

                    <div
                        id="ruleLength"
                        class="flex items-center gap-2 text-sm text-gray-400"
                    >
                        <i class="ri-close-line"></i>
                        8+ Characters
                    </div>

                    <div
                        id="ruleUpper"
                        class="flex items-center gap-2 text-sm text-gray-400"
                    >
                        <i class="ri-close-line"></i>
                        Uppercase
                    </div>

                    <div
                        id="ruleNumber"
                        class="flex items-center gap-2 text-sm text-gray-400"
                    >
                        <i class="ri-close-line"></i>
                        Number
                    </div>

                    <div
                        id="ruleSymbol"
                        class="flex items-center gap-2 text-sm text-gray-400"
                    >
                        <i class="ri-close-line"></i>
                        Symbol
                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end pt-2">

                <button
                    type="submit"
                    class="px-8 h-12 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition text-white font-medium shadow-lg shadow-indigo-500/20"
                >

                    Update Password

                </button>

            </div>

        </form>

    </div>

</div>

{{-- SCRIPT --}}
<script>

    // TOGGLE PASSWORD
    function togglePassword(id, button)
    {
        const input = document.getElementById(id);
        const icon = button.querySelector('i');

        if(input.type === 'password')
        {
            input.type = 'text';

            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        }
        else
        {
            input.type = 'password';

            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }
    }

    // PASSWORD STRENGTH
    const password = document.getElementById('password');

    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    const ruleLength = document.getElementById('ruleLength');
    const ruleUpper = document.getElementById('ruleUpper');
    const ruleNumber = document.getElementById('ruleNumber');
    const ruleSymbol = document.getElementById('ruleSymbol');

    password.addEventListener('input', () => {

        let value = password.value;

        let strength = 0;

        // LENGTH
        if(value.length >= 8)
        {
            strength++;
            activateRule(ruleLength);
        }
        else
        {
            deactivateRule(ruleLength);
        }

        // UPPERCASE
        if(/[A-Z]/.test(value))
        {
            strength++;
            activateRule(ruleUpper);
        }
        else
        {
            deactivateRule(ruleUpper);
        }

        // NUMBER
        if(/[0-9]/.test(value))
        {
            strength++;
            activateRule(ruleNumber);
        }
        else
        {
            deactivateRule(ruleNumber);
        }

        // SYMBOL
        if(/[^A-Za-z0-9]/.test(value))
        {
            strength++;
            activateRule(ruleSymbol);
        }
        else
        {
            deactivateRule(ruleSymbol);
        }

        // LEVELS
        if(strength <= 1)
        {
            strengthBar.style.width = '25%';
            strengthBar.className = 'h-full bg-red-500 transition-all duration-300 rounded-full';

            strengthText.innerText = 'Weak';
            strengthText.className = 'text-sm font-semibold text-red-500';
        }

        else if(strength == 2)
        {
            strengthBar.style.width = '50%';
            strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300 rounded-full';

            strengthText.innerText = 'Medium';
            strengthText.className = 'text-sm font-semibold text-yellow-500';
        }

        else if(strength == 3)
        {
            strengthBar.style.width = '75%';
            strengthBar.className = 'h-full bg-blue-500 transition-all duration-300 rounded-full';

            strengthText.innerText = 'Good';
            strengthText.className = 'text-sm font-semibold text-blue-500';
        }

        else
        {
            strengthBar.style.width = '100%';
            strengthBar.className = 'h-full bg-emerald-500 transition-all duration-300 rounded-full';

            strengthText.innerText = 'Strong';
            strengthText.className = 'text-sm font-semibold text-emerald-500';
        }

    });

    function activateRule(element)
    {
        element.classList.remove('text-gray-400');
        element.classList.add('text-emerald-600');

        element.querySelector('i').className = 'ri-check-line';
    }

    function deactivateRule(element)
    {
        element.classList.remove('text-emerald-600');
        element.classList.add('text-gray-400');

        element.querySelector('i').className = 'ri-close-line';
    }

</script>