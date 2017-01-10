<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
	protected $fillable = ['name', 'category_id', 'user_id', 'slug'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function items()
    {
    	return $this->hasMany(Item::class);
    }
}
