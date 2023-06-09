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
                        <li> <?php  include "valida_login.php";?> </li> 
                        <li><a href="logout.php" class="active">Sair</a></li>
				</ul>
			</div>
		</div>
		<div id="conteudo_especifico">
			<div class="div_central centralizar">
				<h1> ALTERAÇÃO DE AMPLIFICADORES </h1>
			</div>

			<div class="div_esquerda menu_local">
				<?php
					include "menu_local.php";
                ?>   
			</div>
			<div id= "funcionalidade" class="div_direita">
				<?php 
					$conectar = mysqli_connect("localhost", "root", "", "336076"); //Conexão com BD
					$codigo_amp = $_GET["codigo"]; //Receber cod enviado pelo link
					$sql_consulta = "SELECT cod_amp, marca_amp, modelo_amp, preco_amp, tipo_amp, foto_amp
                                     FROM amplificadores
									 WHERE cod_amp = '$codigo_amp'";
                    $resultado_consulta = mysqli_query($conectar, $sql_consulta);
					$registro = mysqli_fetch_row($resultado_consulta);
				?>
					<form method="post" action="processa_altera_amp.php" enctype="multipart/form-data">
					<input type="hidden" name="codigo" value="<?php echo $codigo_amp; ?>">
						<table >	
							<tr>
								<td>
									<p> Marca: </p>
								</td>
								<td>
									<p> <input type="text" name="marca" required value="<?php echo $registro[1]; ?>"> </p>
								</td>
							</tr>
							<tr>
								<td>
									<p> Modelo: </p>
								</td>
								<td> 
									<p> <input type="text" name="modelo" required value="<?php echo $registro[2]; ?>" > </p>
								</td>								
							</tr>
							<tr>
								<td> 
									<p> Preço: </p>
								</td>
								<td>
									<p> <input type="text" name="preco" required value="<?php echo $registro[3];?>"> </p>
								</td>
							</tr>
							<tr>
								<td> 
									<p> Foto: </p>
								</td>
								<td>
									<p> <input type="file" name="foto"> </p>
								</td>
							</tr>
							<tr>
								<td>
									<p> Tipo:  </p>
								</td>
								<td>
									<p>
										<select name="tipo">
											<option value="guitarra"
												<?php 
													if($registro[4] == "guitarra"){
														echo "selected";
													}
												?>> Guitarra </option>
											<option value="baixo"
												<?php 
													if($registro[4] == "baixo"){
														echo "selected";
													}
												?>> Baixo </option>
											<option value="violao"
												<?php 
													if($registro[4] == "violao"){
														echo "selected";
													}
												?>> Violão </option>
										</select>
									</p>
								</td>
							</tr>
							<!-- <tr>
								<td>
									<p>Situação</p>					
								</td>								
							</tr>-->
							<tr>
								<td colspan="2">
									<p> <input type="submit" value="Alterar Amplificador"> </p>
								</td>
							</tr>
						</table>
					</form>
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