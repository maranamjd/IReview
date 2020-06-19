$(document).ready(function(){

  var pfname = $('#fname').val();
  var pmname = $('#mname').val();
  var plname = $('#lname').val();

  $('#msgModal').modal({
    onCloseEnd:function(){
      $('#read').prop('checked', false);
      $('#modalimg').hide();
      $('#msgModal').attr('style', 'height: 40%');
    }
  });
  $('#alrtModal').modal();
  $('.tabs').tabs();

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



  $('#saveInfo').click(function(){
    var fname = $('#fname').val();
    var mname = $('#mname').val();
    var lname = $('#lname').val();
    if (fname != '' && mname != '' && lname != '') {
      confirmModal('Update Info', 'Continue?', function(){
        $.ajax({
          url: 'account/updateInfo',
          method: 'post',
          data: {fname: fname, mname: mname, lname: lname},
          success: function(data){
            alertModal('Update Info', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });

    }else {
      alertModal('Update Info', 'Please fill out the form', 2000, function(){});
    }
  });

  $('#cancel').click(function(){
    $('#fname').focus();
    $('#fname').val(pfname);
    $('#mname').focus();
    $('#mname').val(pmname);
    $('#lname').focus();
    $('#lname').val(plname);
  });



  $('#savePassword').click(function(){
    var pass = $('#pass').val();
    confirmModal('Update Password', 'Continue?', function(){
      $.ajax({
        url: 'account/updatePassword',
        method: 'post',
        data: {pass: pass},
        success: function(data){
          alertModal('Update Password', data, 2000, function(){
            window.location.reload();
          });
        }
      });
    });
  });

  $('#showPass').click(function(){
    if ($(this).is(':checked')) {
      $('#pass').attr('type', 'text');
      $('#confirm').attr('type', 'text');
    }else {
      $('#pass').attr('type', 'password');
      $('#confirm').attr('type', 'password');
    }
  });

  $(document).on('keyup', '#pass, #confirm', function(){
    var pass = $('#pass').val();
    var confirm = $('#confirm').val();
    if (pass == '' || confirm == '') {
      $('#savePassword').attr('disabled', true);
      $('.input-field label').attr('style', 'color:#aaa');
    }else {
      if (pass.length >= 8 ) {
        if (pass != confirm) {
          $('#savePassword').attr('disabled', true);
          $('.input-field label').attr('style', 'color:#f00');
        }else {
          $('#savePassword').attr('disabled', false);
          $('.input-field label').attr('style', 'color:#0f0');
        }
      }
    }
  });
  //change profile picture
  $(document).on('change', '#changeprofile', function(e){
    e.preventDefault();
      var formData = new FormData();
      var input = $(this);
      formData.append('image', $(this)[0].files[0]);
      showImage(this);
      $('#msgModal').attr('style', 'height: 50%');
      $('#modalimg').show();
       confirmModal('Change profile picture?', '', function(){
         $.ajax({
           url : 'account/changeProfile',
           type : 'POST',
           data : formData,
           processData: false,  // tell jQuery not to process the data
           contentType: false,  // tell jQuery not to set contentType
           success : function(data) {
             if(data == 1){
               alertModal('Error!', 'Invalid file.', 1500, '');
             }else {
               alertModal('Result', data, 1500, function(){
                 window.location.reload();
               });
             }
           }
         });
       });
       input.val('');
  });
  function showImage(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('modalBody').innerHTML = '<img src="'+ e.target.result +'" alt=" Invalid File" id="modalConfirmImage" width="180" height="180" style=""/>';
      }
      reader.readAsDataURL(input.files[0]);
    }
  }



});
