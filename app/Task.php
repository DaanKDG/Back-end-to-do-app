<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    
    protected $fillable = ['title','description', 'end-date'];
    protected $dates    = ['end_date', 'deleted_at'];

    use SoftDeletes;
   
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeInCompleted($query) {

        $query->where('completed', 0)->latest();
   }

   public function scopeCompleted($query) {

        $query->where('completed', 1)->latest();
   }

}
    

