<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model {

	public $fillable = [
		'sale_id',
		'item_id',
		'cost_price',
		'selling_price',
		'quantity',
		'total_cost',
		'total_selling'
	];

	public function item()
  {
      return $this->belongsTo('App\Item');
  }

}
