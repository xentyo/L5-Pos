<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Item;
use App\User;
use App\Inventory;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = new Faker();
      $admin = User::where('name', 'admin')->first();
      $items = Item::all();
      if(count($items) < 10){
        factory(App\Item::class, 10)->create();
      }
      foreach ($items as $key => $item) {
        Inventory::create([
          'item_id' => $item->id,
          'user_id' => $admin->id,
          'in_out_qty' => $faker->randomNumber(3)
        ]);
      }
    }
}
