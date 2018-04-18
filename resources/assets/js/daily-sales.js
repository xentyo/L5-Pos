import Char from 'chart.js'
window.$ = window.jQuery = require('jquery')
var axios = require('axios')
var randomColor = require('random-color')

export default function dailySalesChart(){
  var canvas = $('#daily-sales')
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
  axios.get('/api/sales/report/daily')
  .then(function(response){
    var obj, color, dataset = {
      label: "Today",
      data: [],
      backgroundColor: randomColor().hexString()
    };
    chart.data.datasets[0] = dataset
    for (var i = 0; i < response.data.length; i++) {
      obj = response.data[i]

      chart.data.labels.push(obj.label)
      dataset.data.push(obj.count)
    }
    chart.update()
  })
}
