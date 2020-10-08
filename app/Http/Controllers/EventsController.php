<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function store(Event $event)
    {
        request()->validate([
            'event_name' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'selected_days' => 'required',
        ]);

        $dates = CarbonPeriod::create(request()->start_date, request()->end_date);
        foreach($dates as $date){
            // foreach(request()->selected_days as $day){
                if (in_array(Carbon::parse($date)->format('l'), request()->selected_days)) {

                // if(Carbon::parse($date)->isDayOfWeek($day)&& ){
                    Event::updateOrCreate(
                        ['date' => $date],
                        ['name' => request()->event_name, 'date' => $date]
                    );
                }else{
                    Event::whereDate('date',$date)->delete();
                }
            // }
        // $event = Event::whereDate('date',$date)->first();
        // $events->whereNotIn(Carbon::parse($date)->format('l'),request()->selected_days)
        // ->delete();

        }


        return response()->json([
            'status' => 'success',
            'message' => 'Event Successfully added.'
        ]);

    }

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Event Successfully added.',
            'data' => Event::all('name','date')
        ]);
    }

    public function update(Event $event)
    {
        $event->saveEvent();
    }

}
