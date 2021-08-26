<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'description', 'price', 'sub_category_id', 'created_at'];

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }
}
