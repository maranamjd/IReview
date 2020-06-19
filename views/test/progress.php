<br>
<a href="<?php echo URL?>test/view/<?php echo $this->data[0]['test_id']; ?>" class="btn orange left"><i class="material-icons">arrow_back</i></a>
<input type="hidden" id="test_id" value="<?php echo $this->data[0]['test_id']; ?>">
<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <?php if(isset($this->data)){ ?>
        <h3><?php echo $this->data[0]['testName']; ?></h3>
        <h6><?php echo $this->data[0]['testCategory']; ?></h6>
      <?php } ?>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m10 l10 offset-m1 offset-l1 z-depth-3">
      <a class="btn red right tooltiped" id="export" data-tooltip="Export" data-postition="top"><i class="material-icons">insert_drive_file</i></a>
      <canvas id="canvas" style="-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;"></canvas>
      <progress id="animationProgress" max="1" value="0" style="width: 100%"></progress><br><br>
    </div>
  </div>
</div>
