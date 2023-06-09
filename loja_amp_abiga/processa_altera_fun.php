<?php 
    $conectar = mysqli_connect("localhost", "root", "", "336076");//Conexao com BD
     
    //2.Receber codigo e função
    $cod = $_POST["codigo"];
    $funcao = $_POST["funcao"];
      //3.1 Quando é adm altera senha  
    if($funcao == "administrador"){
        $senha = $_POST["senha"];
        $sql_altera = "UPDATE funcionarios 
                       SET senha_fun = '$senha'
                       WHERE cod_fun = '$cod'";
        $sql_resultado_alteracao = mysqli_query($conectar, $sql_altera);

		//Se alterou envia msg de sucesso
        if($sql_resultado_alteracao == true){
            echo "<script>
                    alert('Senha do administrador alterada com sucesso!')
                 </script>";
            echo "<script>
                    location.href = ('lista_fun.php')
                  </script>";
                
         exit();
        }
            //Senão envia msg de erro
        else{
            echo "<script>
                    alert('Ocorreu erro no servidor. Senha do administrador não foi alterada. Volte e tente de novo!')
                </script>";
            echo "<script>
                    location.href('altera_fun.php?codigo_fun=<?php echo $cod; ?>')
                </script>";
         exit();
        }
        //3.2 Outros usuários altera todos os dados
    } else{
        $nome = $_POST["nome"];
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $status = $_POST["status"];
        $funcao = $_POST["funcao"];

        $sql_consulta = "SELECT login_fun FROM funcionarios
                         WHERE login_fun = '$login'
                         AND cod_fun <> '$cod'"; //pesquisa logins exceto o próprio
       $sql_resultado = mysqli_query($conectar, $sql_consulta);

       $linhas = mysqli_num_rows($sql_resultado); //Conta as linhas de resultado
       //Validacao de login
       if($linhas == 1){
            echo "<script> 
                    alert('Login já existente. Tente outro')
                </script>";
            echo "<script> 
                    location.href('altera_fun.php?codigo_fun=<?php echo $codigo_fun; ?>')
                </script>";
            exit();
        }
		//Se login nao existir altera dados
        else{
            $sql_altera = "UPDATE funcionarios 
                           SET       nome_fun ='$nome',
                                     funcao_fun ='$funcao',
                                     login_fun ='$login',
                                     senha_fun ='$senha',
                                     status_fun ='$status'
                          WHERE      cod_fun ='$cod'";
            $sql_resultado_alteracao = mysqli_query($conectar, $sql_altera);

            if($sql_resultado_alteracao == true){
                echo "<script>
                        alert('$nome alterado com sucesso!')
                      </script>";
                echo "<script>
                      location.href = ('lista_fun.php')
                    </script> ";
                exit();
            }
            else{
                echo "<script>
                        alert('Ocorreu um erro no servidor.
                        Dados do funcionário não foram alterados. Tente de novo')
                      </script> ";
                echo "<script>
                      location.href('altera_fun.php?codigo_fun=<?php echo $codigo_fun; ?>')
                    </script> ";
                exit();
            }
        }    
    }

?>