<?php

  //$path = htmlspecialchars($_POST['path']);
  
  //session_start();
  
  # this did some validation, but I changed it for testing purposes
  if (true) {
  
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
    
    // resize the image so it matches the appropriate dimensions
    $image->resizeImage(1240, 560, FILTER_UNDEFINED, 0.5);
    
    # This should probably be changed so that it utilizes an array.
    $blockWidth = 27;
    $blockHeight = 34;
    $blockSkip = 2.5;
    
    $nameParts = array();
    $bmiParts = array();
    $phoneParts = array();
    $villageParts = array();
    $weightParts = array();
    $bpHighParts = array();
    $bpLowParts = array();
    $hrParts = array();
    $dateParts = array();
    $bdParts = array();
    $heightParts = array();
    
    
    // create the boxes for the name segments
    for ($i = 0; $i < 30; $i++) 
    {
      $nameParts[$i] = clone $image;
      $nameParts[$i]->cropImage($blockWidth, $blockHeight, 296+($i * $blockWidth) + ($i * $blockSkip), 144);
    }
    
    // create the boxes for the bmi segments
    for ($i = 0; $i < 2; $i++)
    {
      $bmiParts[$i] = clone $image;
      $bmiParts[$i]->cropImage($blockWidth ,$blockHeight,798+($i * $blockWidth) + ($i * $blockSkip), 419);
    }

        // create the boxes for the phone number segments
    for ($i = 0; $i < 10; $i++)
    {
      $phoneParts[$i] = clone $image;
      $phoneParts[$i]->cropImage($blockWidth, $blockHeight, 296+($i * $blockWidth) + ($i * $blockSkip), 210);
    }
    
    // create the boxes for the village segments
    for ($i = 0; $i < 30; $i++)
    {
      $villageParts[$i] = clone $image;
      $villageParts[$i]->cropImage($blockWidth, $blockHeight, 296+($i * $blockWidth) + ($i * $blockSkip), 349);
    }
    
    // create the boxes for the weight segments
    for ($i = 0; $i < 3; $i++)
    {
      $weightParts[$i] = clone $image;
      $weightParts[$i]->cropImage($blockWidth, $blockHeight, 296+($i * $blockWidth) + ($i * $blockSkip), 419);
    }
    
    
      // create the boxes for the upper blood pressure segments
    for ($i = 0; $i < 3; $i++)
    {
      $bpOverParts[$i] = clone $image;
      $bpOverParts[$i]->cropImage($blockWidth, $blockHeight, 298+($i * $blockWidth) + ($i * $blockSkip), 488);
    }
    
    // create the boxes for the lower blood pressure segments
    for ($i = 0; $i < 3; $i++)
    {
      $bpUnderParts[$i] = clone $image;
      $bpUnderParts[$i]->cropImage($blockWidth, $blockHeight, 414+($i * $blockWidth) + ($i * $blockSkip), 488);
    }
    
    // create the boxes for the heart rate segments
    for ($i = 0; $i < 3; $i++)
    {
      $hrParts[$i] = clone $image;
      $hrParts[$i]->cropImage($blockWidth, $blockHeight, 650+($i * $blockWidth) + ($i * $blockSkip), 489);
    }
    
    // create the boxes for the height segments
    for ($i = 0; $i < 3; $i++)
    {
      $heightParts[$i] = clone $image;
      $heightParts[$i]->cropImage($blockWidth, $blockHeight, 650+($i * $blockWidth) + ($i * $blockSkip), 419);
    }
    
    $caseField = clone $image;
    $caseField->cropImage(250, 60, 995, 20);
    
    // create the boxes for the date segments
    for ($i = 0; $i < 6; $i++)
    {
      $dateParts[$i] = clone $image;
      $dateParts[$i]->cropImage($blockWidth, $blockHeight, 1008+($i * $blockWidth) + ($i * $blockSkip), 419);
    }
    
    // create the boxes for the birthdate segments
    for ($i = 0; $i < 6; $i++)
    {
      $bdParts[$i] = clone $image;
      $bdParts[$i]->cropImage($blockWidth, $blockHeight, 1008+($i * $blockWidth) + ($i * $blockSkip), 212);
    }
    
    # Save each image into the directory in question.
    $dateStr = date('dMY-H-i-s');
    
    if (mkdir($dateStr, 0777, true))
    {
      # But actually, arrays and stuff
      for ($i = 0; $i < count($nameParts); $i++)
      {
        $data = $nameParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/name".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($bmiParts); $i++)
      {
        $data = $bmiParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/bmi".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($phoneParts); $i++)
      {
        $data = $phoneParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/phone".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($villageParts); $i++)
      {
        $data = $villageParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/village".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($weightParts); $i++)
      {
          $data = $weightParts[$i]->getImageBlob();
          file_put_contents($dateStr . "/weight".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($bpOverParts); $i++)
      {
        $data = $bpOverParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/bloodOver".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($bpUnderParts); $i++)
      {
        $data = $bpUnderParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/bloodUnder".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($hrParts); $i++)
      {
        $data = $hrParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/heart".$i.".jpg", $data);
      }
      
      $data = $caseField->getImageBlob();
      file_put_contents($dateStr . "/case.jpg", $data);
      
      for ($i = 0; $i < count($dateParts); $i++)
      {
        $data = $dateParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/date".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($bdParts); $i++)
      {
        $data = $bdParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/birthday".$i.".jpg", $data);
      }
      
      for ($i = 0; $i < count($heightParts); $i++)
      {
        $data = $heightParts[$i]->getImageBlob();
        file_put_contents($dateStr . "/height".$i.".jpg", $data);
      }
    }
    else{
      die('Failed to create output folder...');
    }

    //$_SESSION['folder'] = $dateStr;

    header("Content-type: image/jpeg");
      echo $image;
  }
}
  
?>