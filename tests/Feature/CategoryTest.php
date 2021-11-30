<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use JWTAuth;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_store_test()
    {

        $user = User::factory()->create([
            'is_admin' => 1,
            'id'       => 1
        ]);

        $category = Category::factory()->definition([
            'id' => 1
        ]);

        $response = $this->actingAsUser($user)->post('api/category/store', $category);

        $response
            ->assertStatus(200);
    }


    /** @test */
    public function category_delete_test()
    {

        $user = User::factory()->create([
            'is_admin' => 1,
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $category->save();

        $response = $this->actingAsUser($user)->delete('api/category/1/destroy');

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function non_admin_cannot_store_category_test()
    {

        $user = User::factory()->create([
            'is_admin' => 0,
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $category->save();

        $response = $this->actingAsUser($user)->post('api/category/store');

        $response
            ->assertStatus(403);
    }

    /** @test */
    public function non_admin_cannot_delete_category_test()
    {

        $user = User::factory()->create([
            'is_admin' => 0,
        ]);

        $category = Category::factory()->create([
            'id' => 1
        ]);

        $category->save();

        $response = $this->actingAsUser($user)->delete('api/category/1/destroy');

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






