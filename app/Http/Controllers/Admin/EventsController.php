<?php

namespace App\Http\Controllers\Admin;

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
  
    //fonction  t'reje3 ga3 les events li mazalhom en attente f view t3ha
    public function index(Request $request)
    {
        //
        $pendingEvents = Event::where('status', Event::PENDING)->orderBy('created_at','desc')->get();

        return view('admin.events.pending',['events'=>$pendingEvents]);
    }

    //  DISCLAIMER : FONCTION create,store,edit,update,destroy , ignore them , ma7ebitch n'supprimihom just in case
    public function create(Request $request)
    {
        //
        return view('admin.events.add');
    }

    
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
         
        return redirect("/admin/events")->withSuccess('Great! Event added');

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
        ])->first();
        return view('admin.events.edit',['event'=>$event]);

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
        Event::where([
            'id'=>$id,
        ])->first()->update($data);

         
        return redirect("/admin/events")->withSuccess('Great! Event updated');
    }

      public function destroy($id)
    {
        //
        $event = Event::where(['id'=>$id])->first();

        if($event){
            $event->delete();
            return redirect("/admin/events")->withSuccess('Great! Event deleted');
        }
        return redirect("/admin/events")->withError('Error! Event not found');
    }
  
    //fonction li t'accepter un evenement
     public function accept($id)
    {
        //
        $event = Event::findOrFail($id);
        $event->update([
            'status'=> Event::ACCEPTED
        ]);
        return redirect("/admin/events")->withSuccess('Great! Event accepted');
    }

    //fonction li t'refuser un evenement
    public function deny($id)
    {
        //
        $event = Event::findOrFail($id);
        $event->update([
            'status'=> Event::REFUSED
        ]);
        return redirect("/admin/events")->withSuccess('Great! Event rejected');
    }
}
