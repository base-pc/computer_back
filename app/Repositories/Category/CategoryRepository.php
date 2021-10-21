<?php
namespace App\Repositories\Category;

interface CategoryRepository
{
	public function index();

	public function show($category_id);

	public function store($user, array $attributes);

	public function showOpinions($category_id);

	public function destroy($category_id);
}

?>
