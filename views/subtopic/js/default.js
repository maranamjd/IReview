$(document).ready(function(){


  function getTests(searchKey = '*'){
    var st_id = $('#stId').val();
    $.ajax({
      url: '../../subtopic/getTest/'+searchKey,
      method: 'post',
      data: {st_id: st_id},
      dataType: 'json',
      success: function(data){
      var divappend = "<ul id='testList' class='collapsible popout'>";
      document.getElementById('tests').innerHTML = '';
      for (var tests in data['tests']) {
        divappend += "<li class='tests'>";
        divappend += "<div class='collapsible-header' id='test"+data['tests'][tests].test_id+"'>";
        divappend += "<div class='col m10 l10 s12'>";
        divappend += "<h4>"+data['tests'][tests].testName+"</h4>";
        divappend += "<h5>"+data['tests'][tests].testCategory+"</h5>";
        divappend += "</div>";
        divappend += "<div class='col m2 l2 testSettings' style='display: none'>";
        divappend += "<a href='#' class='btn-small btn-floating orange tooltipped testEdit' data-position='left' data-tooltip='Edit'>";
        divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
        divappend += "<input type='hidden' id='testname' value='"+data['tests'][tests].testName+"'>";
        divappend += "<input type='hidden' id='testcategory' value='"+data['tests'][tests].testCategory+"'>";
        divappend += "<i class='material-icons'>edit</i>";
        divappend += "</a>";
        divappend += "<a href='#' class='btn-small btn-floating red tooltipped testDelete' data-position='left' data-tooltip='Delete'>";
        divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
        divappend += "<i class='material-icons'>delete</i>";
        divappend += "</a>";
        divappend += "</div>";
        divappend += "</div>";
        divappend += "<div class='collapsible-body'>";
        divappend += "<a class='btn right qModalOpen'>";
        divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
        divappend += "<input type='hidden' id='testname' value='"+data['tests'][tests].testName+"'>";
        divappend += "<input type='hidden' id='testcategory' value='"+data['tests'][tests].testCategory+"'>";
        divappend += "<i class='material-icons'>add</i></a><br><br>";
        divappend += "<div class='divider'>";
        divappend += "</div>";
        divappend += "<ul class='collection'>";
        if (data['tests'][tests].testCategory == "Multiple Choice") {
          for (var questions in data['questions']) {
            if(data['questions'][questions].test_id == data['tests'][tests].test_id){
              divappend += "<li class='collection-item avatar'>";
              divappend += "<div class='col m9 l9 s7'>";
              divappend += "<span class='title'><h5 class='truncate'>"+data['questions'][questions].qDescription+"</h5></span>";
              divappend += "<p class='col m9 l9 s10'>";
              divappend += data['questions'][questions].qDifficulty;
              divappend += "</p>";
              divappend += "</div>";
              divappend += "<div class='col s5 m3 l3'>";
              divappend += "<a class='qEdit btn-small btn-floating orange tooltipped' data-position='left' data-tooltip='Edit'>";
              divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<input type='hidden' id='testname' value='"+data['tests'][tests].testName+"'>";
              divappend += "<input type='hidden' id='testcategory' value='"+data['tests'][tests].testCategory+"'>";
              divappend += "<input type='hidden' id='qDescription' value='"+data['questions'][questions].qDescription+"'>";
              var c = 1;
              for (var choices in data['choices']) {
                if(data['choices'][choices].q_id == data['questions'][questions].q_id){
                  divappend += "<input type='hidden' id='ch"+c+"mc"+data['questions'][questions].q_id+"' value='"+data['choices'][choices].mccDescription+"' rel='"+data['choices'][choices].mccIsAnswer+"' class='"+data['choices'][choices].mcc_id+"'>";
                  c++;
                }
              }
              divappend += "<i class='material-icons'>edit</i></a> ";
              divappend += "<a href='#' class='btn-small btn-floating red tooltipped qDelete' data-position='left' data-tooltip='Delete'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<i class='material-icons'>delete</i></a> ";
              divappend += "</div>";
              divappend += "</li>";
            }
          }
        }else if (data['tests'][tests].testCategory == "True or False") {
          for (var questions in data['questions']) {
            if(data['questions'][questions].test_id == data['tests'][tests].test_id){
              divappend += "<li class='collection-item avatar'>";
              divappend += "<div class='col m9 l9 s7'>";
              divappend += "<span class='title'><h5 class='truncate'>"+data['questions'][questions].qDescription+"</h5></span>";
              divappend += "<p class='col m9 l9 s10'>";
              divappend += data['questions'][questions].qDifficulty;
              divappend += "</p>";
              divappend += "</div>";
              divappend += "<div class='col s5 m3 l3'>";
              divappend += "<a class='qEdit btn-small btn-floating orange tooltipped' data-position='left' data-tooltip='Edit'>";
              divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<input type='hidden' id='testname' value='"+data['tests'][tests].testName+"'>";
              divappend += "<input type='hidden' id='testcategory' value='"+data['tests'][tests].testCategory+"'>";
              divappend += "<input type='hidden' id='qDescription' value='"+data['questions'][questions].qDescription+"'>";
              var c = 1;
              for (var choices in data['choices']) {
                if(data['choices'][choices].q_id == data['questions'][questions].q_id){
                  divappend += "<input type='hidden' id='ch"+c+"tf"+data['questions'][questions].q_id+"' value='"+data['choices'][choices].tfaDescription+"' class='"+data['choices'][choices].tfa_id+"'>";
                  c++;
                }
              }
              divappend += "<i class='material-icons'>edit</i></a> ";
              divappend += "<a href='#' class='btn-small btn-floating red tooltipped qDelete' data-position='left' data-tooltip='Delete'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<i class='material-icons'>delete</i></a> ";
              divappend += "</div>";
              divappend += "</li>";
            }
          }
        }else if (data['tests'][tests].testCategory == "Enumeration") {
          for (var questions in data['questions']) {
            if(data['questions'][questions].test_id == data['tests'][tests].test_id){
              divappend += "<li class='collection-item avatar'>";
              divappend += "<div class='col m9 l9 s7'>";
              divappend += "<span class='title'><h5 class='truncate'>"+data['questions'][questions].qDescription+"</h5></span>";
              divappend += "<p class='col m9 l9 s10'>";
              divappend += data['questions'][questions].qDifficulty;
              divappend += "</p>";
              divappend += "</div>";
              divappend += "<div class='col s5 m3 l3'>";
              divappend += "<a class='qEdit btn-small btn-floating orange tooltipped' data-position='left' data-tooltip='Edit'>";
              divappend += "<input type='hidden' id='testId' value='"+data['tests'][tests].test_id+"'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<input type='hidden' id='testname' value='"+data['tests'][tests].testName+"'>";
              divappend += "<input type='hidden' id='testcategory' value='"+data['tests'][tests].testCategory+"'>";
              divappend += "<input type='hidden' id='qDescription' value='"+data['questions'][questions].qDescription+"'>";
              var c = 1;
              for (var choices in data['choices']) {
                if(data['choices'][choices].q_id == data['questions'][questions].q_id){
                  divappend += "<input type='hidden' id='ch"+c+"mc"+data['questions'][questions].q_id+"' value='"+data['choices'][choices].eaDescription+"' class='"+data['choices'][choices].ea_id+"'>";
                  c++;
                }
              }
              divappend += "<input type='hidden' id='ansCount' value='"+c+"'>";
              divappend += "<i class='material-icons'>edit</i></a> ";
              divappend += "<a href='#' class='btn-small btn-floating red tooltipped qDelete' data-position='left' data-tooltip='Delete'>";
              divappend += "<input type='hidden' id='qId' value='"+data['questions'][questions].q_id+"'>";
              divappend += "<i class='material-icons'>delete</i></a> ";
              divappend += "</div>";
              divappend += "</li>";
            }
          }
        }
        divappend += "</ul>";
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
      $('#multiple_choice').attr('style', 'display: none');
      $('#true_or_false').attr('style', 'display: none');
      $('#enumeration').attr('style', 'display: none');
      $('#choice1').val("");
      $('#choice2').val("");
      $('#choice3').val("");
      $('#choice4').val("");
      $('.choice1').prop('checked', 'checked');
      $('.true').prop('checked', 'checked');
      $(".addAnswer").show();
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

  function checkFields(formData){
    var bool = 1;
    for (var field in formData) {
      if (formData[field] == '') {
        bool = 0;
        return;
      }
    }
    return bool;
  }

  $('#qAdd').click(function(){
    var formData = new Object();
    var form = '#'+ $('#test_category').val();
    var answers = $(form).serialize().split('=').join('&');
    formData.test_id = $('#test_id').val();
    formData.qDescription = $('#questionDescription').val();
    formData.qCategory = $('#test_category').val();
    if ($('#test_category').val() == 'enumerationForm') {
      formData.enumerationCount = $('#answer_count').val();
    }
    answers = answers.split('&');
    for (var i = 0; i < answers.length; i+=2) {
      formData[answers[i]] = answers[i+1];
    }
    if(checkFields(formData)){
      confirmModal('Add Question', 'Are you sure you want to add question?', function(){
        $.ajax({
          url: '../../subtopic/addQuestion',
          method: 'post',
          data: formData,
          success: function(data){
            $('#questionModal').modal('close');
            alertModal('Add Question', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal("Add Question", "Please fill out the form", 1000, function(){});
    }
  });

  $('.addAnswer').click(function(){
    var answer_count = parseInt($('#answer_count').val()) + 1;
    $('#answer_count').val(answer_count);
    var answerAppend = "<div class='input-field col m7 l7 s7'><input id='answer"+answer_count+"' type='text' name='answer"+answer_count+"' value=''></div>";
    $('.answers').append(answerAppend);
  });


  $('.testAdd').click(function(){
    $('#testModal').modal('open');
    $('.testFn').html('Add');
    $('#st_id').val($(this).find('#stId').val());
    $('#testAdd').attr('style', 'display:');
  });

  $(document).on('click', '.testEdit', function(){
    $('#testModal').modal('open');
    $('.testFn').html('Edit');
    $('#test_id').val($(this).find('#testId').val());
    $('#testName').focus();
    $('#testName').val($(this).find('#testname').val());
    $('#testCategory').attr('disabled', true);
    $('#testCategory').find('option[value="'+$(this).find('#testcategory').val()+'"]').prop('selected', true);
    $('select').formSelect();
    $('#testUpdate').attr('style', 'display:');
  });

  var cTopic = '';
  $(document).on('click', '.collapsible-header', function(){
    if (cTopic == $(this).attr('id')) {
      cTopic = '';
    }else {
      cTopic = $(this).attr('id');
    }
  });

  $('.testOrganize').click(function(){
    if (cTopic != '') {
      $('#'+cTopic).click();
      cTopic = '';
    }
    $(this).hide();
    $('#testList').attr('class', 'collection');
    $('.testReturn').show('400');
    $('.testSettings').show('400');
    $('#searchTest').attr('disabled', true);
    $('.testAdd').attr('disabled', true);
    $('.testView').hide();
  });
  $('.testReturn').click(function(){
    if (cTopic != '') {
      $('#'+cTopic).click();
      cTopic = '';
    }
    $(this).hide();
    $('#testList').attr('class', 'collapsible popout');
    $('.testOrganize').show('400');
    $('.testSettings').hide('400');
    $('.testAdd').attr('disabled', false);
    $('#searchTest').attr('disabled', false);
    $('.testView').show();
  });

  $('#testAdd').click(function(e){
    e.preventDefault();
    var testName = $('#testName').val();
    var testCategory = $('#testCategory').val();
    var st_id = $('#st_id').val();
    if (testName == '' || testCategory == null) {
      alertModal('Add Test', 'Please fill out the form');
    }else {
      confirmModal('Add Test', 'Are you sure you want to add test?', function(){
        $.ajax({
          url: '../../subtopic/addTest',
          method: 'post',
          data: {st_id: st_id, testName: testName, testCategory: testCategory},
          success: function(data){
            $('#testModal').modal('close');
            alertModal('Add Test', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }
  });

  $(document).on('click', '#testUpdate', function(e){
    e.preventDefault();
    var test_id = $('#test_id').val();
    var testName = $('#testName').val();
    if (test_id != '' && testName != '') {
      confirmModal('Update Test', 'Are you sure you want to update Test?', function(){
        $.ajax({
          url: '../../subtopic/updateTest',
          method: 'post',
          data: {test_id: test_id, testName: testName},
          success: function(data){
            $('#testModal').modal('close');
            alertModal('Update Test', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal('Update Test', 'Please fill out the form');
    }
  });

  $(document).on('click', '.testDelete', function(e){
    e.preventDefault();
    var test_id = $(this).find('#testId').val();
    confirmModal('Delete Test', 'Are you sure you want to delete Test?', function(){
      $.ajax({
        url: '../../subtopic/deleteTest',
        method: 'post',
        data: {test_id: test_id},
        success: function(data){
          $('#topicModal').modal('close');
          alertModal('Delete Test', data, 2000, function(){
            window.location.reload();
          });
        }
      });
    });
  });

  $(document).on('click', '.qDelete', function(e){
    e.preventDefault();
    var q_id = $(this).find('#qId').val();
    confirmModal('Delete question', 'Are you sure you want to delete question?', function(){
      $.ajax({
        url: '../../subtopic/deleteQuestion',
        method: 'post',
        data: {q_id: q_id},
        success: function(data){
          alertModal('Delete question', data, 2000, function(){
            window.location.reload();
          });
        }
      });
    });
  });

  $(document).on('click', '.qEdit', function(){
    $('#questionModal').modal('open');
    $('#questionDescription').focus();
    $('#questionDescription').val($(this).find('#qDescription').val());
    $('#test_name').html('Question');
    $('#test_fn').html('Edit');
    if ($(this).find("#testCategory").val() == "Multiple Choice") {
      $('#qId').val($(this).find("#qId").val());
      $('#test_category').val('multiplechoiceForm');
      var ch1 = $(this).find("#ch1mc"+$(this).find("#qId").val());
      var ch2 = $(this).find("#ch2mc"+$(this).find("#qId").val());
      var ch3 = $(this).find("#ch3mc"+$(this).find("#qId").val());
      var ch4 = $(this).find("#ch4mc"+$(this).find("#qId").val());
      if (ch1.attr('rel') == 1) {
        $('.choice1').prop('checked', 'checked');
      }else if (ch2.attr('rel') == 1) {
        $('.choice2').prop('checked', 'checked');
      }else if (ch3.attr('rel') == 1) {
        $('.choice3').prop('checked', 'checked');
      }else if (ch4.attr('rel') == 1) {
        $('.choice4').prop('checked', 'checked');
      }
      $("#choice1").val((ch1.val()).split('+').join(' '));
      $("#choice1").attr('rel', ch1.attr('class'));
      $("#choice2").val((ch2.val()).split('+').join(' '));
      $("#choice2").attr('rel', ch2.attr('class'));
      $("#choice3").val((ch3.val()).split('+').join(' '));
      $("#choice3").attr('rel', ch3.attr('class'));
      $("#choice4").val((ch4.val()).split('+').join(' '));
      $("#choice4").attr('rel', ch4.attr('class'));
      $("#multiple_choice").show();
    }else if ($(this).find("#testCategory").val() == "True or False") {
      $('#qId').val($(this).find("#qId").val());
      $('#test_category').val('truefalseForm');
      var ch1 = $(this).find("#ch1tf"+$(this).find("#qId").val());
      $("#tfqid").val(ch1.attr('class'));
      if (ch1.val() == "True") {
        $(".true").prop('checked', 'checked');
      }else {
        $(".false").prop('checked', 'checked');
      }
      $("#true_or_false").show();
    }else if ($(this).find("#testCategory").val() == "Enumeration") {
      $('#qId').val($(this).find("#qId").val());
      $('#test_category').val('enumerationForm');
      ansCount = $(this).find("#ansCount").val();
      $("#answer1").val($(this).find("#ch1mc"+$(this).find("#qId").val()).val().split("+").join(" "));
      var ansAppend = "";
      ansAppend += "<input id='answer1id' type='hidden' name='answer1id' value='"+$(this).find("#ch1mc"+$(this).find("#qId").val()).attr('class')+"'>";
      for (var i = 2; i < ansCount; i++) {
        ansAppend += "<div class='input-field col m7 l7 s7'>";
          ansAppend += "<input id='answer"+i+"' type='text' name='answer"+i+"' value='"+$(this).find("#ch"+i+"mc"+$(this).find("#qId").val()).val().split("+").join(" ")+"'>";
          ansAppend += "<input id='answer"+i+"id' type='hidden' name='answer"+i+"id' value='"+$(this).find("#ch"+i+"mc"+$(this).find("#qId").val()).attr('class')+"'>";
        ansAppend += "</div>";
      }
      $(".answers").append(ansAppend);
      $(".addAnswer").hide();
      $("#answer_count").val(ansCount-1);
      $("#enumeration").show();
    }
    $('#qUpdate').show();
  });

  $(document).on('click', '#qUpdate', function(e){
    e.preventDefault();
    var formData = new Object();
    var form = '#'+ $('#test_category').val();
    var answers = $(form).serialize().split('=').join('&');
    formData.q_id = $('#qId').val();
    formData.qDescription = $('#questionDescription').val();
    formData.qCategory = $('#test_category').val();
    answers = answers.split('&');
    for (var i = 0; i < answers.length; i+=2) {
      formData[answers[i]] = answers[i+1];
    }
    if ($('#test_category').val() == 'enumerationForm') {
      formData.enumerationCount = $('#answer_count').val();
    }else if ($('#test_category').val() == 'multiplechoiceForm') {
      formData.choice1id = $('#choice1').attr('rel');
      formData.choice2id = $('#choice2').attr('rel');
      formData.choice3id = $('#choice3').attr('rel');
      formData.choice4id = $('#choice4').attr('rel');
    }
    console.log(formData);
    if (checkFields(formData)) {
      confirmModal('Update Question', 'Are you sure you want to update question?', function(){
        $.ajax({
          url: '../../subtopic/updateQuestion',
          method: 'post',
          data: formData,
          success: function(data){
            $('#questionModal').modal('close');
            alertModal('Update question', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal('Update Question', 'Please fill out the form');
    }
  });

});
