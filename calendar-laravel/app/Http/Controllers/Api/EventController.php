<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**Get all events
     * @return Event[]|\Illuminate\Database\Eloquent\Collection
     * @author Marcin Topolski
     * @version 1.0
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Get the event
     * @param Event $event
     * @return Event
     * @author Marcin Topolski
     * @version 1.0
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Create the event
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    /**
     * Update the event
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @author Marcin Topolski
     * @version 1.0
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return response()->json($event, 200);
    }

    /**
     * Remove the event
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @author Marcin Topolski
     * @version 1.0
     */
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
        return  response()->json($events, 200);
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
        return response()->json($events, 200);
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
            ->orderBy('start','desc')->get();
        return response()->json($events, 200);
    }


}
