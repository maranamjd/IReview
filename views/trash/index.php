<div class="container">
  <div class="row">
    <div class="showcase">
      <h3>Trash</h3>
    </div>
  </div>
  <div class="row">
    <ul class="tabs" id="tabs">
      <li class="tab col m4 s4 l4"><a href="#topics">Topics</a></li>
      <li class="tab col m4 s4 l4"><a href="#subtopics">Subtopics</a></li>
      <li class="tab col m4 s4 l4"><a href="#tests">Tests</a></li>
      <!-- <li class="tab col m3 s3 l3"><a href="#questions">Questions</a></li> -->
    </ul>
    <div class="row" id="topics">
      <div class="input-field col s12 m6 l6">
        <input id="searchTopic" type="text" name="search">
        <label for="searchTopic">Search Topic name</label>
      </div>
      <div class="col l12 m12 s12">
        <ul class="collection" id="Topics">
          <div class="center">
            <img class="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
          </div>
        </ul>
      </div>
    </div>
    <div class="row" id="subtopics">
      <div class="input-field col s12 m6 l6">
        <input id="searchSubTopic" type="text" name="search">
        <label for="searchTopic">Search Sub-topic name</label>
      </div>
      <div class="col l12 m12 s12">
        <ul class="collection" id="Subtopics">
          <div class="center">
            <img class="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
          </div>
        </ul>
      </div>
    </div>
    <div class="row" id="tests">
      <div class="input-field col s12 m6 l6">
        <input id="searchTest" type="text" name="search">
        <label for="searchTest">Search Test name</label>
      </div>
      <div class="col l12 m12 s12">
        <ul class="collection" id="Tests">
          <div class="center">
            <img class="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
          </div>
        </ul>
      </div>
    </div>
    <!-- <div class="row" id="questions">
      <div class="input-field col s12 m6 l6">
        <input id="searchQuestion" type="text" name="search">
        <label for="searchQuestion">Search Question name</label>
      </div>
      <div class="col l12 m12 s12">
        <ul class="collection" id="Questions">
          <div class="center">
            <img class="imgLoad" src="<?php echo URL ?>public/img/loading.gif" width="100" height="100">
          </div>
        </ul>
      </div>
    </div> -->
  </div>
</div>
