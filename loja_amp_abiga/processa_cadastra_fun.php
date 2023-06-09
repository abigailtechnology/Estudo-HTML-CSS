<?php
	/*CADASTRO DE FUNCIONÁRIO */

	//Conexão com BD
	$conectar = mysqli_connect("localhost", "root", "", "336076");

	//Entrada de dados da pág. cadastra_fun
	$nome = $_POST["nome"];
	$login = $_POST["login"];
	$senha = $_POST["senha"];
	$funcao = $_POST["funcao"];

	//Verificação de login
	$sql_consulta = "SELECT login_fun FROM funcionarios WHERE login_fun = '$login'";

	$resultado_consulta = mysqli_query($conectar,$sql_consulta); //retorna tabela

	$linhas = mysqli_num_rows($resultado_consulta); //Conta as linhas de resultado


	//Se tiver um login cadastrado aparece msg de erro e retorna p/ cadastra_fun.php
		if($linhas == 1){ //Se existe o usuário 

			echo "<script>
					alert('Login já cadastrado. Tente outro!')
				  </script>";
			echo "<script>
					location.href = ('cadastra_fun.php')
			      </script>";

		}
		else{ //Se não existir o usuário
			$sql_cadastrar = "INSERT INTO funcionarios (nome_fun,funcao_fun, login_fun,senha_fun)
							  VALUES ('$nome' , '$funcao', '$login', '$senha')";

		//Tenta inserir dados no BD
		$resultado_cadastrar = mysqli_query($conectar, $sql_cadastrar);
			if($resultado_cadastrar == true){
				echo "<script>
						alert('$nome cadastrado com sucesso!')
				      </script>";
				echo "<script>
					location.href = ('cadastra_fun.php')
				      </script>";
			}
			else{
				echo "<script>
						alert('Ocorreu um erro no servidor. Tente de novo!')
				      </script>";
				echo "<script>
						location.href = ('cadastra_fun.php')
				      </script>";
			}

		}
?>