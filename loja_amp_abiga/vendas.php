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
				<h1> AMPLIFICADORES </h1>
			</div>

			<div class="div_esquerda menu_local">
				<?php
				include "menu_local.php";
				?>
			</div>
			<div id="funcionalidade" class="div_direita">

			<?php
					$conectar = mysqli_connect("localhost", "root", "", "336076"); //1º Conexão com BD

					//2º Pesquisar produtos que estão na prateleira
					$sql_consulta = "SELECT cod_amp, marca_amp, modelo_amp, tipo_amp, preco_amp
									 FROM 	amplificadores
									 WHERE vendas_cod_ven IS null
									 AND fila_compra_amp = 'N'";
					
					$resultado_consulta = mysqli_query($conectar, $sql_consulta);
					
					//3º Mostrar os produtos 
			?>

				<table>
					<tr>
						<td>
							<p> Marca </p>
						</td>
						<td>
							<p> Modelo </p>
						</td>
						<td>
							<p> Tipo </p>
				
						</td>
						<td>
							<p>Preço</p>

						</td>
						<td >
							<p> Ação </p>
						</td>
					</tr>
					<?php
						while($registro = mysqli_fetch_row($resultado_consulta))
						{
					?>
					<tr>
						<td>
							<p>
								<?php echo $registro[1]; ?>
							</p>
						</td>
						<td>
							<p>
								<a href="exibe_amp.php?codigo=<?php echo $registro[0]?>;">
								<?php echo $registro[2]; ?>
							</p>
						</td>
						<td>
							<p>
								 <?php echo $registro[3]; ?> 
							</p>
						</td>	
						<td>
							<p>
								 <?php echo $registro[4]; ?> 
							</p>
						</td>		
						<td>
							<p> 
								<a href="processa_fila_compras.php?codigo_amp=<?php echo $registro[0]?>">
									Colocar na fila de compras
								</a>
							</p>
						</td>
					</tr>
				<?php		
					}
				?>
				</table>	
				<p align="low"><a href = "ver_fila_compras.php">Ver fila de Compras</a></p>
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