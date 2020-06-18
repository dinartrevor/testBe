<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;
use App\SubCategory;
class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Currency::class, 100)->create()->each(function ($currency) {
            $currency->variations()->saveMany(factory(App\Variation::class, 50)->make());
        });
 
    }
}
