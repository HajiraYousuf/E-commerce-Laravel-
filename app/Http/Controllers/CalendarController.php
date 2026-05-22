<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->month
            ? Carbon::parse($request->month . '-01')
            : Carbon::now();

        $selectedDay = $request->day ?? Carbon::now()->day;

        $daysInMonth = $date->daysInMonth;
        $calendarDays = range(1, $daysInMonth);

        // ALL MONTH EVENTS
        $events = Event::whereMonth('date', $date->month)
            ->whereYear('date', $date->year)
            ->get();

        // GROUP EVENTS
        $groupedEvents = $events->groupBy(function ($event) {
            return Carbon::parse($event->date)->day;
        });

        // SELECTED DAY EVENTS (IMPORTANT)
        $selectedEvents = $groupedEvents[$selectedDay] ?? collect();

        return view('admin.calendar.calendar', compact(
            'date',
            'calendarDays',
            'events',
            'groupedEvents',
            'selectedEvents',
            'selectedDay'
        ));
    }
      public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'color'=> 'nullable'
        ]);

        Event::create([
                'title' => $request->title,
                'date' => $request->date,
                'color' => $request->color,
            ]);
        return back()->with('success', 'Event created successfully');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted');
    }
}