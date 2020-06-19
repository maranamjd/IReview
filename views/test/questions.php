<input type="hidden" id="test_id" value="<?php echo $this->data['test_id']; ?>">
<input type="hidden" id="test_category" value="<?php echo $this->data['testCategory']; ?>">
<input type="hidden" id="testCount">
<a rel="<?php echo URL?>test/view/<?php echo $this->data['test_id']; ?>" class="btn orange left" id="leaveTest"><i class="material-icons">arrow_back</i></a>
<div class="container">
  <div class="row" id="questionDiv">

  </div>
  <div class="row">
    <div class="col s12 m10 l10 offset-m1 offset-l1 test z-depth-4" id="result">
      <div class="row">
        <div class="question">
          <div class="row">
            <div class="col s12 l4 m4 offset-l4 offset-m4">
              <img src="<?php echo URL ?>public/img/ireview4.png" alt="" class="img" width="180px">
            </div>
          </div>
          <hr>
          <div class="col s12 l12 m12">
            <h4><?php echo $this->sessionData['firstname']." ".ucfirst($this->sessionData['middlename'][0]).". ".$this->sessionData['lastname']; ?></h4>
            <br><br>
            <h5><?php echo $this->data['testName'] ?></h5>
            <h6><?php echo $this->data['testCategory'] ?></h6>
            <h6><?php echo date('F d, Y') ?></h6>
          </div>
        </div>
      </div>
      <div class="row">
        <h6 class="center">Test Summary</h6>
        <div class="col s12 m10 l10 offset-m1 offset-l1 z-depth-3">
          <div id="canvas-holder">
            <a href="<?php echo URL?>test/progress/<?php echo $this->data['test_id']; ?>" class="btn blue right tooltiped" data-tooltip="View test results" data-postition="top"><i class="material-icons">details</i></a>
            <canvas id="chart-area"></canvas>

            <h6>Test Result: <i class="btn-small green" id="test_result"></i></h6>
            <br>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m10 l10 offset-m1 offset-l1">
          <a href="<?php echo URL?>test/view/<?php echo $this->data['test_id']; ?>" class="btn green left" style="width: 100%">FINISH</a>
        </div>
      </div>
    </div>
  </div>
</div>
