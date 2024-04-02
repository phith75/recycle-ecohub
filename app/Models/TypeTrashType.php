<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeTrashType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trash_type_trash';

    protected $fillable = [
        'trash_id',
        'type_trash_id',
        'weightable',
    ];
}
