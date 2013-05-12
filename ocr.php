<?php

$folder = "./testDump";
$filenames = array("name", "bmi", "phone", "village", "weight", "bloodOver", "bloodUnder", "heart", "case", "date", "birthday", "height");
$filenamesToLimit = array("name" => "characters", "bmi" => "numbers", "phone" => "numbers", "village" => "characters", "weight" => "numbers", "bloodOver" => "numbers", "bloodUnder" => "numbers", "heart" => "numbers", "case" => "numbers", "date" => "numbers", "birthday" => "numbers", "height" => "numbers");
$charnums = array("birthday" => 5, "bloodOver" =>2, "bloodUnder" => 2 ,"bmi" => 1, "case" => 0, "date" => 5, "heart" => 2, "height" =>2, "name" => 29, "phone" =>9, "village" => 29, "weight" =>2);
$extension = ".jpg";

function callTess($inputImage, $outputFileName, $limits)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . " -psm 10 " . $limits . " 2>&1";
  exec($command, $output);
  $contents = file_get_contents($outputFileName . ".txt");
  return $contents;
}

function displayImage($image)
{
  global $folder, $extension;
  echo "<img src=\"" . $folder . DIRECTORY_SEPARATOR . $image . $extension . "?rand=" . rand(1,1000) . "\"/><br />";
}

function displayText($name, $values)
{
  global $folder, $extension;

  if (is_null($values[$name]))
    echo "\"\"";
  else
    echo "\"" . $values[$name] . "\"";
}

function displayImages($field)
{

  global $charnums, $folder, $filenames, $extension;
  for ($i = 0; $i <= $charnums[$field]; $i++)
  {
    echo "<img src=\"" . $folder . DIRECTORY_SEPARATOR . $field . $i . $extension . "\"/>";
  }

  echo "<br />";
}
/*
 * Call tesseract on each sliced character block
 */
$values = array();
foreach ($filenames as $file)
{
  for($i = 0; $i <= $charnums[$file]; $i++)
  {
      $values[$file . $i] = callTess($folder . DIRECTORY_SEPARATOR . $file . $i . $extension, $file, $filenamesToLimit[$file] );
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

?>
<html>
<body>
  <h1> Mashavu Risiti </h1>
  <form action="export.php" method="post">

    <div class="controls controls-row">
    <?php displayImages("name"); ?>
    Name: <input type="text" name="name" value=<?php displayText("name", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("phone"); ?><br />
    Phone number: <input type="text" name="phone" value=<?php displayText("phone", $formStrings);?>><br />
    
    <div class="controls controls-row">
    <?php displayImages("birthday"); ?><br />
    Birthday (dd|mm|yy): <input type="text" name="birthday" value=<?php displayText("birthday", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("village"); ?><br />
    Sub-location: <input type="text" name="village" value=<?php displayText("village", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("weight"); ?><br />
    Weight <input type="text" name="weight" value=<?php displayText("weight", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("height"); ?><br />
    Height <input type="text" name="height" value=<?php displayText("height", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("bmi"); ?><br />
    BMI <input type="text" name="bmi" value=<?php displayText("bmi", $formStrings);?>><br />

    <div class="controls controls-row">
    <?php displayImages("bloodOver"); ?><br />
    Blood Pressure <input type="text" name="blood" value=<?php displayText("bloodOver", $formStrings);?>><br /><!-- / <input type="text" name="diastolic"><br /> -->

    <div class="controls controls-row">
    <?php displayImages("heart"); ?><br />
    Heart Rate <input type="text" name="heart" value=<?php displayText("heart", $formStrings);?>><br />

    <input type="submit">
  </form>
</body>
</html>
