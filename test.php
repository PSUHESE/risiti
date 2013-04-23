<?php


function callTess($inputImage, $outputFileName)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . " -psm 8 characters 2>&1";

  exec($command, $output);
  $contents = file_get_contents($outputFileName . ".txt");
  return $contents;
}

function displayImage($image)
{
  $folder = "./testDump";
  $extension = ".jpg";
  echo "<img src=\"" . $folder . DIRECTORY_SEPARATOR . $image . $extension . "\"/><br />";
}

function displayText($name, $values)
{
  $folder = "./testDump";
  $extension = ".jpg";

  if (is_null($values[$name]))
    echo "\"\"";
  else
    echo "\"" . $values[$name] . "\"";
}

$folder = "./testDump";
$filenames = array("name", "bmi", "phone", "village", "weight", "blood", "heart", "case", "date", "birthday", "height");
$extension = ".jpg";


$values = array();

foreach ($filenames as $file)
{
  $values[$file] = callTess($folder . DIRECTORY_SEPARATOR . $file . $extension, $file);
}
?>
<html>
<body>
  <h1> Mashavu Risiti </h1>
  <form action="export.php" method="post">

    <?php displayImage("name"); ?>
    <div class="pair"><span class="help-inline">Name:</span> <input type="text" name="name" value=<?php displayText("name", $values);?>><br /></div>

    <?php displayImage("phone"); ?><br />
    <div class="pair"><span class="help-inline">Phone number:</span> <input type="text" name="phone" value=<?php displayText("phone", $values);?>><br /></div>

    <?php displayImage("birthday"); ?><br />
    <div class="pair"><span class="help-inline">Birthday (dd|mm|yy):</span> <input type="text" name="birthday" value=<?php displayText("birthday", $values);?>><br /></div>

    <?php displayImage("village"); ?><br />
    <div class="pair"><span class="help-inline">Sub-location:</span> <input type="text" name="village" value=<?php displayText("village", $values);?>><br /></div>

    <?php displayImage("weight"); ?><br />
    <div class="pair"><span class="help-inline">Weight</span> <input type="text" name="weight" value=<?php displayText("weight", $values);?>><br /></div>

    <?php displayImage("height"); ?><br />
    <div class="pair"><span class="help-inline">Height</span> <input type="text" name="height" value=<?php displayText("height", $values);?>><br /></div>

    <?php displayImage("bmi"); ?><br />
    <div class="pair"><span class="help-inline">BMI</span><input type="text" name="bmi" value=<?php displayText("bmi", $values);?>><br /></div>

    <?php displayImage("blood"); ?><br />
    <div class="pair"><span class="help-inline">Blood Pressure</span><input type="text" name="blood" value=<?php displayText("blood", $values);?>><br /></div><!-- / <input type="text" name="diastolic"><br /> -->

    <?php displayImage("heart"); ?><br />
    <div class="pair"><span class="help-inline">Heart Rate</span><input type="text" name="heart" value=<?php displayText("heart", $values);?>><br /></div>

    <button class="btn btn-success" type="submit">
  </form>
</body>
</html>
