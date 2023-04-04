<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPrimary extends Model
{
    use HasFactory;
    protected $table = 'primary_categories';
    protected $fillable = [
        'name',
        'code',
        'order'
    ];
}
