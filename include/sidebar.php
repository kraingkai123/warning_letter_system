<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
  <a href="../form/home.php" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="../assets/img/logo-small.png">
      </div>
      <!-- <p>CT</p> -->
    </a>
    <a href="../form/home.php" class="simple-text logo-normal">
    Warning <br>Letter<br>System
      <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <?php
      $i = 0;
      foreach ($_SESSION['menu'] as $key => $value) {
        $acitve = "";
        if (empty($_GET['menu_id']) && $i == 0) {
          $acitve = "active";
        } else if ($_GET['menu_id'] == $key) {
          $acitve = "active";
        }
      ?>
        <li class="<?php echo $acitve; ?>">
          <a href="../form/<?php echo $value['menu_url'] ?>?menu_id=<?php echo $key; ?>">
            <i class="nc-icon nc-bank"></i>
            <p><?php echo $value['menu_name']; ?></p>
          </a>
        </li>
        <li>
        <?php
        $i++;
      }
        ?>
    </ul>
  </div>
</div>