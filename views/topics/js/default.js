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
    $.get('topics/view/'+searchKey, function(data){
      var divappend = "<ul id='topicList' class='collapsible popout'>";
      document.getElementById('topics').innerHTML = '';
      for (var topic in data['topic']) {
        divappend += "<li class='topics'>";
        divappend += "<div class='collapsible-header' id='topic"+data['topic'][topic].t_id+"'>";
        divappend += "<div class='col m10 l10 s12'>";
        divappend += "<h3>"+data['topic'][topic].tName+"</h3>";
        divappend += "</div>";
        divappend += "</div>";
        divappend += "<div class='collapsible-body'>";
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
            divappend += "<a href='subtopics/view/"+data['subtopic'][subtopic].st_id+"' class='btn-small btn-floating green tooltipped sTopicView' data-position='left' data-tooltip='View'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>details</i></a> ";
            if (data['favorites'].length > 0) {
              for (var favorites in data['favorites']) {
                var isFav = 0;
                if(data['favorites'][favorites].st_id == data['subtopic'][subtopic].st_id){
                  divappend += "<a href='#' class='btn-small btn-floating yellow tooltipped sTopicRemoveFromFav' data-position='left' data-tooltip='Remove from Favorites'>";
                  divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
                  divappend += "<i class='material-icons'>grade</i></a><br> ";
                  isFav++;
                  break;
                }
              }
              if (isFav == 0) {
                divappend += "<a href='#' class='btn-small btn-floating blue tooltipped sTopicAddToFav' data-position='left' data-tooltip='Add to Favorites'>";
                divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
                divappend += "<i class='material-icons'>grade</i></a><br> ";
              }
            }else {
              divappend += "<a href='#' class='btn-small btn-floating blue tooltipped sTopicAddToFav' data-position='left' data-tooltip='Add to Favorites'>";
              divappend += "<input type='hidden' id='sTopicId' value='"+data['subtopic'][subtopic].st_id+"'>";
              divappend += "<i class='material-icons'>grade</i></a><br> ";
            }
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

  $(document).on('click', '.sTopicAddToFav', function(e){
    e.preventDefault();
    var me = $(this);
    var stId = me.find('#sTopicId').val();
      $.ajax({
        url: 'topics/addSubtopicToFav',
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
        url: 'topics/removeSubtopicFromFav',
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
