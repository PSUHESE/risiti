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
$charnums = array("birthday" => 5, "bloodOver" =>2, "bloodUnder" => 2 ,"bmi" => 1, "case" => 0, "date" => 5, "heart" => 2, "height" =>2, "name" => 29, "phone" =>9 "village" => 29, "weight" =>2);
$extension = ".jpg";



$values = array();

foreach ($filenames as $file)
{
  for($i = 0; $i < charnums[$file]; $i++)
  {
      $values[$file . $i] = callTess($folder . DIRECTORY_SEPARATOR . $file . $i . $extension, $file);
  }
  var_dump($values);
}
?>
<html>
<body>
  <h1> Mashavu Risiti </h1>
  <form action="export.php" method="post">

    <?php displayImage("name"); ?>
    Name: <input type="text" name="name" value=<?php displayText("name", $values);?>><br />

    <?php displayImage("phone"); ?><br />
    Phone number: <input type="text" name="phone" value=<?php displayText("phone", $values);?>><br />

    <?php displayImage("birthday"); ?><br />
    Birthday (dd|mm|yy): <input type="text" name="birthday" value=<?php displayText("birthday", $values);?>><br />

    <?php displayImage("village"); ?><br />
    Sub-location: <input type="text" name="village" value=<?php displayText("village", $values);?>><br />

    <?php displayImage("weight"); ?><br />
    Weight <input type="text" name="weight" value=<?php displayText("weight", $values);?>><br />

    <?php displayImage("height"); ?><br />
    Height <input type="text" name="height" value=<?php displayText("height", $values);?>><br />

    <?php displayImage("bmi"); ?><br />
    BMI <input type="text" name="bmi" value=<?php displayText("bmi", $values);?>><br />

    <?php displayImage("blood"); ?><br />
    Blood Pressure <input type="text" name="blood" value=<?php displayText("blood", $values);?>><br /><!-- / <input type="text" name="diastolic"><br /> -->

    <?php displayImage("heart"); ?><br />
    Heart Rate <input type="text" name="heart" value=<?php displayText("heart", $values);?>><br />

    <input type="submit">
  </form>
</body>
</html>