<?php
    /* Página que recebe informações da index*/

    session_start();  //Função que permite que a variável de sessão funcione na página

    //Conectar no Banco de Dados
    $conectar = mysqli_connect("localhost", "root", "", "336076");

    //Entrada de Dados
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    //Verifica login e senha no B.D
    $sql_consulta = "SELECT cod_fun, nome_fun, login_fun, senha_fun, status_fun, funcao_fun
    				 FROM funcionarios
    				 WHERE
    				 		login_fun = '$login'
    				 AND 
    						senha_fun = '$senha'
    				 AND
    				 		status_fun = 'A' ";

	//Recebe tabela
   $resultado_consulta = mysqli_query($conectar, $sql_consulta);

   //Conta linhas de resultado da tabela
   $linhas = mysqli_num_rows ($resultado_consulta);

	   if($linhas == 1){

      //Coloca os dados da tabela no array $registro
      $registro = mysqli_fetch_row($resultado_consulta);

      //Variáveis de sessão
      $_SESSION["codigo"] = $registro[0]; //Recebe valor da posição 0
      $_SESSION["nome"] = $registro[1];
	  $_SESSION["login"] = $registro[2];
      $_SESSION["funcao"] = $registro[5];

      //Vai automaticante para a página administracao.php
	   	 echo "<script>
	   	 			location.href = ('administracao.php') 
	   		   </script>";
	   }
	   else{
	   	echo "<script>
	   			alert ('Login ou Senha Incorretos! Digite Novamente!!')
	   		</script>";
	   echo "<script> location.href = ('index.php')
	   		 </script>";		
	   }
?>