<?php

  $path = htmlspecialchars($_POST['path']);
  
  # this did some validation, but I changed it for testing purposes
  if (true) 
  {
  
    $file = $_FILES['file']['tmp_name'];
    
    if ($path == null && $file == null)
    {
        echo "No file specified.";
    }
    else
    {
      $image = null;
      if ($path == null)
      {
          $image = new Imagick($file);
      }
      else
      {
          $image = new Imagick($path);
      }
      
      # This should probably be changed so that it utilizes an array.
      $nameField = $image->clone();
      $nameField->cropImage(900, 40, 290, 140);

      $bmiField = $image->clone();
      $bmiField->cropImage(60, 40, 795, 415);
      
      $numberField = $image->clone();
      $numberField->cropImage(300, 40, 290, 205);
      
      $villageField = $image->clone();
      $villageField->cropImage(900, 40, 290, 345);
      
      $weightField = $image->clone();
      $weightField->cropImage(90, 40, 295, 415);
      
      $bpField = $image->clone();
      $bpField->cropImage(210, 40, 295, 485);
      
      $hrField = $image->clone();
      $hrField->cropImage(90, 40, 650, 485);
      
      $caseField = $image->clone();
      $caseField->cropImage(250, 60, 995, 20);
      
      $dateField = $image->clone();
      $dateField->cropImage(180, 40, 1000, 415);
      
      $bdField = $image->clone();
      $bdField->cropImage(180, 40, 1000, 205);
      
      $heightField = $image->clone();
      $heightField->cropImage(90, 40, 650, 415);
      
      # Save each image into the directory in question.
      $dateStr = date('D,d-M-Y-H:i:s');
      
      if (mkdir($dateStr, 0777, true))
      {
        # But actually, arrays and stuff
        $data = $nameField->getImageBlob();
        file_put_contents($dateStr . "/name.jpg", $data);
        
        $data = $bmiField->getImageBlob();
        file_put_contents($dateStr . "/bmi.jpg", $data);
        
        $data = $numberField->getImageBlob();
        file_put_contents($dateStr . "/phone.jpg", $data);
        
        $data = $villageField->getImageBlob();
        file_put_contents($dateStr . "/village.jpg", $data);
        
        $data = $weightField->getImageBlob();
        file_put_contents($dateStr . "/weight.jpg", $data);
        
        $data = $bpField->getImageBlob();
        file_put_contents($dateStr . "/blood.jpg", $data);
        
        $data = $hrField->getImageBlob();
        file_put_contents($dateStr . "/heart.jpg", $data);
        
        $data = $caseField->getImageBlob();
        file_put_contents($dateStr . "/case.jpg", $data);
        
        $data = $dateField->getImageBlob();
        file_put_contents($dateStr . "/date.jpg", $data);
        
        $data = $bdField->getImageBlob();
        file_put_contents($dateStr . "/birthday.jpg", $data);
        
        $data = $heightField->getImageBlob();
        file_put_contents($dateStr . "/height.jpg", $data);
      }
      else{
        die('Failed to create output folder...');
      }
      header("Content-type: image/jpeg");
        echo $image;
    }
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