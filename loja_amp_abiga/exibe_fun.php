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
					<li><?php include "valida_login.php"; ?></li>
					<li><a href="logout.php" class="active">Sair</a></li>
				</ul>
			</div>
		</div>
		<div id="conteudo_especifico">
			<div class="div_central centralizar">
				<h1> EXIBIÇÃO DE DADOS DE USUÁRIO</h1>
			</div>

			<div class="div_esquerda menu_local">
				<?php
				include "menu_local.php";
				?>
			</div>
			<div id= "funcionalidade" class="div_direita">
				<?php
                    //Conexão com BD
                    $conectar = mysqli_connect("localhost", "root", "", "336076");

                    $codigo = $_GET["codigo"];

                    $sql_consulta = "SELECT nome_fun, login_fun, funcao_fun, status_fun
                    				 FROM funcionarios
                    				 WHERE cod_fun = '$codigo'"; 
                    $resultado_consulta = mysqli_query($conectar, $sql_consulta);
                    $registro = mysqli_fetch_row($resultado_consulta);

                    echo "<p>Nome: $registro[0] </p>";
                    echo "<p>Login: $registro[1]</p>";
                    echo "<p>Perfil: $registro[2]</p>";
                    echo "<p>Status: $registro[3]";
                 ?>   

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