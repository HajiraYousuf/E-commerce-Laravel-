<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 
dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 transition-all duration-500">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 flex-shrink-0">
        <x-admin.sidebar />
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <header class="h-16 border-b border-slate-200 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl">
            <x-admin.header />
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto">
            <div class="p-6 space-y-6">

                {{ $slot }}

            </div>
        </main>

    </div>
</div>

@stack('scripts')

</body>
</html>