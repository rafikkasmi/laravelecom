<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Event;

class EventsController extends Controller
{
 

   public function index()
    {
        $events = Event::where(['status'=>Event::ACCEPTED])->orderBy('created_at', 'DESC')->paginate(10);
        return view('events.index',['events'=>$events]);
    }
    
    public function like(Request $request,$id)
    {
        $event = Event::find($id);
        $like=$event->likes()->where('user_id',auth()->user()->id);
        if($like->exists()){
            $like->delete();
            return false;
        }else{
        $event->likes()->create(['user_id'=>$request->user()->id]);
        return true;
        }
    
    }

    public function comment(Request $request,$id)
    {
        $request->validate([
            'content'=>'required',
        ]);
        $event = Event::find($id);
        if(!$event){
            return false;
        }
        $event->comments()->create([
            'content'=>$request->content,
            'user_id'=>$request->user()->id
        ]);
        return true;
    }
    
 
}
