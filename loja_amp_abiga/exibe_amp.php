<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
</head>

<body>
	<div id="principal">
		<div id="topo">
			<div id="logo">
				<h1> ROCK N'ROLL Amplificadores </h1>
				<h4> Controle de estoque e venda </h4>
			</div>
			<div id="menu_global" class="menu_global">
				<ul>
					<li> <?php include "valida_login.php"; ?> </li>
					<li><a href="logout.php" class="active">Sair</a></li>
				</ul>
			</div>
		</div>
		<div id="conteudo_especifico">
			<div class="div_central centralizar">
				<h1> EXIBIÇÃO DE AMPLIFICADORES </h1>
			</div>

			<div class="div_esquerda menu_local">
				<?php
				include "menu_local.php";
				?>
			</div>
			<div id="funcionalidade" class="div_direita">
					<?php
						$conectar = mysqli_connect("localhost", "root", "", "336076"); //Conexão com BD
						$codigo_amp = $_GET["codigo"]; //Receber cod enivado pelo link

						//Pesquisar dados no BD em função do cod
						$sql_consulta = "SELECT marca_amp,modelo_amp, tipo_amp, preco_amp,foto_amp 
										 FROM amplificadores
										 WHERE cod_amp = '$codigo_amp'";
						
						//Extrair os dados da pesquisa
						$resultado_pesquisa_amp = mysqli_query($conectar, $sql_consulta);

						//Exibir os dados do amplificador
						$registro_amp = mysqli_fetch_row($resultado_pesquisa_amp);
					?>
					<table >
						<tr>
							<td colspan="2">
								<img src="<?php echo "$registro_amp[4]"; ?>">
							</td>
						</tr>
						<tr>
							<td>
								<?php
							 		echo "<p> Marca: $registro_amp[0] </p>"; 
									echo "<p> Modelo:  $registro_amp[1] </p>"; 
								?>
							</td>
							<td>
								<?php
							 		echo "<p> Tipo: $registro_amp[2] </p>"; 
									echo "<p> Preço:  $registro_amp[3] </p>"; 
								?>
							</td>	
						</tr>
				</table>
			</div>
		</div>
		<div id="rodape">
			<div id="texto_institucional">
				<h6> AMPLI - CONTROL </h6>
				<h6> Rua do Rock, 666 -- E-mail: contato@ampli_control.com.br -- Fone: (61) 9966 - 6677 </h6>
			</div>
		</div>
	</div>
</body>

</html>