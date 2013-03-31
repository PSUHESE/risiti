<?php

function callTess($inputImage, $outputFileName)
{
  $output = array();
  $command = "/usr/bin/tesseract " . $inputImage . " " . $outputFileName . "2>&1";

  exec($command, $output);
  $contents = file_get_contents($outputFileName . "2.txt");
  return $contents;
}
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
