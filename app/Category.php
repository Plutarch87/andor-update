<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;


class Category extends Model
{

    protected $fillable = ['name', 'slug'];


	public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function subcats()
    {
    	return $this->hasMany(Subcat::class);
    }

    public function items()
    {
    	return $this->hasMany(Item::class);
    }

    public function getItems(Category $category)
    {
        return $this->items->orderBy('created_at', 'desc')->paginate(12);
    }
}
