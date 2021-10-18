<?php



namespace App\Http\Controllers;

use App\Models\Event;

use Illuminate\Http\Request;

use App\Models\User;

//use App\Models\Event;

class EventController extends Controller
{
    public function index(){

        $search = request('search');

       if($search):
            $events = Event::where([
                ['name','like', '%'.$search.'%']
            ])->get();
       else:
        $events = Event::all();
       endif;

        
        return view('welcome',['events'=>$events,'search'=>$search]);
    }

    public function goToEvent(){
        return view('events.create');
    }

    public function store(Request $request){
        $events = new Event();
        $events->name = $request->name;
        $events->city = $request->city;
        $events->private = $request->private;
        $events->description = $request->description;
        $events->items = $request->items;
        $events->date = $request->date;

        
        


        //UPLOAD DE ARQUIVOS

        if($request->hasFile('image') && $request->file('image')->isValid()):
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path("/img/events"),$imageName);

            $events->image = $imageName;
        endif;

        $user = auth()->user();

        $events->user_id = $user->id;

        $events->save();

        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id){

        $event = Event::findOrFail($id);
        
        $user = auth()->user();

        $alreadyInEvent = false;

        if($user):
            $userEvents = $user->participants->toArray();
            foreach($userEvents as $userEvent):
                if($userEvent['id'] == $id):
                    $alreadyInEvent = true;
                endif;
            endforeach;
        endif;


        return view('events.show',['event' => $event,'user'=>$user,'alreadyInEvent' => $alreadyInEvent]);
    
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;

        $participants = $user->participants;

        return view('events.dashboard',['events' =>$events,'participants' => $participants]);
    }

    public function destroy($id){

        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg2','Evento Excluido com sucesso');
    }

    public function edit($id){

        $event =  Event::findOrFail($id);
        $user = auth()->user();
        if($user->id != $event->user->id):
            return redirect('/dashboard');
        else:
            return view('events.edit',['event' => $event]);
        endif;
        
    }

    public function update(Request $request){

        $data  = $request->all();

        //VERIFICAÇÃO DE IMAGEM

        if($request->hasFile('image') && $request->file('image')->isValid()):
            $requestImage = $request->image;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path('/img/events'),$imageName);

            $data['image'] = $imageName;
        endif;
        
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard');
    }

    public function joinEvent($id){
    
        $user = auth()->user();   
        
        $user->participants()->attach($id);

        return redirect('/dashboard');
    }

    public function leaveEvent($id){
        $user = auth()->user();

        $user->participants()->detach($id);

        return redirect('/dashboard');
    }

}