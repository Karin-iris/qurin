<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method find($id)
 * @method where(string $string, $id)
 * @method select(string[] $array)
 */
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'secondary_id',
        'order'
    ];

}
