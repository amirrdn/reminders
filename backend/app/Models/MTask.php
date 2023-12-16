<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTask extends Model
{
    use HasFactory;

    protected $table    = 'task';
    protected $fillabel = ['id', 'title', 'description', 'remind_at', 'event_at', 'created_at', 'updated_at'];
}
