$(document).ready(function(){

  $('.tabs').tabs();
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

  function login(username, password){
    if (username == '' || password == '') {
        $('#toast2')[0].click();
    }else {
      $.ajax({
        url: 'login/run',
        method: 'post',
        data: {username: username, password: password},
        success: function(data){
          if (data == 1) {
            location.reload();
          }else if (data == 0) {
            $('#toast')[0].click();
            $('#username').val('');
            $('#password').val('');
            $('#username').focus();
          }else if (data == 3) {
            alertModal('Redirecting', 'Please update your password after redirecting to your account page!!', 3000, function(){
              window.location.reload();
            });
          }
          else {
            $('#toast3')[0].click();
          }
        }
      });
    }
  }

  $('#showPass').click(function(){
    if ($(this).is(':checked')) {
      $('#password').attr('type', 'text');
    }else {
      $('#password').attr('type', 'password');
    }
  });

  $(document).on('click', '#login', function(){
    var username = $('#username').val();
    var password = $('#password').val();
    login(username, password);
  });

  $(document).on('click', '#register', function(){
    var firstname = $('#firstname').val();
    var middlename = $('#middlename').val();
    var lastname = $('#lastname').val();
    var uname = $('#uname').val();
    if (firstname == '' || middlename == '' || lastname == '' || uname == '') {
      $('#toast2')[0].click();
    }else {
      confirmModal('User Registration', 'Register new user?', function(){
        $.ajax({
          url: 'login/register',
          method: 'post',
          data: {firstname: firstname, middlename: middlename, lastname: lastname, uname: uname},
          success: function(data){
            var txt = "";
            if (data == 1) {
              txt = "New user registered successfuly!"
              alertModal('Redirecting...', txt, 2000, function(){
                login(uname, lastname);
              });
            }else if (data == 2) {
              txt = "User registration Failed!"
              alertModal('User Registration', txt, 2000, function(){
                window.location.reload();
              });
            }else {
              txt = "Username Already exists."
              alertModal('User Registration', txt, 2000, function(){
                window.location.reload();
              });
            }
          }
        });
      });
    }
  });

});
