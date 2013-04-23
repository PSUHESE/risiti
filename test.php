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
  echo "<div class=\"image\"><img src=\"" . $folder . DIRECTORY_SEPARATOR . $image . $extension . "\"/></div>";
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
  <form action="export.php" method="post">

    <div class="controls controls-row">
		<?php displayImage("name"); ?>
		<div class="text">
            <span class="help-inline">Name:</span> <input type="text" name="name" value=<?php displayText("name", $values);?>>
		</div><hr />
	</div>

	<div class="controls controls-row">
    <?php displayImage("phone"); ?>
    <div class="text"><span class="help-inline">Phone number:</span> <input type="text" name="phone" value=<?php displayText("phone", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("birthday"); ?>
    <div class="text"><span class="help-inline">Birthday (dd|mm|yy):</span> <input type="text" name="birthday" value=<?php displayText("birthday", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("village"); ?>
    <div class="text"><span class="help-inline">Sub-location:</span> <input type="text" name="village" value=<?php displayText("village", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("weight"); ?>
    <div class="text"><span class="help-inline">Weight</span> <input type="text" name="weight" value=<?php displayText("weight", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("height"); ?>
    <div class="text"><span class="help-inline">Height</span> <input type="text" name="height" value=<?php displayText("height", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("bmi"); ?>
    <div class="text"><span class="help-inline">BMI</span><input type="text" name="bmi" value=<?php displayText("bmi", $values);?>></div><hr /></div>

	<div class="controls controls-row">
    <?php displayImage("blood"); ?>
    <div class="text"><span class="help-inline">Blood Pressure</span><input type="text" name="blood" value=<?php displayText("blood", $values);?>></div><hr /></div><!-- / <input type="text" name="diastolic"></div><hr /> -->

	<div class="controls controls-row">
    <?php displayImage("heart"); ?>
    <div class="text"><span class="help-inline">Heart Rate</span><input type="text" name="heart" value=<?php displayText("heart", $values);?>></div><hr /></div>

    <button class="btn btn-success" type="submit">Submit</button>
  </form>
</body>
</html>
