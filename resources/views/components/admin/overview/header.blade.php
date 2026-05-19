<div class="flex items-center justify-between gap-6">

    <!-- LEFT SIDE -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white tracking-tight">
            Analytics Overview
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Track revenue, orders, and product trends across your electronics store
        </p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center gap-3">
  
        <!-- DATE RANGE -->
        <div id="dateButton"
            class="flex items-center gap-3 px-4 py-2 rounded-xl border
            bg-white/80 backdrop-blur text-gray-900 border-gray-200
            hover:bg-white transition
            dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer shadow-sm">

            <i data-lucide="calendar" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>

            <span id="dateText" class="text-sm font-medium">
                Jan 05, 2024 → Jan 05, 2025
            </span>
        </div>

        <!-- FILTER -->
        <button
            class="px-4 py-2 rounded-xl border text-sm font-medium
            bg-white/80 backdrop-blur text-gray-900 border-gray-200
            hover:bg-white transition
            dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 shadow-sm">
            Filter
        </button>

        <!-- EXPORT -->
        <button
            class="px-4 py-2 rounded-xl text-sm font-medium
            bg-gradient-to-r from-indigo-500 to-violet-600 text-white
            hover:opacity-90 transition shadow-md">
            Export
        </button>

    </div>
</div>
<!-- Hidden input -->
<input type="text" id="hiddenDate" class="hidden">

<!-- Lucide -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
lucide.createIcons();

const fp = flatpickr("#hiddenDate", {
    mode: "range",
    dateFormat: "M d, Y",
    defaultDate: ["2024-01-05", "2025-01-05"],

    showMonths: 2,
    static: true,

    allowInput: false,
    monthSelectorType: "dropdown",
    yearSelectorType: "dropdown",

    onReady: function(_, __, instance) {
        instance.calendarContainer.classList.add("custom-calendar");
    },

    onChange: function(selectedDates) {
        if (selectedDates.length === 2) {
            const f = fp.formatDate;

            document.getElementById("dateText").innerText =
                f(selectedDates[0], "M d, Y") + " → " +
                f(selectedDates[1], "M d, Y");
        }
    }
});

document.getElementById("dateButton").addEventListener("click", () => {
    fp.open();
});
</script>

<style>
/* =========================
   CALENDAR BASE STYLE
========================= */
.custom-calendar {
    border-radius: 20px !important;
    overflow: hidden !important;

    background: rgba(255, 255, 255, 0.85) !important;
    backdrop-filter: blur(18px) !important;

    box-shadow: 0 25px 60px rgba(0,0,0,0.18) !important;
    border: 1px solid rgba(255,255,255,0.4) !important;

    font-family: Inter, sans-serif !important;
    color: #111827 !important;
}

/* DARK MODE */
.dark .custom-calendar {
    background: rgba(10, 18, 40, 0.85) !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    color: #f9fafb !important;
}

/* HEADER */
.custom-calendar .flatpickr-months {
    padding: 16px 14px !important;
    background: transparent !important;
}

/* MONTH + YEAR */
.custom-calendar .flatpickr-current-month,
.custom-calendar .cur-month,
.custom-calendar .cur-year {
    color: inherit !important;
    font-weight: 600 !important;
}

/* WEEKDAYS */
.custom-calendar .flatpickr-weekday {
    color: inherit !important;
    opacity: 0.6;
    font-size: 12px !important;
}

/* DAYS */
.custom-calendar .flatpickr-day {
    border-radius: 14px !important;
    height: 42px !important;
    line-height: 42px !important;

    font-weight: 500 !important;
    color: inherit !important;

    transition: all 0.2s ease !important;
}

/* HOVER */
.custom-calendar .flatpickr-day:hover {
    background: rgba(99, 102, 241, 0.15) !important;
    transform: scale(1.05);
}

/* SELECTED RANGE */
.custom-calendar .flatpickr-day.selected,
.custom-calendar .flatpickr-day.startRange,
.custom-calendar .flatpickr-day.endRange {
    background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
    color: white !important;
    box-shadow: 0 8px 20px rgba(99,102,241,0.35) !important;
}

/* RANGE */
.custom-calendar .flatpickr-day.inRange {
    background: rgba(99,102,241,0.12) !important;
}

/* TODAY */
.custom-calendar .flatpickr-day.today {
    border: 2px solid #6366f1 !important;
}

/* ARROWS */
.custom-calendar .flatpickr-prev-month,
.custom-calendar .flatpickr-next-month {
    fill: #6b7280 !important;
    transition: 0.2s ease;
}

.custom-calendar .flatpickr-prev-month:hover,
.custom-calendar .flatpickr-next-month:hover {
    fill: #6366f1 !important;
    transform: scale(1.2);
}

/* BUTTON HOVER */
#dateButton {
    transition: all 0.2s ease;
}

#dateButton:hover {
    box-shadow: 0 10px 25px rgba(99,102,241,0.2);
    transform: translateY(-1px);
}

/* DATE TEXT */
#dateText {
    color: #111827;
}

.dark #dateText {
    color: #f9fafb !important;
}
/* ===== MONTH + YEAR DARK MODE FIX (MINIMAL) ===== */

.dark .custom-calendar .cur-month,
.dark .custom-calendar .flatpickr-current-month {
    color: #f9fafb !important;
}

.dark .custom-calendar .numInputWrapper input {
    color: #f9fafb !important;
    -webkit-text-fill-color: #f9fafb !important;
}
</style>