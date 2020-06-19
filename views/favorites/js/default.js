$(document).ready(function(){

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

  function getFavorites(searchKey = '*'){
    $.get('favorites/view/'+searchKey, function(data){
      var divappend = "";
      document.getElementById('subTopics').innerHTML = '';
        for (var subtopic in data) {
            divappend += "<li class='collection-item avatar'>";
            divappend += "<div class='col m9 l9 s8'>";
            divappend += "<span class='title'><h5 class='truncate'>"+data[subtopic].stName+"</h5></span>";
            divappend += "<p class='truncate col m9 l9 s10'>";
            divappend += data[subtopic].stOverview;
            divappend += "</p>";
            divappend += "</div>";
            divappend += "<div class='col s4 m3 l3'>";
            divappend += "<a href='subtopics/view/"+data[subtopic].st_id+"' class='btn-small btn-floating green tooltipped sTopicView' data-position='left' data-tooltip='View'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>details</i></a> ";
            divappend += "<a href='#' class='btn-small btn-floating yellow tooltipped sTopicRemoveFromFav' data-position='left' data-tooltip='Remove from Favorites'>";
            divappend += "<input type='hidden' id='sTopicId' value='"+data[subtopic].st_id+"'>";
            divappend += "<i class='material-icons'>grade</i></a><br> ";
            divappend += "</div>";
            divappend += "</li>";
        }
        document.getElementById('subTopics').innerHTML = divappend;
      }, 'json');
  }
  setTimeout(function(){
    getFavorites();
    $('#imgLoad').hide();
  }, 100);

  $(document).on('keyup', '#searchTopic', function(e){
    e.preventDefault();
    var key = $(this).val();
    if (key == '') {
      key = '*';
    }
    getFavorites(key);
  });


  $(document).on('click', '.sTopicRemoveFromFav', function(e){
    e.preventDefault();
    var me = $(this);
    var stId = me.find('#sTopicId').val();
      $.ajax({
        url: 'favorites/removeSubtopicFromFav',
        method: 'post',
        data: {stId: stId},
        success: function(data){
          if (data) {
            getFavorites();
          }else {
            $('#toastremovefail').click();
          }
        }
      });
  });



});
