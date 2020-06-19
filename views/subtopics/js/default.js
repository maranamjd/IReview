$(document).ready(function(){


  function getTests(searchKey = '*'){
    var st_id = $('#st_id').val();
    $.ajax({
      url: '../../subtopics/getTest/'+searchKey,
      method: 'post',
      data: {st_id: st_id},
      dataType: 'json',
      success: function(data){
      var divappend = "<ul class='collection'>";
      document.getElementById('tests').innerHTML = '';
      for (var tests in data) {
        divappend += "<li class='collection-item'>";
        divappend += "<div class='collapsible-header' id='test"+data[tests].test_id+"'>";
        divappend += "<div class='col m10 l10 s12'>";
        divappend += "<h4>"+data[tests].testName+"</h4>";
        divappend += "<h5>"+data[tests].testCategory+"</h5>";
        divappend += "</div>";
        divappend += "<a href='../../test/view/"+data[tests].test_id+"' class='btn-small btn-floating green tooltipped testView' data-position='left' data-tooltip='View Test' id='test_view"+data[tests].test_id+"'>";
        divappend += "<input type='hidden' id='testId' value='"+data[tests].test_id+"'>";
        divappend += "<i class='material-icons'>details</i>";
        divappend += "</a>";
        divappend += "</div>";
        divappend += "</div>";
        divappend += "</div>";
        divappend += "</li>";
      }
        divappend += "</ul>";
        document.getElementById('tests').innerHTML = divappend;
        $('.collapsible').collapsible();
        $('.tooltipped').tooltip();
        $('.qModalOpen').click(function(){
          $('#test_name').html($(this).find('#testname').val());
          $('#test_fn').html('Add Question');
          $('#test_id').val($(this).find('#testId').val());
          switch ($(this).find('#testcategory').val()) {
            case 'Multiple Choice':
              $('#multiple_choice').show();
              $('#test_category').val('multiplechoiceForm');
              break;
            case 'True or False':
              $('#true_or_false').show();
              $('#test_category').val('truefalseForm');
              break;
            case 'Enumeration':
              $('#enumeration').show();
              $('#test_category').val('enumerationForm');
              break;
          }
          $('#qAdd').show();
          $('#questionModal').modal('open');
        });
      }
    });
  }
  setTimeout(function(){
    getTests();
    $('#imgLoad').hide();
  }, 100);
  $(document).on('keyup', '#searchTopic', function(e){
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getTests(key);
  });

  $('select').formSelect();
  $('#testModal').modal({
    onCloseEnd:function(){
      $('#testName').val('');
      $('#testCategory').find('option[value="default"]').prop('selected', true);
      $('select').formSelect();
      $('#st_id').val('');
    }
  });
  $('#questionModal').modal({
    onCloseEnd:function(){
      $('#questionDescription').val('');
      $('#test_name').html('');
      $('#test_fn').html('');
      $('#multiple_choice').hide();
      $('#true_or_false').hide();
      $('#enumeration').hide();
      $('.answers').html("<div class='input-field col m7 l7 s7'><input id='answer1' type='text' name='answer1' value=''></div>");
      $('#answer_count').val(1);
      $('#qAdd').hide();
      $('#qUpdate').hide();
    }
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


});
