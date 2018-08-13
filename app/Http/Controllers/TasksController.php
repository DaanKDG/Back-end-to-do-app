<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Comment;
use App\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = User::where('id',Auth()->id())->with(['tasks' => function ($query) {
            $query->latest();
        }])->first();

        $comments = Task::where('user_id',Auth()->id())->with(['comments' => function ($query) {
            $query->latest();
        }])->first();

   
      return view('layouts.index', compact('user', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request, ['title' => 'required','description' => 'required']);

        $task = new Task;
        $task -> title = $request->input('title');
        $task -> description = $request->input('description');
        $task -> completed = 0;
        $task -> user_id = auth()->id();
        $task->save();

        return redirect('/tasks')->with('success', 'Task created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
       return view('layouts.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('layouts.edit', compact('task')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this ->validate($request, ['title' => 'required','description' => 'required']);

        $task -> title = $request->input('title');
        $task -> description = $request->input('description');
        $task -> completed = 0;
        $task->save();

        return redirect('/tasks')->with('success', 'Task edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        foreach($task->comments as $comment) 
        { 
            $comment->delete(); 
        }
        
        $task->delete();

        return redirect('/tasks')->with('success', 'Task removed');
    }
}
