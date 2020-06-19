<div class="row">
  <div class="col s12 m10 l10 offset-m1 offset-l1 z-depth-2">
    <div class="card">
      <div class="card-image z-depth-2">
        <img src="<?php echo URL ?>public/img/<?php echo $this->sessionData['ubackground']; ?>" alt="" width="500px" height="400px">
        <span class="card-title">
          <div class="col s4 m5 l5">
            <div class="hovereffect">
                <img src="<?php echo URL ?>public/img/<?php echo $this->sessionData['uimage']; ?>" class="circle" alt="">
              <div class="overlay circle">
                <label class="custom-file-upload info" for="changeprofile">
                  <input type="file" name="image" id="changeprofile">
                  <span class="material-icons">camera_alt</span>
                  </label>
              </div>
            </div>
          </div>
          <div class="col s12 m8 l8">
            <br>
            <h4><?php echo $this->sessionData['firstname']." ".$this->sessionData['middlename'][0].". ".$this->sessionData['lastname'] ?></h4>
          </div>
        </span>
      </div>
    </div>
    <ul class="tabs" id="tabs">
      <li class="tab col m6 s6 l6"><a href="#info">INFO</a></li>
      <li class="tab col m6 s6 l6"><a href="#password">PASSWORD</a></li>
    </ul>
    <div class="row" id="info">
      <div class="card-content">
        <br><br><br><br>
        <div class="container">
          <div class="row">
            <div class="col s12 m6 l6">
              <div class="input-field">
                <input type="text" name="fname" id="fname" value="<?php echo $this->sessionData['firstname']; ?>">
                <label for="fname">First Name</label>
              </div>
              <div class="input-field">
                <input type="text" name="mname" id="mname" value="<?php echo $this->sessionData['middlename']; ?>">
                <label for="mname">Middle Name</label>
              </div>
              <div class="input-field">
                <input type="text" name="lname" id="lname" value="<?php echo $this->sessionData['lastname']; ?>">
                <label for="lname"> Last Name</label>
              </div>
            </div>
            <div class="col s12 m6 l6">
              <div class="right">
                <a id="saveInfo" class="btn-small blue">Save</a>
                <a id="cancel" class="btn-small">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="password">
      <div class="card-content">
        <br><br><br><br>
        <div class="container">
          <div class="row">
            <div class="col s12 m6 l6">
              <div class="input-field">
                <input type="password" name="password" id="pass" value="" class="validate" pattern=".{8,}" autofocus>
                <label for="password">Password</label>
                <span class="helper-text" data-error="password must be atleast 8 characters long"></span>
              </div>
              <div class="input-field">
                <input type="password" name="confirm" id="confirm" value="">
                <label for="confirm">Confirm Password</label>
              </div>
              <label>
                <input type='checkbox' name='skip' class='filled-in skip' value='' id="showPass">
                <span>Show Password</span>
              </label>
            </div>
            <div class="col s12 m6 l6">
              <div class="right">
                <a id="savePassword" class="btn-small blue" disabled>Save</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
