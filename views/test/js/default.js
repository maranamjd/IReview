$(document).ready(function(){

  var testId = $('#test_id').val();
  var didTake = 0;
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
    url: '../has',
    method: 'post',
    data: {test_id: testId},
    success: function(data){
      if (data == 1) {
        didTake = 1;
      }else if (data == 2) {
        didTake = 2;
      }
    }
  });

  $('#takeTest').click(function(){
    if (didTake == 1) {
      alertModal('', 'Tests are only available once everyday.', 3000, function(){});
    }else if (didTake == 2) {
      alertModal('', 'Sorry. Test questions is being prepared.', 3000, function(){});
    }else {
      $('#guidelines').show();
      $('#msgModalOk').attr('disabled', true);
      $('#msgModal').attr('style', 'height: 100%');
      confirmModal('Take test', '', function(){
        $('#alrtModalOk').hide();
        $('#imgLoad').show();
        $('#guidelines').hide();
        alertModal('', 'Preparing test questions. Please wait..', 500, function(){
          $('#imgLoad').hide();
          $('#alrtModalOk').show();
          $.ajax({
            url: $('#takeTest').attr('rel'),
            method: 'post',
            data: {isClick: true},
            success: function(){
              window.location.replace($('#takeTest').attr('rel'));
            }
          });
        });
      });
    }
  });


  $('#read').click(function(){
    if ($(this).is(':checked')) {
      $('#msgModalOk').attr('disabled', false);
    }else {
      $('#msgModalOk').attr('disabled', true);
    }
  });



});
