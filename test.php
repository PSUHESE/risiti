<?php

function callTess($inputImage, $outputFileName)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . " 2>&1";

  exec($command, $output);
  $contents = file_get_contents($outputFileName . ".txt");
  return $contents;
}
function displayImage($folder, $image)
{
  echo "<img src=\"" . $folder . DIRECTORY_SEPARATOR . $image . $extension . "\"/>";
}

$folder = "./testDump";
$filenames = {"name", "bmi", "phone", "village", "weight", "blood", "heart", "case", "date", "birthday", "height"};
$extension = ".jpg";

$values = array();

foreach ($filenames as $file)
{
  $values[$file] = callTess($folder . DIRECTORY_SEPARATOR . $file . $extension, $file);
}

var_dump($values);
?>
<html>
<body>
  <h1> Mashavu Risiti </h1>
  <form action="verify.php" method="post">
    <img src="sample.jpg"/><br />
    Name: <input type="text" name="name" value=<?php echo "\"" . callTess("sample.jpg", "out") . "\""; ?>><br />

    Phone number: <input type="text" name="phonenumber"><br />

    Birthday (dd|mm|yy): <input type="text" name="birthday"><br />

    Sub-location: <input type="text" name="sublocation"><br />

    Weight <input type="text" name="weight"> Height <input type="height" name="height"> BMI <input type="text" name="bmi"><br />

    Blood Pressure <input type="text" name="systolic"> / <input type="text" name="diastolic"> Heart Rate <intput type="text" name="heartrate"><br />

    <input type="submit">
  </form>
</body>
</html>
