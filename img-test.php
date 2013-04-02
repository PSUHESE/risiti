<?php
    include "imagick.php";
    $path = htmlspecialchars($_POST['path']);
	$file = $_POST['file'];
	
	if ($path == null && $file == null)
	{
	    echo "No file specified."
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
		$nameField = $image->cropImage(900, 40, 290, 140);
		$bmiField = $image->cropImage(60, 40, 850, 415);
		$numberField = $image->cropImage(300, 40, 290, 205);
		$villageField = $image->cropImage(900, 40, 290, 345);
		$weightField = $image->cropImage(90, 40, 295, 415);
		$bpField = $image->cropImage(210, 40, 295, 485);
		$hrField = $image->cropImage(90, 40, 730, 485);
		$caseField = $image->cropImage(250, 60, 995, 20);
		$dateField = $image->cropImage(180, 40, 1000, 415);
		$bdField = $image->cropImage(180, 40, 1000, 205);
		$heightField = $image->cropImage(90, 40, 730, 415);
		
		# Save each image into the directory in question.
		$dateStr = date(DATE_RSS);
		
		if (mkdir($dateStr))
		{
			# But actually, arrays and stuff
			$data = $nameField->getImageBlob();
			file_put_contents($dateStr . "\\name.jpg", $data);
			
			$data = $bmiField->getImageBlob();
			file_put_contents($dateStr . "\\bmi.jpg", $data);
			
			$data = $numberField->getImageBlob();
			file_put_contents($dateStr . "\\phone.jpg", $data);
			
			$data = $villageField->getImageBlob();
			file_put_contents($dateStr . "\\village.jpg", $data);
			
			$data = $weightField->getImageBlob();
			file_put_contents($dateStr . "\\weight.jpg", $data);
			
			$data = $bpField->getImageBlob();
			file_put_contents($dateStr . "\\blood.jpg", $data);
			
			$data = $hrField->getImageBlob();
			file_put_contents($dateStr . "\\heart.jpg", $data);
			
			$data = $caseField->getImageBlob();
			file_put_contents($dateStr . "\\case.jpg", $data);
			
			$data = $dateField->getImageBlob();
			file_put_contents($dateStr . "\\date.jpg", $data);
			
			$data = $bdField->getImageBlob();
			file_put_contents($dateStr . "\\birthday.jpg", $data);
			
			$data = $heightField->getImageBlob();
			file_put_contents($dateStr . "\\height.jpg", $data);
		}
		header("Content-type: image/jpeg");
	    echo $image;
	}
	
?>
