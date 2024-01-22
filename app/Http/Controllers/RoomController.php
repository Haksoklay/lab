<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    //

    public function index(){
        $rooms=Room::get();
        return inertia('Room/Index',[
            'rooms'=>$rooms
        ]);
    }

    public function create(){
        return inertia('Room/Create');
    }

    public function store(Request $request,$id=null){
       $request->validate([
        'name'=>'required|unique:rooms,name',
        'description'=>'nullable',
        'capacity'=>'required|integer',
        'status'=>'required|in:active,maintenance',
       ]);
       $roomId=$request->input('name');
        Room::create([
            'room_id'=>$roomId,
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'capacity'=>$request->input('capacity'),
            'status'=>$request->input('status'),
            'user_id'=>1,
        ]);
        return redirect()->back();
    }
}
