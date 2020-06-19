$(document).ready(function(){
  $('#msgModal').modal();
  $('#alrtModal').modal();
  $('.tabs').tabs();
  var qData = new Object();
  var rData = new Object();

  function confirmModal(title, msg, yescb){
    $('#msgTitle').text(title);
    $('#msgBody').text(msg);
    $('#msgModal').modal('open');
    $('#msgModalCancel').click(function(){
      $('#modalConfirm').modal('close');
    });
    $('#msgModalOk').click(function(){
      yescb();
      $('#msgModal').modal('close');
    });
  }
  function alertModal(title, msg, duration = 1500, cb){
    $('#alrtTitle').text(title);
    $('#alrtBody').text(msg);
    $('#alrtModal').modal('open');
    $('#alrtModalOk').click(function(){
      $('#alrtModal').modal('close');
      cb();
    });
    setTimeout(function () {
      $('#alrtModal').modal('close');
      cb();
    }, duration);
  }

function getStats(category = '*'){
  $.ajax({
    url: 'statistics/getStats/'+category,
    method: 'post',
    dataType: 'json',
    success: function(data){
      questionChart(data['questions']);
      resultChart(data['results']);
    }
  });
}
getStats();


$(document).on('change', '#testCategory', function(){
  getStats($(this).val());
});


var color = Chart.helpers.color;
function questionChart(qData){

  var qbarChartData = {
    labels: [],
    datasets: [{
      label: 'Easy',
      backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
      borderColor: window.chartColors.green,
      borderWidth: 1,
      data: [
        qData.easy
      ]
    }, {
      label: 'Average',
      backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
      borderColor: window.chartColors.blue,
      borderWidth: 1,
      data: [
        qData.average
      ]
    }, {
      label: 'Hard',
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1,
      data: [
        qData.hard
      ]
    }]

  };

  $("#qcanvas").remove();
  $("#qcontainer").append("<canvas id='qcanvas' style='-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;'></canvas>");
  var ctx = document.getElementById('qcanvas').getContext('2d');
  myBar = new Chart(ctx, {
    type: 'bar',
    data: qbarChartData,
    options: {
      responsive: true,
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Question difficulty'
      }
    }
  });
}

function resultChart(rData){
  var rbarChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
      label: 'Pass',
      backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
      borderColor: window.chartColors.green,
      borderWidth: 1,
      data: rData.pass
    }, {
      label: 'Fail',
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1,
      data: rData.fail
    }]

  };


  $("#rcanvas").remove();
  $("#rcontainer").append("<canvas id='rcanvas' style='-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;'></canvas>");
  var ctx = document.getElementById('rcanvas').getContext('2d');
  window.myBar = new Chart(ctx, {
    type: 'bar',
    data: rbarChartData,
    options: {
      responsive: true,
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Monthly test record'
      }
    }
  });
}


$('select').formSelect();

$("#exportQuestions").click(function(){
  window.open('statistics/export/questions', '_blank');
});

$("#exportResults").click(function(){
  window.open('statistics/export/results', '_blank');
});

});
