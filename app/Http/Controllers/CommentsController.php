<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
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

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this ->validate($request, ['body' => 'required|max:30']);

        Comment::create([ 'body' => request('body') , 'task_id' => $id, 'user_id' => auth()->id() ]);

        return back()->with('success', 'Comment toegevoegd');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
       // return view('comments.show', compact('comment')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, Comment $comment)
    {
        return view('comments.edit', compact('comment', 'task')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Comment $comment)
    {      
            $this ->validate($request, ['body' => 'required|max:30']);
            $requestData = $request->all(); 

            $comment['body'] = $requestData['body'];
            $comment->save();

            return redirect('tasks')->with('success', 'Comment aangepast');

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task , Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment verwijderd');
    }
}
