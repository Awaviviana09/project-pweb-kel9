<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_description',
        'category',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
