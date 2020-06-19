$(document).ready(function(){
  $('#msgModal').modal({
    onCloseEnd:function(){
      $('#read').prop('checked', false);
    }
  });
  $('#alrtModal').modal();

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

  $.ajax({
    url: 'dashboard/getData',
    method: 'post',
    dataType: 'json',
    success: function(data){
      $('#users').html(data['users']);
      $('#encoders').html(data['encoders']);
      $('#visitors').html(data['visitors']);
      $('#inactives').html(data['inactives']);
      userChart(data);
    }
  });

  var color = Chart.helpers.color;
  function userChart(qData){

    var qbarChartData = {
      labels: [],
      datasets: [{
        label: 'Encoders',
        backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
        borderColor: window.chartColors.green,
        borderWidth: 1,
        data: [
          qData['encoders']
        ]
      }, {
        label: 'Visitors',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [
          qData['visitors']
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

});
