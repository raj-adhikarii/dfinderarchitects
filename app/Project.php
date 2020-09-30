<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','desc','thumbnail','info','cate_id'];
    protected $guarded = [];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'cate_id');
    }

    public function galleries(){
        return $this->hasMany(Gallery::class, 'project_id', 'id');
    }
}
