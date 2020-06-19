<div class="navbar-fixed">
  <nav class="blue z-depth-0">
    <div class="nav-wrapper">
      <div class="row">
        <div class="col s12">
          <a href="#" data-target="mobile-view" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <a href="<?php echo URL; ?>" class="brand-logo"><img src="<?php echo URL; ?>public/img/ireview4.png" width="150" height="80" alt=""></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="<?php echo URL ?>login">Login</a></li>
          </ul>
        </div>
      </div>
      <ul class="sidenav" id="mobile-view">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="<?php echo URL ?>login">Login</a></li>
      </ul>
    </div>
  </nav>
</div>
<div class="row carouselcol m6">
  <div class="col m10 offset-m1">
    <div class="carousel carousel-slider">
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_categories.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_mc.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_en.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_tf.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_progress.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_data.png"></a>
      <a class="carousel-item" href="#"><img src="<?php echo URL ?>public/img/home_favorites.png"></a>
    </div>
  </div>
</div>

<div class="section" id="about">
  <div class="row">
    <div class="section grey col m6 col m6">
      <div class="row container">
        <h2 class="header">Sign Up</h2>
        <p class="">Sign up and wait until your account is verified by the admin.</p>
      </div>
    </div>
    <div class="col m6">
      <img src="<?php echo URL ?>public/img/register.png">
    </div>
  </div>
  <div class="row">
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/topics.png"></div>
    </div>
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">Select Topic</h2>
        <p class="">Choose a topic you want to review.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">Select a Test</h2>
        <p class="">Choose from a series of tests in each topic.</p>
        <p class="">There are three categories which are Multiple Choice, True or False, and Enumeration</p>
      </div>
    </div>
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/tests.png"></div>
    </div>
  </div>
  <div class="row">
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/take_test.png"></div>
    </div>
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">Taking the Test</h2>
        <p class="">Questions will be randomly sequenced.</p>
        <p class="">You can skip a question using the checkbox below.</p>
        <p class="">Skipped questions will appear once all questions are answered.</p>
        <p class="">Results will show after answering the last question.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">View Test Data</h2>
        <p class="">Past Test Results will show on a table.</p>
        <p class="">Details will show by clicking the pie icon.</p>
        <p class="">Details includes number of questions, number of correct and wrong answer, and grade.</p>
      </div>
    </div>
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/test_data.png"></div>
    </div>
  </div>
  <div class="row">
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/test_progress.png"></div>
    </div>
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">Monitor Test Progress</h2>
        <p class="">Your progress will show on a line graph representing your scores in your past results.</p>
        <p class="">Green line represents your correct answers.</p>
        <p class="">Red line represents your wrong answers.</p>
        <p class="">Progress can be printed by clicking the pdf icon at upper right corner.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="section grey col m6">
      <div class="row container">
        <h2 class="header">Manage Account Info</h2>
        <p class="">Change your profile picture.</p>
        <p class="">Change your account info.</p>
        <p class="">Change your Password.</p>
      </div>
    </div>
    <div class="col m6">
      <div class=""><img src="<?php echo URL ?>public/img/manage_account.png"></div>
    </div>
  </div>
  <div class="row">
    <div class="center">
      <a href="<?php echo URL ?>login" class="btn waves-effect waves-light btn-large red">Get Started</a>
    </div>
  </div>
</div>

<div class="section white" id="contact">
  <div class="row container">
    <h2 class="header grey-text text-darken-3 lighten-5">Send Us your Feedback and Suggestions</h2>
    <p class="grey-text text-darken-3 lighten-5">Your opinion matters to us.</p>
    <div class="row white z-depth-3" id="message_form">
    <form class="col s12" id="contact_form">
      <div class="row">
        <div class="input-field col s6">
          <input id="name" type="text" class="validate" required>
          <label for="name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <textarea id="message" class="materialize-textarea" required></textarea>
          <label for="message">Your Message</label>
        </div>
      </div>
      <div class="row right">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light" name="button">Submit</button>
        </div>
      </div>
    </form>
  </div>
  </div>
</div>

<footer class="page-footer blue">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">IReview</h5>
        <p class="grey-text text-lighten-4">Reviewing made easy.<br>Track your progress.<br>Select from a variety of Tests.</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Contact Us</h5>
        <ul>
          <li>Contact Number: <a class="grey-text text-lighten-3" href="#!">335-1781</a></li>
          <li>Like Our <a class="grey-text text-lighten-3" href="#!">Facebook Page</a></li>
          <li>Follow Us on <a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
          <li>And <a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © 2019 TBG IReview
    <ul class="right">
      <li><a class="grey-text text-lighten-4" href="#!">Terms</a></li> |
      <li><a class="grey-text text-lighten-4" href="#!">Privacy</a></li>
    </ul>
    </div>
  </div>
</footer>
