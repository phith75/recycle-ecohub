<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TypeTrash extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'type_trash';

    protected $fillable = [
        'id',
        'name',
        'weight',
        'weightable',
        'id_trash',
    ];
}