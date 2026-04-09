<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'title', 'description'];
    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function members(){
        return $this->belongsToMany(User::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }

}
