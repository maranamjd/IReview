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
<a id="toastadd" onclick="M.toast({html: 'Sub topic added to favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastremove" onclick="M.toast({html: 'Sub topic removed from favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastaddfail" onclick="M.toast({html: 'Failed to add sub topic to favorites'})" class="btn" style="visibility: hidden">toast</a>
<a id="toastremovefail" onclick="M.toast({html: 'Failed to remove sub topic from favorites'})" class="btn" style="visibility: hidden">toast</a>
