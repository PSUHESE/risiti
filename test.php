<?php

function callTess($inputImage, $outputFileName)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . " 2>&1";

  exec($command, $output);
  $contents = file_get_contents($outputFileName . ".txt");
  return $contents;
}
function displayImage($image)
{
  $folder = "./testDump";
  $filenames = array("name", "bmi", "phone", "village", "weight", "blood", "heart", "case", "date", "birthday", "height");
  $extension = ".jpg";
  echo "<img src=\"" . $folder . DIRECTORY_SEPARATOR . $image . $extension . "\"/><br />";
}

function displayText($name)
{
  $folder = "./testDump";
  $filenames = array("name", "bmi", "phone", "village", "weight", "blood", "heart", "case", "date", "birthday", "height");
  $extension = ".jpg";
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
  <form action="verify.php" method="post">

    <?php displayImage("name"); ?>
    Name: <input type="text" name="name" value=<?php displayText("name");?>><br />

    <?php displayImage("phone"); ?><br />
    Phone number: <input type="text" name="phone" value=<?php displayText("name");?>><br />

    <?php displayImage("birthday"); ?><br />
    Birthday (dd|mm|yy): <input type="text" name="birthday" value=<?php displayText("name");?>><br />

    <?php displayImage("village"); ?><br />
    Sub-location: <input type="text" name="sublocation" value=<?php displayText("name");?>><br />

    <?php displayImage("weight"); ?><br />
    Weight <input type="text" name="weight" value=<?php displayText("name");?>><br />

    <?php displayImage("height"); ?><br />
    Height <input type="text" name="height" value=<?php displayText("name");?>><br />

    <?php displayImage("bmi"); ?><br />
    BMI <input type="text" name="bmi" value=<?php displayText("name");?>><br />

    <?php displayImage("blood"); ?><br />
    Blood Pressure <input type="text" name="systolic" value=<?php displayText("name");?>><br /><!-- / <input type="text" name="diastolic"><br /> -->

    <?php displayImage("heart"); ?><br />
    Heart Rate <intput type="text" name="heartrate" value=<?php displayText("name");?>><br />

    <input type="submit">
  </form>
</body>
</html>