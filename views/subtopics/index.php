<br>
<a href="<?php echo URL?>topics" class="btn orange left"><i class="material-icons">arrow_back</i></a>
<input type="hidden" id="st_id" value="<?php echo $this->data[0]['st_id']; ?>">
<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <?php if(isset($this->data)){ ?>
        <h3><?php echo $this->data[0]['stName']; ?></h3>
        <h6><?php echo $this->data[0]['stOverview']; ?></h6>
      <?php } ?>
    </div>
    <div class="row">
      <div class="input-field col s12 m6 l6">
        <input id="searchTopic" type="text" name="search">
        <label for="searchTopic">Search test name</label>
      </div>
    </div>
    <div class="row">
      <div class="col s12 m12 l12" id="tests">
        <div class="center">
          <img id="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
        </div>
      </div>
    </div>
  </div>
</div>
