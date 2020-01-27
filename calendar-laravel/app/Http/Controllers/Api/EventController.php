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

    /**Get events by calendar
     * @param $calendar
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function getByCalendar($calendar)
    {
        $events = Event::where('calendar_id',$calendar)->get();
        return  response()->json($events);
    }

    /**
     * Get last events
     * @param $calendar
     * @param $amount
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function getLast($calendar,$amount)
    {
        $events = Event::where('calendar_id',$calendar)->take($amount)->orderBy('id','desc')->get();
        return response()->json($events);
    }

    /**
     * Get upcoming events
     * @param $calendar
     * @param $amount
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function getUpcoming($calendar,$amount)
    {
        $events = Event::
        where('calendar_id',$calendar)
            ->where('start','>',now())
            ->take($amount)
            ->orderBy('id','desc')->get();
        return response()->json($events);
    }


}
