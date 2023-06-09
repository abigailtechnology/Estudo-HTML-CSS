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
				<h1>TOTAL DE VENDAS</h1>
				<?php
						$conectar = mysqli_connect ("localhost", "root", "", "336076");			
						
						$data = date ('d/m/Y');
						
						$sql_consulta_total_vendas = "SELECT preco_amp
													  FROM amplificadores
													  WHERE fila_compra_amp = 'V'";
						
						$resultado_consulta = mysqli_query ($conectar, $sql_consulta_total_vendas);		
							
				
						$valor_total = 0;
						while ($registro_total_vendas = mysqli_fetch_row ($resultado_consulta))
						{
							$valor_total = $valor_total + $registro_total_vendas[0];
					
						}
					?>
					<p> Total de vendas até a presente data: <?php echo $valor_total; ?> </p>
					<p> <a href="relatorios.php"> Voltar </a> </p>
			</div>
			<div class="div_esquerda">
			</div>
			<div id="funcionalidade" class="div_direita">
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