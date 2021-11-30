<?php

namespace App\Repositories\Comment;

interface CommentRepository
{
	public function store($user, $product_id, array $attributes);
}

?>


