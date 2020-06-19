      </div>
    <script src="<?php echo URL; ?>public/js/jquery3.3.1.js"></script>
    <script src="<?php echo URL; ?>public/js/materialize.js"></script>
    <script src="<?php echo URL; ?>public/js/materialize.min.js"></script>
    <script src="<?php echo URL; ?>public/datatables/datatables.min.js"></script>
    <script src="<?php echo URL; ?>public/js/chart.bundle.js"></script>
    <script src="<?php echo URL; ?>public/js/chartutils.js"></script>
    <script src="<?php echo URL; ?>public/js/main.js"></script>
    <?php
    if (isset($this->js)) {
      foreach ($this->js as $js) {
        echo "<script src='".URL."views/".$js."'></script>";
      }
    }
     ?>
  </body>
</html>
