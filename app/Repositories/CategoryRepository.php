<?php 

namespace App\Repositories;

use App\Category;

class CategoryRepository 
{
	public function forUser(User $user)
	{
		return $user->category->orderBy('name', 'asc')->get();
	}
}