import Char from 'chart.js'
window.$ = window.jQuery = require('jquery')
var axios = require('axios')
var Color = require('color')
var colorBase = "#11c351";
var api = '/api/sellers/report/rank';
var url = api + "?top=5"

export default function rankSellersChart() {
  var canvas = $('#rank-sellers')
  var top5 = $('#top-5.btn'), top10 = $('#top-10.btn'), top20 = $('#top-20.btn'), showAll = $('#all.btn')
  var chart = new Chart(canvas, {
    type: 'horizontalBar',
    data: {
      labels: [],
      datasets: []
    },
    options: {
      responsive: true,
      legend:{display:false},
      scales: {
        yAxes: [{
          stacked: true,
          gridLines: {
            display: true,
            color: "rgba(255,99,132,0.2)"
          }
        }],
        xAxes: [{
          gridLines: {
            display: false
          }
        }]
      }
    }
  })
  var load = function (){
    axios.get(url)
    .then(function(response){
      var obj, color, dataset = {
        label: "Sales",
        data: [],
        backgroundColor: [],
        fill: false
      }
      var factor = function(){return 1/response.data.length};
      chart.data.datasets[0] = dataset
      chart.data.labels = []
      color = Color(colorBase)

      for (var i = 0; i < response.data.length; i++) {
        obj = response.data[i]

        chart.data.labels.push(obj.name)
        dataset.data.push(obj.sales)
        dataset.backgroundColor.push(color.darken(factor() * i).string())
      }

      chart.update()
    })
  }

  top5.click(function(event) {
    url = api + '?top=5'
    load()
  });
  top10.click(function(event) {
    url = api + '?top=10'
    load()
  });
  top20.click(function(event) {
    url = api + '?top=20'
    load()
  });
  showAll.click(function(event) {
    url = api
    load()
  });

  load()
}
