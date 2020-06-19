<div class="container">
  <div class="row">
    <div class="showcase col s12 m12 l12">
      <h3>Topics</h3>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input id="searchTopic" type="text" name="search" class="autocomplete">
      <label for="searchTopic">Search topic name</label>
    </div>
  </div>
  <div class="row">
    <div id="topics">
      <div class="center">
        <img id="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
      </div>
    </div>
  </div>
</div>

<div class="fixed-action-btn">
  <a class="btn-floating btn-large green">
    <i class="large material-icons">menu</i>
  </a>
  <ul>
    <li><a class="tooltipped btn-floating blue topicModalOpen" data-position="left" data-tooltip="Add Topic"><i class="material-icons">add</i></a></li>
    <li><a class="tooltipped btn-floating orange topicOrganize" data-position="left" data-tooltip="Topics Settings"><i class="material-icons">settings</i></a></li>
    <li><a class="tooltipped btn-floating orange topicReturn" data-position="left" data-tooltip="Done" style="display: none"><i class="material-icons">check</i></a></li>
  </ul>
</div>

<div class="modal modal-fixed-footer" id="topicModal">
  <div class="modal-content">
    <h4 class="topicName">Topic</h4>
    <h6 class="topicFn"></h6><br><br>
    <form action="#" method="post">
      <div class="input-field">
        <input id="topicTitle" type="text" name="topicTitle" required>
        <label for="topicTitle">Topic Title</label>
      </div>
      <input id="topicId" type="hidden" name="tId">
    </form>
  </div>
  <div class="modal-footer">
    <a id="TAdd" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="TEdit" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="Tcancel" class="modal-close waves-effect waves-light btn-flat">Cancel</a>
  </div>
</div>


<div class="modal modal-fixed-footer" id="sTopicModal">
  <div class="modal-content">
    <h4 id="topicName"></h4>
    <h6 id="topicFn"></h6><br><br>
    <form action="#" method="post">
      <div class="input-field">
        <input id="sTopicName" type="text" name="sTopicName" required>
        <label for="sTopicName">Sub-Topic</label>
      </div>
      <div class="input-field">
        <textarea id="sTopicOverview" name="overview" class="materialize-textarea" required></textarea>
        <label for="overview">Overview</label>
      </div>
      <input id="topicId" type="hidden" name="topicId">
    </form>
  </div>
  <div class="modal-footer">
    <a id="submitAdd" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="submitEdit" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="cancel" class="modal-close waves-effect waves-light btn-flat">Cancel</a>
  </div>
</div>
<a id="toastadd" onclick="M.toast({html: 'Sub topic added to favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastremove" onclick="M.toast({html: 'Sub topic removed from favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastaddfail" onclick="M.toast({html: 'Failed to add sub topic to favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastremovefail" onclick="M.toast({html: 'Failed to remove sub topic from favorites'})" class="btn" style="visibility: hidden">toast</a>
