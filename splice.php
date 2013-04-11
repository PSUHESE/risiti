<?php

  $path = htmlspecialchars($_POST['path']);
	
	session_start();
	
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
		
		# This should probably be changed so that it utilizes an array.
		$blockWidth = 28;
		$blockHeight = 36;
		$blockSkip = 30;
		
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
		for (int i = 0; i < 30: i++) 
		{
		    $nameParts[i] = $image->clone();
			$nameParts[i]->cropImage(28, 36, 296+(i*$blockSkip), 144);
		}
		
		// create the boxes for the bmi segments
        for (int i = 0; i < 2; i++)
		{
		    $bmiParts[i] = $image->clone();
			$bmiParts[i]->cropImage(28,36,798+(i*$blockSkip), 419);
		}

        // create the boxes for the phone number segments
		for (int i = 0; i < 10; i++)
		{
		    $phoneParts[i] = $image->clone();
		    $phoneParts[i]->cropImage(28, 36, 296+(i*$blockSkip), 210);
		}
		
		// create the boxes for the village segments
		for (int i = 0; i < 30; i++)
		{
		    $villageParts[i] = $image->clone();
		    $villageParts[i]->cropImage(28, 36, 296+(i*$blockSkip), 349);
		}
		
		// create the boxes for the weight segments
		for (int i = 0; i < 3; i++)
		{
		    $weightParts[i] = $image->clone();
		    $weightParts[i]->cropImage(28, 36, 296+(i*$blockSkip), 419);
		}
		
		
	    // create the boxes for the upper blood pressure segments
		for (int i = 0; i < 3; i++)
		{
		    $bpOverParts[i] = $image->clone();
		    $bpOverParts[i]->cropImage(28, 36, 298+(i*$blockSkip), 488);
		}
		
		// create the boxes for the lower blood pressure segments
		for (int i = 0; i < 3; i++)
		{
		   $bpUnderParts[i] = $image->clone();
		   $bpUnderParts[i]->cropImage(28, 36, 414+(i*$blockSkip), 488);
		}
		
        // create the boxes for the heart rate segments
		for (int i = 0; i < 3; i++)
		{
		   $hrParts[i] = $image->clone();
		   $hrParts[i]->cropImage(28, 36, 650+(i*$blockSkip), 489);
		}
		
	    // create the boxes for the height segments
		for (int i = 0; i < 3; i++)
		{
		   $heightParts[i] = $image->clone();
		   $heightParts[i]->cropImage(28, 36, 650+(i*$blockSkip), 419);
		}
		
		$caseField = $image->clone();
		$caseField->cropImage(250, 60, 995, 20);
		
		// create the boxes for the date segments
		for (int i = 0; i < 6; i++)
		{
		   $dateParts[i] = $image->clone();
		   $dateParts[i]->cropImage(28, 36, 1008+(i*$blockSkip), 419);
		}
		
		// create the boxes for the birthdate segments
		for (int i = 0; i < 6; i++)
		{
		   $bdParts[i] = $image->clone();
		   $bdParts[i]->cropImage(28, 36, 1008+(i*$blockSkip), 212);
		}
		
		# Save each image into the directory in question.
		$dateStr = date('D,d-M-Y-H:i:s');
		
		if (mkdir($dateStr, 0777, true))
		{
			# But actually, arrays and stuff
			for (int i = 0; i < count($nameParts); i++)
			{
			    $data = $nameParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/name".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($bmiParts); i++)
			{
			    $data = $bmiParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/bmi".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($phoneParts); i++)
			{
			    $data = $phoneParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/phone".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($villageParts); i++)
			{
			    $data = $villageParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/village".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($weightParts); i++)
			{
			    $data = $weightParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/weight".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($bpOverParts); i++)
			{
			    $data = $bpOverParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/bloodOver".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($bpUnderParts); i++)
			{
			    $data = $bpUnderParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/bloodUnder".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($hrParts); i++)
			{
			    $data = $hrParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/heart".i.".jpg", $data);
			}
			
			$data = $caseField->getImageBlob();
			file_put_contents($dateStr . "/case.jpg", $data);
			
			for (int i = 0; i < count($dateParts); i++)
			{
			    $data = $dateParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/date".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($bdParts); i++)
			{
			    $data = $bdParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/birthday".i.".jpg", $data);
			}
			
			for (int i = 0; i < count($heightParts); i++)
			{
			    $data = $heightParts[i]->getImageBlob();
			    file_put_contents($dateStr . "/height".i.".jpg", $data);
			}
		}
    else{
			die('Failed to create output folder...');
		}

		$_SESSION['folder'] = $dateStr;

		header("Content-type: image/jpeg");
	    echo $image;
	}
}
	
?>
