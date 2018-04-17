<?php

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function(Faker $faker){
  $price = $faker->randomNumber(2);
  $selling_price = $price + $faker->randomNumber(1);
  return [
    'item_name' => $faker->word,
    'description' => $faker->text(110),
    'cost_price' => $price,
    'selling_price' => $selling_price
  ];
});

 ?>
