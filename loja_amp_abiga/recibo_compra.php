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
				<h1>Recibo de Vendas</h1>

				<?php 
					$conectar = mysqli_connect("localhost", "root", "", "336076");// 1º Conexão com BD

					//2º Obter código do funcionário e a data
					$data = date ('d/m/Y');
					$cod_fun = $_SESSION["codigo"];
					$sql_registro_venda = "INSERT INTO vendas 
										   (data_ven, funcionarios_cod_fun) 
										   VALUES ('$data', '$cod_fun')";

					//Extrair pesquisa e colocar na  tabela					   
					$resultado_registro_venda = mysqli_query($conectar, $sql_registro_venda);					   
					//3º Inserir registro na tabela vendas
					//4º Pesquisa cod do registro e inserir na tabela
					$sql_consulta_ultima_venda = "SELECT cod_ven FROM vendas
												  ORDER BY cod_ven DESC LIMIT 1";

					$resultado_consulta = mysqli_query($conectar, $sql_consulta_ultima_venda);
												  

					$registro_cod_ven = mysqli_fetch_row($resultado_consulta);
					//5º Altera campo chave estrangeira na tabela amplificadores
					//E a situação para V
					$sql_codigo_venda_em_amp = "UPDATE amplificadores 
											SET vendas_cod_ven = '$registro_cod_ven[0]',
												fila_compra_amp = 'V'
											WHERE fila_compra_amp = 'S'";

					$resultado_alteracao_amp = mysqli_query($conectar, $sql_codigo_venda_em_amp);

					//6º Exibição dos dados
					$sql_consulta_recibo = "SELECT marca_amp, modelo_amp, preco_amp
											FROM amplificadores
											WHERE vendas_cod_ven = '$registro_cod_ven[0]' ";

					$resultado_consulta = mysqli_query($conectar, $sql_consulta_recibo);
					echo "<p> Venda nº: $registro_cod_ven[0]</p>";
					echo "<p> Data: $data </p>";
				?>

				<table>
					<tr>
						<td> Marca </td>
						<td> Modelo </td>
						<td> Preço </td>
					</tr>
					<?php
						$valor_total = 0;
						while ($registro = mysqli_fetch_row($resultado_consulta)) {
					?>
					<tr>
						<td> <?php echo "$registro[0]";?> </td> 
						<td> <?php echo "$registro[1]";?> </td>
						<td>
							<?php 
								echo "$registro[2]";
								$valor_total = $valor_total + $registro[2];
							?>
					 	</td>
					</tr>	
					<?php
						}
					?>	
				</table>
					<p> Total: <?php echo $valor_total; ?></p>
					<p> <a href="vendas.php"> Fechar Pedido </a> </p>
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