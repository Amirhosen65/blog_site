<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [' '];

    public function RelationWithBlog(){
        return $this->hasOne(Blog::class, 'category_id','id');
    }

}


