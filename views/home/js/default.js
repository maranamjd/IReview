$(document).ready(function(){
  $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });

  $('#msgModal').modal();
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

  $(document).on('submit', '#contact_form', function(e){
    e.preventDefault();
    let name = $('#name').val();
    let email = $('#email').val();
    let message = $('#message').val();
    confirmModal('Submit Message', 'Continue?', function(){
      $.ajax({
        url: 'home/sendMessage',
        method: 'post',
        dataType: 'json',
        data: {name: name, email: email, message: message},
        success: function(data){
          M.toast({html: data['message']});
          if (data['res'] == 1) {
            $('#name').val('');
            $('#email').val('');
            $('#message').val('');
          }
        }
      });
    });
  });

});
