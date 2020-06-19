<div class="container">
  <br>
  <div class="row">
    <ul class="tabs" id="tabs">
      <li class="tab col m6 s6 l6"><a href="#questions">QUESTIONS</a></li>
      <li class="tab col m6 s6 l6"><a href="#results">EXAM RESULTS</a></li>
    </ul>
  </div>
  <div class="row">
    <br>
    <div class="input-field col s12 m4 l4 right">
      <select id="testCategory" name="testCategory" required >
        <option value="default" disabled selected>Test Category</option>
        <option value="*">All</option>
        <option value="Multiple Choice">Multiple Choice</option>
        <option value="True or False">True or False</option>
        <option value="Enumeration">Enumeration</option>
      </select>
    </div>
  </div>
  <div class="row" id="questions">
    <div class="questions col s12 m12 l12 z-depth-2">
      <div id="qcontainer">
        <a class="btn red right tooltiped" id="exportQuestions" data-tooltip="Export" data-postition="top"><i class="material-icons">insert_drive_file</i></a>
    		<canvas id="qcanvas" style="-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;"></canvas>
    	</div>
    </div>
  </div>
  <div class="row" id="results">
    <div class="results col s12 m12 l12 z-depth-2">
      <div id="rcontainer">
        <a class="btn red right tooltiped" id="exportResults" data-tooltip="Export" data-postition="top"><i class="material-icons">insert_drive_file</i></a>
    		<canvas id="rcanvas" style="-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;"></canvas>
    	</div>
    </div>
  </div>
</div>
