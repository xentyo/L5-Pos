<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use \Auth, \Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleReportController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$salesReport = Sale::all();
			return view('report.sale')->with('saleReport', $salesReport);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function graphs(){
		return view('report.graphs');
	}

	public function apiReport(Request $request, $time){
		if(strcmp($time, 'daily') == 0){
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

		return [];
	}
}
