<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{

    public function index()
    {
        return Task::all();
    }

    public function get_task($id)
    {
        return Task::find($id);
    }

       
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Task::create($request->all());

        return Task::all();
    }

    

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $task->update($request->all());
        return Task::all();
        
    }

    public function delete(Task $task)
    {
        $task->delete();
        return Task::all();
       
    }
}
