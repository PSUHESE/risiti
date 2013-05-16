<?php
  $reports = array();
  $reportsDir = "./csvout";

  foreach(glob($reportsDir.'/*') as $file) {
    //$tmp = explode("/", $file);
    //array_push($dumps, end($tmp));
    array_push($reports, $file);
  }

  function listCSVs()
  {
    global $reports, $reportsDir;
    foreach ($reports as $filename)
    {
      echo '<a href="'. $filename . '">' . $filename . '</option>';
    }
  }
?>
<html>
  <head>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  </head>
  <body>
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="#">Mashavu Risiti</a>
        <ul class="nav">
          <li><a href="upload.html">Upload</a></li>
          <li><a href="verify.php">Data Entry</a></li>
          <li class="active"><a href="#">Reports</a></li>
        </ul>
      </div>
    </div>
    <?php listCSVs() ?>
  </body>
</html>