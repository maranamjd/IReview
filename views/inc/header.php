<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title><?php echo $this->page; ?></title>
      <link rel="icon" href="<?php echo URL ?>public/img/ireview.png">
      <link href="<?php echo URL; ?>public/css/materialize.css" rel="stylesheet" />
      <link href="<?php echo URL; ?>public/css/materialize.min.css" rel="stylesheet" />
      <link href="<?php echo URL; ?>public/datatables/datatables.min.css" rel="stylesheet" />
      <link href="<?php echo URL; ?>public/css/main.css" rel="stylesheet" />
      <link href="<?php echo URL; ?>public/css/material-icons.css" rel="stylesheet" />
      <?php
        if (isset($this->css)) {
          foreach ($this->css as $css) {
            echo "<link href='".URL."views/".$css."' rel='stylesheet' />";
          }
        }
      ?>
  </head>

  <body>
    <div class="content">
