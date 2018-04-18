<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Sale;
use App\User as Seller;

class ReportApiController extends Controller
{
  public function dailySales(){
    $currentDate = new Carbon();
    $sales = Sale::where('created_at', '>', $currentDate->subDays(1))->get()->pluck('created_at')
    ->groupBy('hour')->toArray();
    $salesByHour = [];
    $salesGroup = null;
    foreach ($sales as $key => $salesGroup) {
      $salesGroup = [
        'label' => Carbon::create(0,0,0,$key,0,0, 'America/Tijuana')->format('H:m'),
        'count' => count($salesGroup)
      ];
      array_push($salesByHour, $salesGroup);
    }
    return $salesByHour;
  }

  public function saleBySeller(Request $request){
    $sellers = Seller::all();
    $rank = [];
    foreach ($sellers as $key => $seller) {
      $rank[] = [
        'name' => $seller->name,
        'email' => $seller->email,
        'sales' => count($seller->sales)
      ];
    }
    $collection = collect($rank)->sortBy('sales')->reverse();
    if($request->has('top')) return $collection->chunk($request->get('top'))->toArray()[0];
    return $collection->toArray();
  }

  public function monthly($year){
    $from = new Carbon();
    $from->year = $year;
    $to = new Carbon($from);
    $to->year += 1;
    $to->month -= 1;
    $sales = Sale:: whereBetween('created_at', [$from, $to])
                  ->orderBy('created_at', 'ASC')
                  ->get()
                  ->groupBy(function($sale){
                    return Carbon::parse($sale->created_at)->format('Y F');
                  });
    $relation = [];
    foreach ($sales as $key => $sale) {
      $relation[] = [
        'date' => $key,
        'sales'=> count($sale)
      ];
    }
    return $relation;
  }

  public function saleYearsRange(){
  }


}
