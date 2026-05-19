<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <header class="border-b border-slate-200 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl">
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
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;

    // Load theme
    const theme = localStorage.getItem("theme");

    if (theme === "dark") {
        html.classList.add("dark");
    } else {
        html.classList.remove("dark");
    }

    initIcons();
    updateIcon();

    // Toggle button
    const btn = document.getElementById("themeToggle");

    if (btn) {
        btn.addEventListener("click", () => {
            html.classList.toggle("dark");

            localStorage.setItem(
                "theme",
                html.classList.contains("dark") ? "dark" : "light"
            );

            updateIcon();
        });
    }
});

// ICONS
function initIcons() {
    if (window.lucide) {
        lucide.createIcons();
    }
}

// UPDATE ICON
function updateIcon() {
    const icon = document.getElementById("themeIcon");

    if (!icon) return;

    const isDark = document.documentElement.classList.contains("dark");

    icon.setAttribute("data-lucide", isDark ? "moon" : "sun");

    lucide.createIcons();
}    
    </script>


</body>
</html>