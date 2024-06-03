<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Bus;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'department_id',
        'performed_by',
        'title',
        'description',
        'priority',
        'start_date',
        'end_date',
        'progress',
        'result',
        'file',
        'status',
    ];
    // a task can be related to many users
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    // a task is created by one user
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'parent_id');
    }
    //  a task can be related to many departments
    public function departments():BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

}
