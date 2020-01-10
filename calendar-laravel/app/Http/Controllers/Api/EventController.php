<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return response()->json($event, 200);
    }

    public function delete(Event $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }

    public function getByCalendar($calendar)
    {
        return Event::where('calendar_id',$calendar)->get();
    }

    public function getLast($calendar,$amount)
    {
        return Event::where('calendar_id',$calendar)->take($amount)->orderBy('id','desc')->get();
    }
}
