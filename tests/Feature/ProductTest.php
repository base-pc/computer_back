<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Category;
use App\Models\Product;
use JWTAuth;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_product_test()
    {
        $user = User::factory()->create([

            'is_admin' => 1,
            'id' => 1
        ]);

        $category = Category::factory()->create([
            'id'      => 1,
        ]);


        $product = Product::factory()->definition([
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $response = $this->actingAsUser($user)
                         ->post('api/product/store/category/1', $product);

        $response
            ->assertStatus(500);

    }

    /** @test */
    public function delete_product_test()
    {
        $user = User::factory()->create([

            'is_admin' => 1,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id'      => 1,
        ]);


        $product = Product::factory()->create([
            'id'            => 1,
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $response = $this->actingAsUser($user)
                         ->delete('api/product/1/destroy');

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function non_admin_cannot_store_product_test()
    {

        $user = User::factory()->create([

            'is_admin' => 0,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id'      => 1,
        ]);


        $product = Product::factory()->definition([
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $response = $this->actingAsUser($user)
                         ->post('api/product/store/category/1', $product);

        $response
            ->assertStatus(403);
    }

    /** @test */
    public function non_admin_cannot_delete_product_test()
    {
        $user = User::factory()->create([

            'is_admin' => 0,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id'      => 1,
        ]);


        $product = Product::factory()->definition([
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $response = $this->actingAsUser($user)
                         ->delete('api/product/1/destroy');

        $response
            ->assertStatus(403);

    }

    public function actingAsUser($user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'multipart/form-data',
            'Authorization' => "Bearer {$token}"

        ]);
        parent::actingAs($user);

        return $this;
    }


}
