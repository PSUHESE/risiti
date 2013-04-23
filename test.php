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
    <div class="text">Name: <input type="text" name="name" id="inputSuccess" value=<?php displayText("name", $values);?>><br />

    <?php displayImage("phone"); ?><br />
    Phone number: <input type="text" name="phone" id="inputSuccess" value=<?php displayText("phone", $values);?>><br />

    <?php displayImage("birthday"); ?><br />
    Birthday (dd|mm|yy): <input type="text" name="birthday" id="inputSuccess" value=<?php displayText("birthday", $values);?>><br />

    <?php displayImage("village"); ?><br />
    Sub-location: <input type="text" name="village" id="inputSuccess" value=<?php displayText("village", $values);?>><br />

    <?php displayImage("weight"); ?><br />
    Weight <input type="text" name="weight" id="inputSuccess" value=<?php displayText("weight", $values);?>><br />

    <?php displayImage("height"); ?><br />
    Height <input type="text" name="height" id="inputSuccess" value=<?php displayText("height", $values);?>><br />

    <?php displayImage("bmi"); ?><br />
    BMI <input type="text" name="bmi" id="inputSuccess" value=<?php displayText("bmi", $values);?>><br />

    <?php displayImage("blood"); ?><br />
    Blood Pressure <input type="text" name="blood" id="inputSuccess" value=<?php displayText("blood", $values);?>><br /><!-- / <input type="text" name="diastolic"><br /> -->

    <?php displayImage("heart"); ?><br />
    Heart Rate <input type="text" name="heart" id="inputSuccess" value=<?php displayText("heart", $values);?>><br /></div>

    <input type="submit">
  </form>
</body>
</html>
