<?php

namespace App\Http\Controllers\Api;
use App\Event;
use App\Http\Controllers\Controller;

use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return Calendar::all();
    }

    public function show(Calendar $calendar)
    {
        $events = Event::where('calendar_id',$calendar->id)->get();
        return response()->json($events, 201);
    }

    public function store(Request $request)
    {
        $calendar = Calendar::create($request->all());

        return response()->json($calendar, 201);
    }

    public function update(Request $request, Calendar $calendar)
    {
        $calendar->update($request->all());

        return response()->json($calendar, 200);
    }

    public function delete(Calendar $calendar)
    {
        $calendar->delete();

        return response()->json(null, 204);
    }
}
