<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;
use App\SubCategory;
use App\Product;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 20)->create()->each(function ($categories) {
            $category = $categories->id;
            factory(SubCategory::class, 1)->create(['category_id'=>$category])->each(function ($sub) {
                factory(Product::class, 1)->create(['category_id'=>$sub->category_id, 'subcategory_id'=>$sub]);
            });
        });
    }
}
