<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Http\Request;
use App\Http\Resources\EventsResource;
use Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function construct()
    {   
        // dd($request);
        // if($request)
        return EventsResource::collection(Events::select()->where('user_id',Auth::id())->get());
        
    }

    public function index()
    {   
        return EventsResource::collection(Events::all());
        
    }

    public function events($userid)
    {
        return Events::select()->where('user_id',$userid)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Auth::id());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $event = new Events;
        $user=auth()->id();

        // dd($user);
        $event->user_id=Auth::id();
        $event->event_name=$data['name'];
        $event->date=$data['date'];
        $event->event_description=$data['text'];
        $event->slot=$data['choice'];
        $event->save();
        // dd();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {   
        $events=new Events;
        $events->find($event_id)->delete();
    }
}
