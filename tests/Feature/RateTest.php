<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rate;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use JWTAuth;

class RateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function rate_store_test()
    {
        $user = User::factory()->create([
            'is_admin' => 0,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $product = Product::factory()->create([
            'id'            => 1,
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $rate = Rate::factory()->definition([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAsUser($user)->post('api/product/rate/1', $rate);

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function admins_cannot_rate()
    {
        $user = User::factory()->create([
            'is_admin' => 1,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $product = Product::factory()->create([
            'id'            => 1,
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $rate = Rate::factory()->definition([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAsUser($user)->post('api/product/rate/1', $rate);

        $response
            ->assertStatus(403);
    }

    /** @test */
    public function users_cannot_rate_the_same_product_twice()
    {

        $user = User::factory()->create([
            'is_admin' => 0,
            'id'       => 1
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $product = Product::factory()->create([
            'id'            => 1,
            'user_id'       => $user->id,
            'category_id'   => $category->id,
            'product_owner' => $user->fullname,
        ]);

        $rate = Rate::factory()->definition([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        $this->actingAsUser($user)->post('api/product/rate/1', $rate);
        $response = $this->actingAsUser($user)->post('api/product/rate/1', $rate);

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
