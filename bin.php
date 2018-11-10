<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>CHECKER BIN</title>
		<style type="text/css">
			body{
				padding-top: 5%;
				text-align: center;
			}
			input#btn{
				width: 15%;
			}
		</style>
	</head>
	<body>
		<h3>BIN CHECKER</h3>
		<form method="post">
			<input type="text" name="bin" placeholder="544731"  size="3" required="" id="binn" maxlength="6">
			<br>
			<br>
			<input type="submit" id="btn" value="CHECKAR" class="btn btn-primary">
			<br>
			<br>
		</form>
	</body>
</html>

<?php
	//error_reporting(0);
	$bin = $_POST["bin"];
	if(!empty($bin)){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://ccbins.org/?bins=$bin");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$exp = explode("<tr>", $data);
		$data = strstr($data, '<table style="">');
		$data = strstr($data, '<script>', true);
		$data = str_replace('BIN', 'Bin', $data);
		$data = str_replace('Country', 'Site', $data);
		$data = str_replace('Vendor', 'Bandeira', $data);
		$data = str_replace('Type', 'Nivel', $data);
		$data = str_replace('Level', 'Pais', $data);
		$data = str_replace('Bank', 'Banco', $data);

		echo "<center>$data";

	}else{
		echo "";
	}

	/*
		<a href="https://ccbins.org/contact.php" target="_blank"><img src="images.jpeg" style="position: fixed;  bottom: 0; width: 10%; padding: 20px; right:20px;"></a>

		[1] => 544731 
		[2] => http://www.ri.santander.com.br 
		[3] => MASTERCARD 
		[4] => GOLD 
		[5] => BRAZIL 
		[6] => BANCO SANTANDER (BRASIL), S.A.
	*/
?>