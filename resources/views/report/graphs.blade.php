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
  <h1>Daily Sales</h1>
  <canvas id="daily-sales" width="400" height="400"></canvas>
@endsection
