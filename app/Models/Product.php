<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query ,array $filters)
    {
        // Filter According To Name Search
        $query->when($filters['search'] ?? false , function ($query , $search) {
            $query->where('name' ,'like' , '%'.$search.'%');
        } );
    }
}
