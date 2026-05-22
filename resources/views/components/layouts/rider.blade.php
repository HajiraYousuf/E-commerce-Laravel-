<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Dashboard</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script>
        // DARK MODE INIT
        if (
            localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark')
        }

        function toggleTheme() {
            document.documentElement.classList.toggle('dark')
            localStorage.setItem(
                'theme',
                document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            )
        }

        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden')
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900 dark:bg-slate-800 dark:text-white transition-colors duration-300">

    <!-- HEADER -->
    <header class="sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800 bg-white/70 dark:bg-slate-900/60 backdrop-blur">

        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- LOGO -->
            <h1 class="font-bold text-xl">🚴 Rider Panel</h1>


            <!-- ACTIONS -->
            <div class="flex items-center gap-3">

                <!-- DARK MODE -->
                <button
                    onclick="toggleTheme()"
                    class="px-3 py-2 rounded-xl bg-gray-200 dark:bg-gray-800 hover:scale-105 transition">
                    🌓
                </button>


            </div>

        </div>


    </header>

    <!-- CONTENT -->
    <main class="max-w-6xl mx-auto p-6">
        {{ $slot }}
    </main>

</body>
</html>