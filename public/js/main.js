$(document).ready(function(){

  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
  $('.fixed-action-btn').floatingActionButton();
  $('.tooltipped').tooltip();
  $('#confirmModal').modal();

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

  $(document).on('click', '#logout', function(){
    var url = $(this).attr('rel');
    confirmModal('Logout', 'Are you sure you want to logout?', function(){
      window.location.replace(url);
    });
  });

});
