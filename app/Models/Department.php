<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;
    // specify data to consider
    protected $fillable = ['name'];
    
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
