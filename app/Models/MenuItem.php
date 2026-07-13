<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name', 'description', 'ingredients', 'price', 'weight', 'category', 'tag', 'image_url'];
}
