<?php

namespace App\Http\Controllers\Api;
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
        return $calendar;
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
