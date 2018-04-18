import Char from 'chart.js'
window.$ = window.jQuery = require('jquery')
var axios = require('axios')
var randomColor = require('random-color')
var api = '/api/sales/report/{year}/monthly'
var url = api.replace('{year}', (new Date()).getFullYear())

export default function monthlySales(){
  var canvas = $('#monthly-sales')
  var yearSelector = $('#year-selector')
  var chart = new Chart(canvas, {
    type: 'line',
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
  yearSelector.change(function(event) {
    url = api.replace('{year}', $(this).val())
    load()
  });
  var load = function (){
    axios.get(url)
    .then(function(response){
      console.log(url);
      var obj, color, dataset = {
        label: yearSelector.val(),
        data: [],
        backgroundColor: randomColor().hexString()
      };
      chart.data.datasets[0] = dataset
      chart.data.labels = []
      for (var i = 0; i < response.data.length; i++) {
        obj = response.data[i]

        chart.data.labels.push(obj.date)
        dataset.data.push(obj.sales)
      }
      chart.update()
    })
  }
  load()
}
