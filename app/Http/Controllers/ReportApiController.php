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

  public function saleBySeller(){
    $sellers = Seller::all();
    foreach ($sellers as $key => $seller) {
      $seller->sales;
    }

    return $sellers;
  }
}