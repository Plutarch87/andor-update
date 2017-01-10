<?php 

namespace App\Repositories;

use App\Category;
use App\Subcat;

class SubcatRepository 
{
	public function forCategory(Category $category)
	{
		return Subcat::where('category_id', $category->id)
		                    ->orderBy('created_at', 'asc')
		                    ->get();
	}
}