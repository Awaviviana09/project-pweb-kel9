<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UserTask;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    public function index(){
        Session::put('maxTaskInput', 40);
        $credentials = [
            "id"=>auth()->user()->id,
            "username"=>auth()->user()->username,
            "email"=>auth()->user()->email,            
        ];
        
        // dd(UserTask::all());

        Return Inertia::render("Home", [
            'credentials'=>$credentials,
            'data'=>UserTask::where('user_id', auth()->user()->id)->get(),
            'maxTaskInput'=>Session::get('maxTaskInput'),
            // 'data'=>0,
        ]);
    }

    public function storeTask(Request $request){
        // dd($request);
        $request->validate([
            'task_description'=> 'required|max:'.Session::get('maxTaskInput'),
        ]);

        // dd($request);
        
        UserTask::create([
            'user_id'=>auth()->user()->id,
            'category'=> $request->category,
            'task_description' => $request->task_description,
        ]);
        
        return redirect(route('index'))->with('success_add','Successfully add data!');
    }

    public function destroyTask(Request $request){
        UserTask::where('id', $request->id)->delete();
    }

    public function editTask(UserTask $userTask, Request $id){
        // dd($id);
        return Inertia::render('EditTask', [
            'data' => $userTask->find($id),
            'maxTaskInput'=>Session::get('maxTaskInput'),
        ]);
    }

    public function updateTask(Request $request){

        $request->validate([
            'task_description'=> 'required|max:'.Session::get('maxTaskInput'),
        ]);

        UserTask::where('id', $request->id)->update([
            'task_description'=> $request->task_description,
            'category'=> $request->category,
        ]);

        return to_route('index');

    }

}
