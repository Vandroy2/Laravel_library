<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Delivery;
use App\Models\Office;
use Illuminate\Database\Seeder;


class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $deliveries = Delivery::all();
        $cities = City::all();

        foreach ($deliveries as $delivery){
            foreach ($cities as $city)
            if ($city->deliveries->contains($delivery)){
                factory(Office::class, 10)->create()->each(function ($office) use ($delivery, $city){

                    $office->city()->associate($city)->save();
                    $office->delivery()->associate($delivery)->save();


                });
            }
        }
    }
}

//Category::query()
//    ->whereNotNull('parent_id')
//    ->each(function ($category) {
//        CategoryAttributeGroup::query()
//            ->where('category_id', $category->id)
//            ->each(function($group) use($category) {
//                Attribute::query()
//                    ->where('attribute_group_id', $group->id)
//                    ->each(function($attribute) use($category, $group) {
//                        factory(Filter::class, 2)->create()->each(function ($filter) use ($category, $group, $attribute) {
//                            $filter->categories()->sync($category);
//                            $filter->attributeGroup()->associate($group)->save();
//                            $filter->attribute()->associate($attribute)->save();
//                        });
//                    });
//            });
//    });







