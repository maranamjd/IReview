<div class="navbar-fixed">
  <nav class="top-nav">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo"><img src="<?php echo URL; ?>public/img/ireview4.png" width="150" height="80" alt=""></a>
      <a href="#" data-target="mobile-view" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <?php switch ($this->sessionData['utype']) {
        case 'Administrator':
      ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li class="<?php echo $this->page == 'dashboard' ? 'active' : '' ?>"><a href="<?php echo URL ?>dashboard">Dashboard</a></li>
          <li class="<?php echo $this->page == 'users' ? 'active' : '' ?>"><a href="<?php echo URL ?>user">Users</a></li>
          <li class="<?php echo $this->page == 'statistics' ? 'active' : '' ?>"><a href="<?php echo URL ?>statistics">Statistics</a></li>
          <li class="<?php echo $this->page == 'messages' ? 'active' : '' ?>"><a href="<?php echo URL ?>messages">Messages</a></li>
          <li><i class="material-icons btn-floating btn-large blue sidenav-trigger" data-target="side-nav">account_circle</i></li>
        </ul>
      <?php
        break;
        case 'Encoder':
      ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li class="<?php echo $this->page == 'topic' ? 'active' : '' ?>"><a href="<?php echo URL ?>topic">Topics</a></li>
          <li class="<?php echo $this->page == 'trash' ? 'active' : '' ?>"><a href="<?php echo URL ?>trash">Trash</a></li>
          <li><i class="material-icons btn-floating btn-large blue sidenav-trigger" data-target="side-nav">account_circle</i></li>
        </ul>
      <?php
        break;
        case 'Visitor':
      ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li class="<?php echo $this->page == 'topics' ? 'active' : '' ?>"><a href="<?php echo URL ?>topics">Topics</a></li>
          <li class="<?php echo $this->page == 'favorites' ? 'active' : '' ?>"><a href="<?php echo URL ?>favorites">Favorites</a></li>
          <li><i class="material-icons btn-floating btn-large blue sidenav-trigger" data-target="side-nav">account_circle</i></li>
        </ul>
      <?php
        break;
      } ?>
    </div>
</nav>
</div>
<ul id="mobile-view" class="sidenav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="<?php echo URL ?>public/img/bg.jpg" alt="" width="300px" height="250px">
      </div>
      <a href="#"><img class="circle" src="<?php echo URL ?>public/img/<?php echo $this->sessionData['uimage'] ?>" alt=""></a>
      <a href="#"><span class="white-text name"><?php echo $this->sessionData['firstname']." ".$this->sessionData['middlename'][0].". ".$this->sessionData['lastname'] ?></span></a>
    </div>
  </li>
  <?php switch ($this->sessionData['utype']) {
    case 'Administrator':
  ?>

    <li class="<?php echo $this->page == 'dashboard' ? 'active' : '' ?>"><a href="<?php echo URL ?>dashboard">Dashboard</a></li>
    <li class="<?php echo $this->page == 'users' ? 'active' : '' ?>"><a href="<?php echo URL ?>user">Users</a></li>
    <li class="<?php echo $this->page == 'statistics' ? 'active' : '' ?>"><a href="<?php echo URL ?>statistics">Statistics</a></li>
    <li class="<?php echo $this->page == 'messages' ? 'active' : '' ?>"><a href="<?php echo URL ?>messages">Messages</a></li>

  <?php
    break;
    case 'Encoder':
  ?>

    <li class="<?php echo $this->page == 'topic' ? 'active' : '' ?>"><a href="<?php echo URL ?>topic">Topics</a></li>
    <li class="<?php echo $this->page == 'trash' ? 'active' : '' ?>"><a href="<?php echo URL ?>trash">Trash</a></li>

  <?php
    break;
    case 'Visitor':
  ?>

    <li class="<?php echo $this->page == 'topics' ? 'active' : '' ?>"><a href="<?php echo URL ?>topics">Topics</a></li>
    <li class="<?php echo $this->page == 'favorites' ? 'active' : '' ?>"><a href="<?php echo URL ?>favorites">Favorites</a></li>

  <?php
    break;
  } ?>
  <li><a href="<?php echo URL ?>account" class="waves-effect">Account</a></li>
  <li><a id="logout" class="waves-effect" rel="<?php echo URL ?>logout">Logout</a></li>
</ul>

<ul class="sidenav" id="side-nav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="<?php echo URL ?>public/img/bg.jpg" alt="" width="300px" height="250px">
      </div>
      <a href="#"><img class="circle" src="<?php echo URL ?>public/img/<?php echo $this->sessionData['uimage'] ?>" alt=""></a>
      <a href="#"><span class="white-text name"><?php echo $this->sessionData['firstname']." ".$this->sessionData['middlename'][0].". ".$this->sessionData['lastname'] ?></span></a>
    </div>
  </li>
  <li><a href="<?php echo URL ?>account" class="waves-effect">Account</a></li>
  <li><a id="logout" class="waves-effect" rel="<?php echo URL ?>logout">Logout</a></li>
</ul>
