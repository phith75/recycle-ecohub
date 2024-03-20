<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trash extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trash';

    protected $fillable = [
        'name',
        'location',
        'status',
    ];

}
