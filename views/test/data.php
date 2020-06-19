<br>
<a href="<?php echo URL?>test/view/<?php echo $this->data['test']['test_id']; ?>" class="btn orange left"><i class="material-icons">arrow_back</i></a>
<input type="hidden" id="test_id" value="<?php echo $this->data['test']['test_id']; ?>">
<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <?php if(isset($this->data)){ ?>
        <h3><?php echo $this->data['test']['testName']; ?></h3>
        <h6><?php echo $this->data['test']['testCategory']; ?></h6>
      <?php } ?>
    </div>
  </div>
</div>
  <div class="row">
    <div id="admin" class="col s12 m8 l8 offset-m2 offset-l2">
    <div class="card material-table z-depth-3">
      <div class="table-header">
        <span class="table-title">Test Results</span>
        <div class="actions">
          <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
        </div>
      </div>
      <table id="datatable" class="striped">
        <thead>
          <tr>
            <th width="30%">Test ID</th>
            <th width="30%">Date Taken</th>
            <th width="30%">Grade</th>
            <th width="10%">Details</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($this->data['results'])) { ?>
            <?php foreach ($this->data['results'] as $value) { ?>
              <tr>
                <td><?php echo $value['testId']; ?></td>
                <td><?php echo $value['testDate']; ?></td>
                <td><?php echo $value['grade']; ?></td>
                <td><span class="btn btn-floating blue viewDetails" rel="<?php echo $value['r_id']; ?>">
                  <input type="hidden" id="totalItems" value="<?php echo $value['totalItems']; ?>">
                  <input type="hidden" id="score" value="<?php echo $value['score']; ?>">
                  <input type="hidden" id="wrong" value="<?php echo $value['wrong']; ?>">
                  <input type="hidden" id="testId" value="<?php echo $value['testId']; ?>">
                  <input type="hidden" id="grade" value="<?php echo $value['grade']; ?>">
                  <i class="material-icons">camera</i></span>
                </td>
              </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col s12 m4 l4 z-depth-3" id="pieChart" style="display: none">
    <div id="canvas-holder">
      <a class="btn blue right tooltiped" id="closeChart" data-tooltip="Close" data-postition="top"><i class="material-icons">close</i></a>
      <canvas id="chart-area"></canvas>
      <p id="itemCount" style="display: none"></p>
      <p id="itemGrade" style="display: none"></p>
    </div>
  </div>
</div>
