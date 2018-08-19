<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Task;
use App\Comment;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       $user = Auth::user();

       if ($request->is('tasks')) {

              $user->load(['comments', 'tasks' => function ($query) { $query->InCompleted(); }]);
       } 
       elseif ($request->is('archive')) {

              $user->load(['comments', 'tasks' => function ($query) { $query->Completed(); }]);
       }

       Carbon::setLocale('nl');
       setlocale(LC_TIME, 'Dutch');
       $dateToday = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

       return view('layouts.index', compact('user', 'request', 'dateToday'));

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
         $this ->validate($request, ['title' => 'required|max:25','description' => 'required|max:60', 'end_date' => 'required|date_format:Y-m-d', 'time' => 'required|date_format:H:i']);

         $requestData = $request->all(); 
         $task = new Task($requestData);
         // merge date and time to create datetime obkect in UTC
         $inputDateAndTime = $requestData['end_date'].' '.$requestData['time'].':00';
         $task['end_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $inputDateAndTime, 'Europe/Brussels')->timezone('UTC');
         $task['user_id'] = auth()->id();
         $task['completed'] = 0;
         $task->save();


         return redirect('/tasks')->with('success', 'To-do aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
      Carbon::setLocale('nl');
      setlocale(LC_TIME, 'Dutch');
      $dateToday = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

      return view('layouts.show', compact('task', 'dateToday'));
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
        if($request->has(['title', 'description', 'end_date','time'])) {
            
            $this ->validate($request, ['title' => 'required|max:25', 'description' => 'required|max:60', 'end_date' => 'required|date_format:Y-m-d', 'time' => 'required|date_format:H:i']);
            $requestData = $request->all(); 

            $task['title'] = $requestData['title'];
            $task['description'] = $requestData['description'];

            $dateTime = $requestData['end_date'].' '.$requestData['time'].':00';
            $task['end_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, 'Europe/Brussels')->timezone('UTC');
            
            $task->save();
            
            return redirect('/tasks')->with('success', 'Task bijgewerkt');

        } else {
            
           $task['completed'] = 1;
           $task->save();
           
           return redirect('/tasks')->with('success', 'To-do voltooid');
         }

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

         return back()->with('success', 'To-do verwijderd');
    }


}
