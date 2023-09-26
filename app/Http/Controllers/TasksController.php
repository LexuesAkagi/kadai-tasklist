<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $data = [];
            $user = \Auth::user();
            $tasks = $user->tasks;
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                ];
            
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
    }

    public function create()
    {
        $task = new Task;
        
        return view('tasks.create',[
            'task' => $task,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
            ]);
            
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id){
            return view('tasks.show',[
            'task' => $task,
            ]);
        }
        return redirect()->route('welcome');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        if(\Auth::id() === $task->user_id){
        return view('tasks.edit',[
            'task' => $task,
            ]);
        }
        return redirect()->route('welcome');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id){
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('tasks.index');
        }
        return redirect()->route('welcome');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id){
            $task->delete();
            return redirect()->route('tasks.index');
        }
        return back()
            ->with('Delete Failed');
    }
}
