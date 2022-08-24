<?php

namespace App\Http\Controllers\It;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $events = Event::where([
            'it_id'=>auth()->user()->id
        ])->get();

        return view('it.events.index',['events'=>$events]);
    }

    public function create(Request $request)
    {
        //
        return view('it.events.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'       => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        $data = $request->all();
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
        $data['image'] = '/storage/' . $filePath;
        $data['it_id']=$request->user()->id;
        Event::create($data);
         
        return redirect("/it/events")->withSuccess('Great! Event added');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $event = Event::where([
            'id'=>$id,
            'it_id'=>auth()->user()->id
        ])->first();
        return view('it.events.edit',['event'=>$event]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       
        $request->validate([
            'name'       => 'required',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        $data['it_id']=$request->user()->id;

        Event::where([
            'id'=>$id,
            'it_id'=>auth()->user()->id
        ])->first()->update($data);

         
        return redirect("/it/events")->withSuccess('Great! Event updated');
    }

      public function destroy($id)
    {
        //
        $event = Event::where(['id'=>$id,'it_id'=>auth()->user()->id])->first();

        if($event){
            $event->delete();
            return redirect("/it/events")->withSuccess('Great! Event deleted');
        }
        return redirect("/it/events")->withError('Error! Event not found');
    }
  
}
