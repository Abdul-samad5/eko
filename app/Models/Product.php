<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
   {
       return $this->belongsTo(Category::class, 'cate_id', 'id');
   } 

   public function user()
   {
       return $this->belongsTo(User::class, 'user_id', 'id');
   } 
}
