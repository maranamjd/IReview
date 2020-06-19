<div class="navbar-fixed">
  <nav class="blue z-depth-0">
    <div class="nav-wrapper">
      <div class="row">
        <div class="col s12">
          <a href="#" data-target="mobile-view" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <a href="<?php echo URL; ?>" class="brand-logo"><img src="<?php echo URL; ?>public/img/ireview4.png" width="150" height="80" alt=""></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="<?php echo URL ?>">Home</a></li>
          </ul>
        </div>
      </div>
      <ul class="sidenav" id="mobile-view">
        <li><a href="<?php echo URL ?>">Home</a></li>
      </ul>
    </div>
  </nav>
</div>
<div class="container">
  <div class="row">
    <div class="login col m5 offset-m4 s12 l5 offset-l4 z-depth-5">
      <div class="login-content">
        <div class="row">
          <div class="section col s12 m12 l12">
            <h3>Review</h3>
            <p>Your reviewer</p>
          </div>
        </div>
        <ul class="tabs" id="tabs">
          <li class="tab col m6 s6 l6"><a href="#signin">LogIn</a></li>
          <li class="tab col m6 s6 l6"><a href="#signup">Sign Up</a></li>
        </ul>
        <div class="row" id="signin">
          <br><br>
          <div class="login-form col s12 m12 l12">
            <br>
            <div class="input-field">
              <input id="username" type="text" name="username" class="" required>
              <label for="username">Username</label>
            </div>
            <div class="input-field">
              <input id="password" type="password" name="password" class="" required>
              <label for="password">Password</label>
            </div>
            <label>
              <input type='checkbox' name='skip' class='filled-in skip' value='' id="showPass">
              <span>Show Password</span>
            </label>
            <br><br><br>
            <button id="login" name="submit" class="btn waves-effect waves-light">LOGIN</button>
          </div>
        </div>
        <div class="row" id="signup">
          <div class="login-form col s12 m12 l12">
              <div class="input-field">
                <input id="firstname" type="text" name="firstname" class="" required>
                <label for="firstname">First Name</label>
              </div>
              <div class="input-field">
                <input id="middlename" type="text" name="middlename" class="" required>
                <label for="middlename">Middle Name</label>
              </div>
              <div class="input-field">
                <input id="lastname" type="text" name="lastname" class="" required>
                <label for="lastname">Last Name</label>
              </div>
              <div class="input-field">
                <input id="uname" type="text" name="uname" class="" required>
                <label for="uname">Username</label>
              </div>
              <button id="register" name="register" class="btn waves-effect waves-light">Register</button>
          </div>
        </div>
      </div>
    </div>
    <a id="toast" onclick="M.toast({html: 'Username or Password do not match!'})" class="btn" style="visibility: hidden">toast</a>
    <a id="toast3" onclick="M.toast({html: 'Account Inactive! Please contact Administrator!'})" class="btn" style="visibility: hidden">toast</a>
    <a id="toast2" onclick="M.toast({html: 'Please fill up the form!'})" class="btn" style="visibility: hidden">toast</a>
  </div>
</div>
