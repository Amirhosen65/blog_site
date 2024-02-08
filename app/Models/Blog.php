<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [' '];

    // blog and user table relation
    public function RelationUser(){
        return $this->hasOne(User::class,'id','user_id');
    }

    // blog and category table relation
    public function RelationCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    // relation with tags
    public function ManyRelationTags(){
        return $this->belongsToMany(Tag::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($blog) {
    //         $blog->slug = Str::slug($blog->title);
    //     });
    // }

}
