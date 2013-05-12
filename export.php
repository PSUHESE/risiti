<?php
  
  /*
   * Name of csv file to write to
   */
  $filename = 'dump.csv';

  $name = $_POST['name'];

  $phone = $_POST["phone"];

  $birthday = $_POST["birthday"];

  $village = $_POST["village"];

  $weight = $_POST["weight"];

  $height = $_POST["height"];

  $bmi = $_POST["bmi"];

  $blood = $_POST["blood"];

  $heart = $_POST["heart"];

  echo $name . "," . $phone . "," . $birthday . "," . $village . "," . $weight . "," . $height . "," . $bmi . "," . $blood . "," . $heart;

  $list = array ($name, $phone, $birthday, $village, $weight, $height, $bmi, $blood, $heart);

  $fp = fopen($filename, 'a');
  fputcsv($fp, $list);

  fclose($fp);
?>