<div class="modal modal-fixed-footer" id="msgModal">
  <div class="modal-content">
    <h4 id="msgTitle"></h4><br>
    <h5 id="msgBody" class="center"></h5>
    <div id="guidelines" style="display:none;">
      <h5>1. You can only take a test once a day.</h5>
      <h5>2. Carefully select your answer then click next to proceed to the next question.</h5>
      <h5>3. Skipped questions will re-appear after all other question is answered.</h5>
      <h5>4. Test result will show once all questions are answered.</h5>
      <h5>5. Leaving test will discard your test progress.</h5>
      <br>
      <label>
        <input type='checkbox' name='skip' class='filled-in skip' value='' id="read">
        <span>I have read and understood the guidelines</span>
      </label>
    </div>
    <div class="row" style="display: none" id="modalimg">
      <div id="modalBody" class="col s6 m6 l6 offset-s4 offset-l4 offset-m4">

      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a id="msgModalOk" class="modal-submit waves-effect waves-light blue btn" autofocus>Continue</a>
    <a id="msgModalCancel" class="modal-close waves-effect waves-light btn-flat">Cancel</a>
  </div>
</div>
