<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'todo'
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
