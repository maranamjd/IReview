<br>
<a href="<?php echo URL?>subtopics/view/<?php echo $this->data[0]['st_id']; ?>" class="btn orange left"><i class="material-icons">arrow_back</i></a>
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
  <div class="row options">
    <a rel="<?php echo URL ?>test/take/<?php echo $this->data[0]['test_id'] ?>" id="takeTest">
      <div class="col m2 l2 s5 offset-m3 offset-l3 blue testitem z-depth-3 btn">
        Take Test
        <img src="<?php echo URL ?>public/img/take.png" alt="">
      </div>
    </a>
    <a href="<?php echo URL ?>test/data/<?php echo $this->data[0]['test_id'] ?>" id="">
      <div class="col m2 l2 s5 green testitem z-depth-3 btn">
        Test Data
        <img src="<?php echo URL ?>public/img/data.png" alt="">
      </div>
    </a>
    <a href="<?php echo URL ?>test/progress/<?php echo $this->data[0]['test_id'] ?>" id="">
      <div class="col m2 l2 s5 pink testitem z-depth-3 btn">
        Test Progress
        <img src="<?php echo URL ?>public/img/progress.png" alt="">
      </div>
    </a>
  </div>
</div>
