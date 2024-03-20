<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeTrash extends Model
{   
    use HasFactory, SoftDeletes;

    protected $table = 'time_trash';

    protected $fillable = [
        'id',
        'date',
        'id_trash',
    ];
}