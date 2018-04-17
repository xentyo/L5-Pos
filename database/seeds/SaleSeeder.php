<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Customer;
use App\Item;
use App\Sale;
use App\SaleItem;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sellers = User::all();
      $customers = Customer::all();
      $items = Item::all();

      $sale = null;
      $customer = null;
      $item = null;
      $seller = null;
      $itemQty = 0;
      $totalCost = 0;
      $totalSelling = 0;
      $saleItemsCount = 0;
      $sellersCount = count($sellers);
      $itemsCount = count($items);
      $customersCount = count($customers);
      $salesTotal = mt_rand(500, 2000);

      echo "Total sale to generate: " . $salesTotal ."\r\n";

      for ($i=0; $i < $salesTotal; $i++) {
        echo  $i . "/" . $salesTotal . "\r\n";
        $seller = $sellers[mt_rand(0, $sellersCount - 1)];
        $customer = $customers[mt_rand(0, $customersCount - 1)];
        $sale = new Sale();
        $sale->user()->associate($seller);
        $sale->customer()->associate($customer);
        $sale->save();
        $sale->created_at = $this->getRandomTimestamps()['created_at'];
        $sale->save();
        $saleItemsCount = mt_rand(1, 10);
        for ($q=0; $q < $saleItemsCount; $q++) {
          $item = $items[mt_rand(0, $itemsCount - 1)];
          $itemQty = mt_rand(1, 5);
          $totalCost = $itemQty * $item->cost_price;
          $totalSelling = $itemQty * $item->selling_price;
          SaleItem::create([
            'sale_id' => $sale->id,
            'item_id' => $item->id,
            'cost_price' => $item->cost_price,
            'selling_price' => $item->selling_price,
            'quantity' => $itemQty,
            'total_cost' => $totalCost,
            'total_selling' => $totalSelling
          ]);
        }
      }
    }

    function getRandomTimestamps($backwardDays = null)
  	{
  		if ( is_null($backwardDays) )
  		{
  			$backwardDays = -800;
  		}

  		$backwardCreatedDays = rand($backwardDays, 0);
  		$backwardUpdatedDays = rand($backwardCreatedDays + 1, 0);

  		return [
  			'created_at' => \Carbon\Carbon::now()->addDays($backwardCreatedDays)->addMinutes(rand(0,
  				60 * 23))->addSeconds(rand(0, 60)),
  			'updated_at' => \Carbon\Carbon::now()->addDays($backwardUpdatedDays)->addMinutes(rand(0,
  				60 * 23))->addSeconds(rand(0, 60))
  		];
  	}
}
