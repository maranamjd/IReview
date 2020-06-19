$(document).ready(function(e){
  // var d = new Date()
  // var token = d.getTime();
  // alert(token);


  $('#sTopicModal').modal({
      onCloseEnd: function(){
        $('#sTopicName').val('');
        $('#submitAdd').attr('style', 'display: none');
        $('#submitEdit').attr('style', 'display: none');
        $('#sTopicOverview').val('');
      }
  });
  $('#topicModal').modal({
      onCloseEnd: function(){
        $('#TEdit').attr('style', 'display: none');
        $('#TAdd').attr('style', 'display: none');
        $('#topicTitle').val('');
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


  function getTopics(searchKey = '*'){
    $.get('topic/view/'+searchKey, function(data){
      var divappend = "<ul id='topicList' class='collapsible popout'>";
      document.getElementById('topics').innerHTML = '';
      for (var topic in data['topic']) {
        divappend += "<li class='topics'>";
        divappend += "<div class='collapsible-header' id='topic"+data['topic'][topic].t_id+"'>";
        divappend += "<div class='col m10 l10 s12'>";
        divappend += "<h3>"+data['topic'][topic].tName+"</h3>";
        divappend += "</div>";
        divappend += "<div class='col m2 l2 topicSettings' style='display: none'>";
        divappend += "<a href='#' class='btn-small btn-floating orange tooltipped topicView' data-position='left' data-tooltip='Edit'>";
        divappend += "<input type='hidden' id='tId' value='"+data['topic'][topic].t_id+"'>";
        divappend += "<input type='hidden' id='tName' value='"+data['topic'][topic].tName+"'>";
        divappend += "<i class='material-icons'>edit</i></a> ";
        divappend += "<a href='#' class='btn-small btn-floating red tooltipped topicDelete' data-position='left' data-tooltip='Delete'>";
        divappend += "<input type='hidden' id='tId' value='"+data['topic'][topic].t_id+"'>";
        divappend += "<i class='material-icons'>delete</i></a> ";
        divappend += "</div>";
        divappend += "</div>";
        divappend += "<div class='collapsible-body'>";
        divappend += "<a class='btn right sTopicModalOpen'>";
        divappend += "<input type='hidden' id='tId' value='"+data['topic'][topic].t_id+"'>";
        divappend += "<input type='hidden' id='tName' value='"+data['topic'][topic].tName+"'>";
        divappend += "<i class='material-icons'>add</i></a><br><br>";
        divappend += "<div class='divider'>";
        divappend += "</div>";
        divappend += "<ul class='collection'>";
        for (var subtopic in data['subtopic']) {
          if(data['subtopic'][subtopic].t_id == data['topic'][topic].t_id){
            divappend += "<li class='collection-item avatar'>";
            divappend += "<div class='col m9 l9 s7'>";
            divappend += "<span class='title'><h5 class='truncate'>"+data['subtopic'][subtopic].stName+"</h5></span>";
            divappend += "<p class='col m9 l9 s10'>";
            divappend += data['subtopic'][subtopic].stOverview;
            divappend += "</p>";
            divappend += "</div>";
            divappend += "<div class='col s5 m3 l3'>";
            divappend += "<a href='subtopic/view/"+data['subtopic'][subtopic].st_id+"' class='btn-small btn-floating green tooltipped sTopicView' data-position='left' data-tooltip='View'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>details</i></a> ";
            divappend += "<a href='#' class='sTopicEdit btn-small btn-floating orange tooltipped' data-position='left' data-tooltip='Edit'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
            divappend += "<input type='hidden' id='TopicName' value='"+data['topic'][topic].tName+"'>";
            divappend += "<input type='hidden' id='sTopicname' value='"+data['subtopic'][subtopic].stName+"'>";
            divappend += "<input type='hidden' id='sTopicoverview' value='"+data['subtopic'][subtopic].stOverview+"'>";
            divappend += "<i class='material-icons'>edit</i></a> ";
            divappend += "<a href='#' class='btn-small btn-floating red tooltipped sTopicDelete' data-position='left' data-tooltip='Delete'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>delete</i></a> ";
            divappend += "</div>";
            divappend += "</li>";
          }
        }
        divappend += "</ul>";
        divappend += "</div>";
        divappend += "</li>";
      }
      divappend += "</ul>";
      document.getElementById('topics').innerHTML = divappend;

      $('.collapsible').collapsible();
      $('.tooltipped').tooltip();

      $('.sTopicModalOpen').click(function(){
        $('#submitAdd').attr('style', 'display: ');
        $('#topicFn').html('Add');
        $('#topicName').html($(this).find('#tName').val());
        $('#topicId').val($(this).find('#tId').val());
        $('#sTopicModal').modal('open');
      });
    }, 'json');

  }
  setTimeout(function(){
    getTopics();
    $('#imgLoad').hide();
  }, 100);


  $(document).on('keyup', '#searchTopic', function(e){
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getTopics(key);
  });

  $('#submitAdd').click(function(e){
    e.preventDefault();
    var stName = $('#sTopicName').val();
    var stOverview = $('#sTopicOverview').val();
    var tId = $('#topicId').val();
    if (stName != '' && stOverview != '') {
      confirmModal('Add Sub-topic', 'Are you sure you want to add sub-topic?', function(){
        $.ajax({
          url: 'topic/addSubtopic',
          method: 'post',
          data: {tId: tId, stName: stName, stOverview: stOverview},
          success: function(data){
            $('#sTopicModal').modal('close');
            alertModal('Add Sub-topic', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal('Add Sub-topic', 'Please fill out the form');
    }
  });


  $('.topicModalOpen').click(function(){
    $('#topicModal').modal('open');
    $('#TAdd').attr('style', 'display: ');
    $('.topicFn').html('Add');
  });

  $(document).on('click', '.topicView', function(e){
    e.preventDefault();
    $('#topicModal').modal('open');
    $('#TEdit').attr('style', 'display: ');
    $('#topicTitle').val($(this).find('#tName').val());
    $('.topicFn').html('Edit');
    $('#topicTitle').focus();
    $('#topicId').val($(this).find('#tId').val());
  });

  $(document).on('click', '#TEdit', function(e){
    e.preventDefault();
    var tId = $('#topicId').val();
    var tName = $('#topicTitle').val();
    if (tId != '' && tName != '') {
      confirmModal('Update Topic', 'Are you sure you want to update Topic?', function(){
        $.ajax({
          url: 'topic/updateTopic',
          method: 'post',
          data: {tId: tId, tName: tName},
          success: function(data){
            $('#topicModal').modal('close');
            alertModal('Update Topic', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal('Update Topic', 'Please fill out the form');
    }
  });

  $(document).on('click', '.topicDelete', function(e){
    e.preventDefault();
    var tId = $(this).find('#tId').val();
    confirmModal('Delete Topic', 'Are you sure you want to delete Topic?', function(){
      $.ajax({
        url: 'topic/deleteTopic',
        method: 'post',
        data: {tId: tId},
        success: function(data){
          $('#topicModal').modal('close');
          alertModal('Delete Topic', data, 2000, function(){
            window.location.reload();
          });
        }
      });
    });
  });
  var cTopic = '';
  $(document).on('click', '.collapsible-header', function(){
    if (cTopic == $(this).attr('id')) {
      cTopic = '';
    }else {
      cTopic = $(this).attr('id');
    }
  });

  $('.topicOrganize').click(function(){
    if (cTopic != '') {
      $('#'+cTopic).click();
      cTopic = '';
    }
    $(this).hide();
    $('#topicList').attr('class', 'collection');
    $('.topicReturn').show('400');
    $('.topicSettings').show('400');
    $('#searchTopic').attr('disabled', true);
    $('.topicModalOpen').attr('disabled', true);
  });
  $('.topicReturn').click(function(){
    if (cTopic != '') {
      $('#'+cTopic).click();
      cTopic = '';
    }
    $(this).hide();
    $('#topicList').attr('class', 'collapsible popout');
    $('.topicOrganize').show('400');
    $('.topicSettings').hide('400');
    $('.topicModalOpen').attr('disabled', false);
    $('#searchTopic').attr('disabled', false);
  });

  $(document).on('click', '#TAdd', function(e){
    e.preventDefault();
    var topicTitle = $('#topicTitle').val();
    if (topicTitle == '') {
      alertModal('Add Topic', 'Please fill out the form');
    }else {
      confirmModal('Add Topic', 'Are you sure you want to add Topic?', function(){
        $.ajax({
          url: 'topic/addTopic',
          method: 'post',
          data: {topicTitle: topicTitle},
          success: function(data){
            $('#topicModal').modal('close');
            alertModal('Add Topic', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }
  });

  $(document).on('click', '.sTopicEdit', function(e){
    e.preventDefault();
    $('#sTopicModal').modal('open');
    $('#submitEdit').attr('style', 'display: ');
    $('#topicName').html($(this).find('#TopicName').val());
    $('#topicFn').html('Edit');
    $('#sTopicName').focus();
    $('#sTopicName').val($(this).find('#sTopicname').val());
    $('#sTopicOverview').focus();
    $('#sTopicOverview').val($(this).find('#sTopicoverview').val());
    $('#topicId').val($(this).find('#sTopicId').val());
  });

  $(document).on('click', '#submitEdit', function(e){
    e.preventDefault();
    var stName = $('#sTopicName').val();
    var stOverview = $('#sTopicOverview').val();
    var stId = $('#topicId').val();
    if (stName != '' && stOverview != '') {
      confirmModal('Update Sub-topic', 'Are you sure you want to Update sub-topic?', function(){
        $.ajax({
          url: 'topic/updateSubtopic',
          method: 'post',
          data: {stId: stId, stName: stName, stOverview: stOverview},
          success: function(data){
            $('#sTopicModal').modal('close');
            alertModal('Update Sub-topic', data, 2000, function(){
              window.location.reload();
            });
          }
        });
      });
    }else {
      alertModal('Update Sub-topic', 'Please fill out the form');
    }
  });

  $(document).on('click', '.sTopicDelete', function(e){
    e.preventDefault();
    var stId = $(this).find('#sTopicId').val();
    confirmModal('Delete Sub-Topic', 'Are you sure you want to delete Sub-Topic?', function(){
      $.ajax({
        url: 'topic/deleteSubtopic',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          $('#sTopicModal').modal('close');
          alertModal('Delete Sub-topic', data, 2000, function(){
            window.location.reload();
          });
        }
      });
    });
  });

  $(document).on('click', '.sTopicAddToFav', function(e){
    e.preventDefault();
    var me = $(this);
    var stId = me.find('#sTopicId').val();
      $.ajax({
        url: 'topic/addSubtopicToFav',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          if (data) {
            me.removeClass();
            me.addClass('btn-small btn-floating yellow tooltipped sTopicRemoveFromFav');
            me.attr('data-tooltip', 'Remove from Favorites');
            $('#toastadd').click();
          }else {
            $('#toastaddfail').click();
          }
        }
      });
  });
  $(document).on('click', '.sTopicRemoveFromFav', function(e){
    e.preventDefault();
    var me = $(this);
    var stId = me.find('#sTopicId').val();
      $.ajax({
        url: 'topic/removeSubtopicFromFav',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          if (data) {
            me.removeClass();
            me.addClass('btn-small btn-floating blue tooltipped sTopicAddToFav');
            me.attr('data-tooltip', 'Add to Favorites');
            $('#toastremove').click();
          }else {
            $('#toastremovefail').click();
          }
        }
      });
  });

});
