<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySecondary extends Model
{
    use HasFactory;
    protected $table = 'secondary_categories';
    protected $fillable = [
        'name',
        'code',
        'primary_id',
        'order'
    ];
}
