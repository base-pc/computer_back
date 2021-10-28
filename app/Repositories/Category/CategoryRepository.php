<?php
namespace App\Repositories\Category;

interface CategoryRepository
{
	public function index();

	public function show($category_id);

	public function store($user, array $attributes, $upload);

	public function destroy($category_id);
}

?>
