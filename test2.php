<?php


function callTess($inputImage, $outputFileName)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . " -psm 10 characters 2>&1";

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
$filenames = array("name", "bmi", "phone", "village", "weight", "bloodOver", "bloodUnder", "heart", "case", "date", "birthday", "height");
$charnums = array("birthday" => 5, "bloodOver" =>2, "bloodUnder" => 2 ,"bmi" => 1, "case" => 0, "date" => 5, "heart" => 2, "height" =>2, "name" => 29, "phone" =>9, "village" => 29, "weight" =>2);
$extension = ".jpg";


/*
 * Call tesseract on each sliced character block
 */
$values = array();
foreach ($filenames as $file)
{
  for($i = 0; $i <= $charnums[$file]; $i++)
  {
      $values[$file . $i] = callTess($folder . DIRECTORY_SEPARATOR . $file . $i . $extension, $file);
  }
}
/*
 * Concatentate each character into strings
 */
$formStrings = array();
foreach ($filenames as $file)
{
  $formStrings[$file] = "";
}
//var_dump($formStrings);
foreach($filenames as $file)
{
  for($i = 0; $i <= $charnums[$file]; $i++)
  {
    if ($values[$file . $i] != " ")
	$formStrings[$file] = $formStrings[$file] . $values[$file . $i];
  }
}
 // var_dump($values);
?>
<html>
<body>
  <h1> Mashavu Risiti </h1>
  <form action="export.php" method="post">

    <?php displayImage("name"); ?>
    Name: <input type="text" name="name" value=<?php displayText("name", $formStrings);?>><br />

    <?php displayImage("phone"); ?><br />
    Phone number: <input type="text" name="phone" value=<?php displayText("phone", $formStrings);?>><br />

    <?php displayImage("birthday"); ?><br />
    Birthday (dd|mm|yy): <input type="text" name="birthday" value=<?php displayText("birthday", $formStrings);?>><br />

    <?php displayImage("village"); ?><br />
    Sub-location: <input type="text" name="village" value=<?php displayText("village", $formStrings);?>><br />

    <?php displayImage("weight"); ?><br />
    Weight <input type="text" name="weight" value=<?php displayText("weight", $formStrings);?>><br />

    <?php displayImage("height"); ?><br />
    Height <input type="text" name="height" value=<?php displayText("height", $formStrings);?>><br />

    <?php displayImage("bmi"); ?><br />
    BMI <input type="text" name="bmi" value=<?php displayText("bmi", $formStrings);?>><br />

    <?php displayImage("blood"); ?><br />
    Blood Pressure <input type="text" name="blood" value=<?php displayText("bloodOver", $formStrings);?>><br /><!-- / <input type="text" name="diastolic"><br /> -->

    <?php displayImage("heart"); ?><br />
    Heart Rate <input type="text" name="heart" value=<?php displayText("heart", $formStrings);?>><br />

    <input type="submit">
  </form>
</body>
</html>
