<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	protected $appends = ['cost', 'selling'];
	protected $hidden = ['items'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

		public function items(){
			return $this->hasMany(SaleItem::class);
		}

		public function GetCostAttribute(){
			$total = 0;
			foreach ($this->items as $key => $item) {
				$total += $item->total_cost;
			}
			return $total;
		}

		public function GetSellingAttribute(){
			$total = 0;
			foreach ($this->items as $key => $item) {
				$total += $item->total_selling;
			}
			return $total;
		}

}
