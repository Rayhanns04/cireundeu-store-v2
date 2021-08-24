<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storefront extends Model
{
    use HasFactory;

    public function subCategories() {
        return $this->belongsToMany(SubCategory::all());
    }
}
