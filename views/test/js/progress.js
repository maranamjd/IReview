$(document).ready(function(){

var test_id = $('#test_id').val();
$.ajax({
  url: '../testProgress',
  method: 'post',
  data: {test_id: test_id},
  dataType: 'json',
  success: function(data){
    createProgressChart(data);
  }
});
$('.tooltiped').tooltip();
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

  function createProgressChart(data){
    var progress = document.getElementById('animationProgress');
    var config = {
      type: 'line',
      data: {
        labels: data['dates'],
        datasets: [{
          label: 'Correct',
          fill: false,
          borderColor: window.chartColors.green,
          backgroundColor: window.chartColors.green,
          data: data['correct']
        }, {
          label: 'Wrong',
          fill: false,
          borderColor: window.chartColors.red,
          backgroundColor: window.chartColors.red,
          data: data['wrong']
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Test Progress'
        },
        scales: {
					xAxes: [{
						display: true,
					}],
					yAxes: [{
						display: true,
						type: 'linear'
					}]
        },
        animation: {
					duration: 2000,
					onProgress: function(animation) {
						progress.value = animation.currentStep / animation.numSteps;
					},
					onComplete: function() {
						window.setTimeout(function() {
							progress.value = 0;
						}, 2000);
					}
				}
      }
    };

    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
  }

  $("#export").click(function(){
    var test_id = $('#test_id').val();
    window.open('../export/'+test_id, '_blank');
  });

});
