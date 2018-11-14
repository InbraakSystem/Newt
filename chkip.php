<?php
	/*
		OPEN SOURCE POR : INBRAAK SYSTEM
		FORMAS DE CONTATO 
		TWITTER : https://twitter.com/gabriellgomes__
		GITHUB : https://github.com/InbraakSystem/
		OBS : NÃO ME RESPONSABILIZO PELOS SEUS ATOS! 

		EDITE COMO QUISER! ^^
	*/
?>

<!DOCTYPE html>	
<html>
	<head>
		<meta charset="utf-8">
		<title>CHECKER IP</title>
	</head>
	<body>
		<form method="post">
			<input type="text" name="ip" placeholder="68.183.19.167" required="">
			<br><br>
			<input type="submit" value="CHECKAR">
		</form>
		<div id="resultado">
			<?php
				error_reporting(0);
				$ip = $_POST["ip"];
				if(!empty($ip)){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/$ip");
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$data = curl_exec($ch);
					$json = json_decode($data);

					$status = $json->status;
					$as = $json->as;
					$country = $json->country;
					$country2 = $json->countryCode;
					$isp = $json->isp;
					$estado = $json->regionName;
					$estado2 = $json->region;
					$cidade = $json->city;
					$time = $json->timezone;

					if ($status ==  "success"){
						echo "IP: ". $ip ."<br>";
						echo "Portadora: ". $as ."<br>";
						echo "Pais: ". $country ." - ".$country2 ."<br>";
						echo "Internet: ". $isp ."<br>";
						echo "Estado: ". $estado ." - ".$estado2 ."<br>";
						echo "Cidade: ". $cidade ."<br>";
						echo "Tempo: ". $time ."<br>";

					}else{
						echo "IP Invalido!";
					}
					
				}else{
					echo "";
				}
			?>
		</div>	
	</body>
</html>
