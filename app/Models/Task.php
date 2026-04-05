<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'project_id',
        'title',
        'notes',
        'status',
        'last_updated_by'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function editor(){
        return $this->belongsTo(User::class, 'last_updated_by');
    }
}
