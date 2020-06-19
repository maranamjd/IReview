$(document).ready(function(e){
  $('#msgModal').modal();
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
  function getSubtopicTrash(searchKey = '*'){
    $.get('trash/subtopic/'+searchKey, function(data){
      var divappend = "";
      document.getElementById('Subtopics').innerHTML = '';
        for (var subtopic in data) {
            divappend += "<li class='collection-item avatar'>";
            divappend += "<div class='col m9 l9 s7'>";
            divappend += "<span class='title'><h5 class='truncate'>"+data[subtopic].stName+"</h5>";
            divappend += "<p class='truncate col m9 l9 s10'>";
            divappend += data[subtopic].stOverview;
            divappend += "</p>";
            divappend += "</div>";
            divappend += "</span>";
            divappend += "<div class='col s5 m3 l3'>";
            divappend += "<a href='#' class='btn-small btn-floating pink tooltipped sTopicRestore' data-position='left' data-tooltip='Restore'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>restore</i></a> ";
            divappend += "<a href='#' class='btn-small btn-floating red tooltipped sTopicDelete' data-position='left' data-tooltip='Delete'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>delete</i></a> ";
            divappend += "</div>";
            divappend += "</li>";
        }
        document.getElementById('Subtopics').innerHTML = divappend;
      }, 'json');
  }

  function getTopicTrash(searchKey = '*'){
    $.get('trash/topic/'+searchKey, function(data){
      var divappend = "";
      document.getElementById('Topics').innerHTML = '';
        for (var topic in data) {
            divappend += "<li class='collection-item avatar'>";
            divappend += "<div class='col m9 l9 s7'>";
            divappend += "<span class='title'><h5 class=''>"+data[topic].tName+"</h5></span>";
            divappend += "</div>";
            divappend += "<div class='col s5 m3 l3'>";
            divappend += "<a href='#' class='btn-small btn-floating pink tooltipped TopicRestore' data-position='left' data-tooltip='Restore'>";
            divappend += "<input type='hidden' id='TopicId' value='"+data[topic].t_id+"'>";
            divappend += "<i class='material-icons'>restore</i></a> ";
            divappend += "<a href='#' class='btn-small btn-floating red tooltipped TopicDelete' data-position='left' data-tooltip='Delete'>";
            divappend += "<input type='hidden' id='TopicId' value='"+data[topic].t_id+"'>";
            divappend += "<i class='material-icons'>delete</i></a> ";
            divappend += "</div>";
            divappend += "</li>";
        }
        document.getElementById('Topics').innerHTML = divappend;
      }, 'json');
  }

  function getTestTrash(searchKey = '*'){
    $.get('trash/test/'+searchKey, function(data){
      var divappend = "";
      document.getElementById('Tests').innerHTML = '';
        for (var subtopic in data) {
          for (var test in data[subtopic]) {
            divappend += "<li class='collection-item avatar'>";
            divappend += "<div class='col m9 l9 s7'>";
            divappend += "<span class='title'><h5 class='truncate'>"+data[subtopic][test].stName+"</h5></span>";
            divappend += "<p class='truncate col m9 l9 s10'>";
            divappend += "<strong>"+ data[subtopic][test].testName + "</strong> | ";
            divappend += data[subtopic][test].testCategory;
            divappend += "</p>";
            divappend += "</div>";
            divappend += "<div class='col s5 m3 l3'>";
            divappend += "<a href='#' class='btn-small btn-floating pink tooltipped testRestore' data-position='left' data-tooltip='Restore'>";
            divappend += "<input type='hidden' id='testId' value='"+data[subtopic][test].test_id+"'>";
            divappend += "<i class='material-icons'>restore</i></a> ";
            divappend += "<a href='#' class='btn-small btn-floating red tooltipped testDelete' data-position='left' data-tooltip='Delete'>";
            divappend += "<input type='hidden' id='testId' value='"+data[subtopic][test].test_id+"'>";
            divappend += "<i class='material-icons'>delete</i></a> ";
            divappend += "</div>";
            divappend += "</li>";
          }
        }
        document.getElementById('Tests').innerHTML = divappend;
      }, 'json');
  }

  // function getQuestionTrash(searchKey = '*'){
  //   $.get('trash/question/'+searchKey, function(data){
  //     var divappend = "";
  //     document.getElementById('Questions').innerHTML = '';
  //       for (var subtopic in data) {
  //           divappend += "<li class='collection-item avatar'>";
  //           divappend += "<div class='col m9 l9 s7'>";
  //           divappend += "<span class='title'><h5 class='truncate'>"+data[subtopic].stName+"</h5></span>";
  //           divappend += "<p class='truncate col m9 l9 s10'>";
  //           divappend += data[subtopic].stOverview;
  //           divappend += "</p>";
  //           divappend += "</div>";
  //           divappend += "<div class='col s5 m3 l3'>";
  //           divappend += "<a href='#' class='btn-small btn-floating pink tooltipped sTopicRestore' data-position='left' data-tooltip='Restore'>";
  //           divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
  //           divappend += "<i class='material-icons'>restore</i></a> ";
  //           divappend += "<a href='#' class='btn-small btn-floating red tooltipped sTopicDelete' data-position='left' data-tooltip='Delete'>";
  //           divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
  //           divappend += "<i class='material-icons'>delete</i></a> ";
  //           divappend += "</div>";
  //           divappend += "</li>";
  //       }
  //       document.getElementById('Questions').innerHTML = divappend;
  //     }, 'json');
  // }
  $(document).on('keyup', '#searchSubTopic', function(e){
    e.preventDefault();
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getSubtopicTrash(key);
  });
  $(document).on('keyup', '#searchTopic', function(e){
    e.preventDefault();
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getTopicTrash(key);
  });
  $(document).on('keyup', '#searchTest', function(e){
    e.preventDefault();
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getTestTrash(key);
  });
  // $(document).on('keyup', '#searchQuestion', function(e){
  //   e.preventDefault();
  //   var key = $(this).val();
  //   if (key == '') {
  //     key = '*';
  //   }
  //   getQuestionTrash(key);
  // });


  setTimeout(function(){
    getSubtopicTrash();
    getTopicTrash();
    getTestTrash();
    $('.imgLoad').hide();
  }, 100);


  $(document).on('click', '.sTopicRestore', function(e){
    e.preventDefault();
    var stId = $(this).find('#sTopicId').val();
    confirmModal('Restore Sub-Topic from Trash', 'Are you sure you want to restore Sub-Topic?', function(){
      $.ajax({
        url: 'trash/restoreSubTopic',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Restore Sub-Topic from Trash', data, 2000, function(){
            getSubtopicTrash();
          });
        }
      });
    });
  });

  $(document).on('click', '.sTopicDelete', function(e){
    e.preventDefault();
    var stId = $(this).find('#sTopicId').val();
    confirmModal('Delete Sub-Topic from Trash', 'Delete Sub-topic permanently?', function(){
      $.ajax({
        url: 'trash/deleteSubTopic',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Delete Sub-Topic from Trash', data, 2000, function(){
            getSubtopicTrash();
          });
        }
      });
    });
  });

  $(document).on('click', '.TopicRestore', function(e){
    e.preventDefault();
    var tId = $(this).find('#TopicId').val();
    confirmModal('Restore Topic from Trash', 'Are you sure you want to restore Topic?', function(){
      $.ajax({
        url: 'trash/restoreTopic',
        method: 'post',
        data: {tId: tId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Restore Topic from Trash', data, 2000, function(){
            getTopicTrash();
          });
        }
      });
    });
  });

  $(document).on('click', '.TopicDelete', function(e){
    e.preventDefault();
    var tId = $(this).find('#TopicId').val();
    confirmModal('Delete Topic from Trash', 'Delete topic permanently?', function(){
      $.ajax({
        url: 'trash/deleteTopic',
        method: 'post',
        data: {tId: tId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Delete Topic from Trash', data, 2000, function(){
            getTopicTrash();
          });
        }
      });
    });
  });

  $(document).on('click', '.testRestore', function(e){
    e.preventDefault();
    var testId = $(this).find('#testId').val();
    confirmModal('Restore test from Trash', 'Are you sure you want to restore test?', function(){
      $.ajax({
        url: 'trash/restoreTest',
        method: 'post',
        data: {testId: testId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Restore test from Trash', data, 2000, function(){
            getTestTrash();
          });
        }
      });
    });
  });

  $(document).on('click', '.testDelete', function(e){
    e.preventDefault();
    var testId = $(this).find('#testId').val();
    confirmModal('Delete test from Trash', 'Delete test permanently?', function(){
      $.ajax({
        url: 'trash/deleteTest',
        method: 'post',
        data: {testId: testId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Delete test from Trash', data, 2000, function(){
            getTestTrash();
          });
        }
      });
    });
  });

});
