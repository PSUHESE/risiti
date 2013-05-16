<?php
$dumps = array();
array_push($dumps, ' ');
$dumpdir = "./scans";
foreach(glob($dumpdir.'/*') as $file) {
  $tmp = explode("/", $file);
  array_push($dumps, end($tmp));
}

function displayDropDownContents()
{
  global $dumps;

  foreach ($dumps as $dirName)
  {
    echo '<option value="'. $dirName . '">' . $dirName . '</option>';
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
    <script>
      $(document).ready(function() {
        $( "#progressbar" ).progressbar({
          value: false
        });

     });
     </script>
  </head>
  <body>
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="#">Mashavu Risiti</a>
        <ul class="nav">
          <li class="active"><a href="#">Data Entry</a></li>
          <li><a href="reports">Reports</a></li>
        </ul>
      </div>
    </div>
    <h5>Verify each form field matches what's in the picture</h5>
    <h5>Then click submit</h5>
    <form id="dd" action="">
      Choose an upload to verify:
      <select id="dumpSelect" name="dumpSelect">
        <?php displayDropDownContents() ?>
      </select>
    </form>
    <div id="phpdiv"></div>
  </body>
  <script>

    $('#dumpSelect').change(function() {
      var dumpName = $("#dumpSelect").val();
      var loadString = 'ocr.php?dir=' + dumpName;
      //$( "#phpdiv" ).progressbar({
        //  value: false
        //});
      $('#phpdiv').load(loadString);
    });
    </script>
</html>