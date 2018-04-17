import Char from 'chart.js'
window.$ = window.jQuery = require('jquery')
var axios = require('axios')
var randomColor = require('random-color')

$(document).ready(function() {
  var dailySales = $('#daily-sales')

  axios.get('/api/sales/report/daily')
  .then(function(response){
    charDailySales(response.data)
  })
  // .catch(function(error){
  //   console.log(error)
  // })

  function charDailySales(data){
    var dataSet = getDataSet('sales per hour', data);
    var chart = new Chart(dailySales, {
      type: 'line',
      data: dataSet
    })
  }

  function getDataSet(label, data){
    var result = {
      labels: [],
      datasets: []
    }
    var set = {
      label: label,
      data: [],
      backgroundColor: []
    }
    for (var i = 0; i < data.length; i++) {
      result.labels[result.labels.length] = data[i].label;
      set.backgroundColor[set.backgroundColor.length] = randomColor()
      set.data[set.data.length] = data[i].count
    }
    result.datasets[0] = set
    return result
  }
});
