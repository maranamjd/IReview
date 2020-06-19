<br>
<a href="<?php echo URL?>topic" class="btn orange left"><i class="material-icons">arrow_back</i></a>
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

<div class="fixed-action-btn">
  <a class="btn-floating btn-large green">
    <i class="large material-icons">menu</i>
  </a>
  <ul>
    <li><a class="tooltipped btn-floating blue testAdd" data-position="left" data-tooltip="Add Test"><input type="hidden" id="stId" value="<?php echo $this->data[0]['st_id'] ?>"><i class="material-icons">add</i></a></li>
    <li><a class="tooltipped btn-floating orange testOrganize" data-position="left" data-tooltip="Test Settings"><i class="material-icons">settings</i></a></li>
    <li><a class="tooltipped btn-floating orange testReturn" data-position="left" data-tooltip="Done" style="display: none"><i class="material-icons">check</i></a></li>
  </ul>
</div>

<div class="modal modal-fixed-footer" id="questionModal">
  <div class="modal-content">
    <h4 id="test_name"></h4>
    <h6 id="test_fn"></h6><br><br>
      <div class="row">
        <div class="input-field">
          <textarea id="questionDescription" name="qDescription" class="materialize-textarea" required></textarea>
          <label for="qDescription">Question</label>
        </div>
      </div>
      <form action="#" method="post" id="enumerationForm">
        <div class="row" id="enumeration" style="display: none">
          <h6>Answers</h6>
          <div class="answers">
            <div class='input-field col m7 l7 s7'>
              <input id="answer1" type="text" name="answer1" value=''>
            </div>
          </div>
          <div class="input-field col m7 l7 s7">
            <span class="btn blue tooltipped addAnswer" data-position="left" data-tooltip="Add Textfield"><i class="material-icons">add</i></span>
          </div>
          <input type="hidden" id="answer_count" value="1">
        </div>
      </form>
      <form action="#" method="post" id="truefalseForm">
        <div class="row" id="true_or_false" style="display: none">
          <h6>Answer</h6>
          <div class="col m5 l5 s5">
            <p>
              <label>
                <input class="with-gap true" type="radio" name="answer" value="True" checked>
                <span>TRUE</span>
              </label>
            </p>
          </div>
          <div class="col m5 l5 s5">
            <p>
              <label>
                <input class="with-gap false" type="radio" name="answer" value="False">
                <span>FALSE</span>
              </label>
            </p>
          </div>
          <input type="hidden" name="tfqid" id="tfqid">
        </div>
      </form>

      <form action="#" method="post" id="multiplechoiceForm">
        <div class="row" id="multiple_choice" style="display: none">
        <h6>Choices</h6>
          <div class="col m1 l1 s1">
            <p>
              <label>
                <input class="with-gap choice1" type="radio" name="answer" value="choice1" checked>
                <span>A</span>
              </label>
            </p>
          </div>
          <div class="input-field col m5 l5 s5">
            <input id="choice1" type="text" name="choice1" value="">
          </div>
          <div class="col m1 l1 s1">
            <p>
              <label>
                <input class="with-gap choice2" type="radio" name="answer" value="choice2">
                <span>B</span>
              </label>
            </p>
          </div>
          <div class="input-field col m5 l5 s5">
            <input id="choice2" type="text" name="choice2" value="">
          </div>
          <div class="input-field col m1 l1 s1">
            <p>
              <label>
                <input class="with-gap choice3" type="radio" name="answer" value="choice3">
                <span>C</span>
              </label>
            </p>
          </div>
          <div class="input-field col m5 l5 s5">
            <input id="choice3" type="text" name="choice3" value="">
          </div>
          <div class="input-field col m1 l1 s1">
            <p>
              <label>
                <input class="with-gap choice4" type="radio" name="answer" value="choice4">
                <span>D</span>
              </label>
            </p>
          </div>
          <div class="input-field col m5 l5 s5">
            <input id="choice4" type="text" name="choice4" value="">
          </div>
        </div>
      </form>
      <input id="test_id" type="hidden" name="test_id">
      <input id="qId" type="hidden" name="q_id">
      <input id="test_category" type="hidden" name="test_category">
  </div>
  <div class="modal-footer">
    <a id="qAdd" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="qUpdate" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="qCancel" class="modal-close waves-effect waves-light btn-flat">Cancel</a>
  </div>
</div>

<div class="modal modal-fixed-footer" id="testModal">
  <div class="modal-content">
    <h4 class="testName">Test</h4>
    <h6 class="testFn"></h6><br><br>
    <form action="#" method="post">
      <div class="input-field">
        <input id="testName" type="text" name="topicTitle" required>
        <label for="testName">Test Name</label>
      </div><br>
      <div class="input-field">
        <select id="testCategory" name="testCategory" required >
          <option value="default" disabled selected>Choose Category</option>
          <option value="Multiple Choice">Multiple Choice</option>
          <option value="True or False">True or False</option>
          <option value="Enumeration">Enumeration</option>
        </select>
        <label for="testName">Category</label>
      </div>
      <input id="st_id" type="hidden" name="st_id">
      <input id="test_id" type="hidden" name="test_id">
    </form>
  </div>
  <div class="modal-footer">
    <a id="testAdd" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="testUpdate" class="modal-submit waves-effect waves-light btn blue" style="display: none">Submit</a>
    <a id="testCancel" class="modal-close waves-effect waves-light btn-flat">Cancel</a>
  </div>
</div>
