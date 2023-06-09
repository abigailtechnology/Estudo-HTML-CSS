<?php 
	if($_SESSION["funcao"] == "administrador"){
?>
	<ul>
	<li><a href="administracao.php">Administração</a></li>
		<li><a href="lista_fun.php">Funcionários</a></li>
		<li><a href="lista_amp.php">Amplificadores</a></li>
		<li><a href="vendas.php">Vendas </a></li>
		<li><a href="relatorios.php">Relatórios</a></li>
	</ul>
<?php
	}
	elseif($_SESSION["funcao"] == "estoquista"){
?>
	<ul>
		<li><a href="lista_amp.php">Amplificadores</a></li>
	</ul>
<?php		
	}
	else{
?>
	<ul>
		<li><a href="vendas.php">Vendas</li>
	</ul>
<?php
	}
?>