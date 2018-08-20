<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    protected $fillable = ['body', 'task_id', 'user_id', 'completed'];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    } 

    public function task()
    {
        return $this->belongsTo('App\Task');
    } 

    
}
