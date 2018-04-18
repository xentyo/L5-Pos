@extends('main')

@section('head-scripts')
  <script src="/js/graphs.js" charset="utf-8"></script>
@endsection

@section('head-styles')
  <link rel="stylesheet" href="/css/app.css">
  <style media="screen">
    body{
      padding: 10px;
    }
  </style>
@endsection

@section('content')
  <div class="graph col-md-4">
    <h1>Daily Sales</h1>
    <div class="col-md-12">
      <canvas id="daily-sales"></canvas>
    </div>
  </div>
  <div class="graph col-md-8">
    <h1 class="text-center">Sellers Rank</h1>
    <div class="col-md-8 col-md-offset-2 text-center">
      <div id="top-5" class="btn btn-primary"><span>Top 5</span></div>
      <div id="top-10" class="btn btn-primary"><span>Top 10</span></div>
      <div id="top-20" class="btn btn-primary"><span>Top 20</span></div>
      <div id="all" class="btn btn-primary"><span>All</span></div>
    </div>
    <div class="col-md-12">
      <canvas id="rank-sellers"></canvas>
    </div>
  </div>
  <div class="graph col-md-4">
    <h1>Sales by month</h1>
  </div>
@endsection
