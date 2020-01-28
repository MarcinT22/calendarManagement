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

    /**Get the calendar with events
     * @param Calendar $calendar
     * @return \Illuminate\Http\JsonResponse.
     * Return data with calendar and events.
     * @author Marcin Topolski
     * @version 1.0
     */
    public function show(Calendar $calendar)
    {
        $calendar = Calendar::find($calendar->id);
        $events = $calendar->events;
        return response()->json($events, 200);
    }

    /**
     * Create the calendar
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function store(Request $request)
    {
        $calendar = Calendar::create($request->all());

        return response()->json($calendar, 201);
    }

    /**
     * Update the calendar
     * @param Request $request
     * @param Calendar $calendar
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function update(Request $request, Calendar $calendar)
    {
        $calendar->update($request->all());

        return response()->json($calendar, 200);
    }

    /**
     * Remove the calendar
     * @param Calendar $calendar
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @author Marcin Topolski
     * @version 1.0
     */
    public function delete(Calendar $calendar)
    {
        $calendar->delete();

        return response()->json(null, 204);
    }
}
