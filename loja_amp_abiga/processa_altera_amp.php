<?php
    $conectar = mysqli_connect("localhost", "root", "", "336076"); //Conexão com BD

    //2. Receber dados 
    $cod = $_POST["codigo"];    //chave primária
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $preco = $_POST["preco"];
    $foto = $_FILES["foto"];
    $tipo = $_POST["tipo"];

    //3. Fazer alteração em função do código recebido
    if($foto["name"] <> ""){ //Se nome do arquivo for diferente de vazio
        $foto_nome = "img/".$foto["name"];
        move_uploaded_file($foto["tmp_name"], $foto_nome);
    }
    else{ //Se estiver vazio busca a foto anterior
        $pesquisa_foto = "SELECT foto_amp FROM amplificadores
                          WHERE cod_amp = '$cod'";

        $resultado_pesquisa_foto = mysqli_query($conectar, $pesquisa_foto);
        $registro_foto = mysqli_fetch_row($resultado_pesquisa_foto);
        $foto_nome = $registro_foto[0];
    }
    $sql_altera = "UPDATE
                       amplificadores
                   SET
                       marca_amp = '$marca',
                       modelo_amp = '$modelo',
                       preco_amp = '$preco',
                       tipo_amp = '$tipo',
                       foto_amp = '$foto_nome'
                  WHERE
                       cod_amp = '$cod' ";

    $sql_resultado_alteracao = mysqli_query ($conectar, $sql_altera);
    
    //4. Tenta alterar - Script da satisfação
    //4.1 Se der certo nvia mensagem de sucesso
    if($sql_resultado_alteracao == true){
        echo "<script>
                alert('$modelo alterado com sucesso!')
             </script>";
        echo "<script>
                location.href = ('lista_amp.php')
              </script>";
            
     exit();
    }
        //4.2 Se não alterar enviar msg de erro
    else{
        echo "<script>
                alert('Ocorreu erro no servidor. Dados não foram alterados. Volte e tente de novo!')
            </script>";
        echo "<script>
                location.href('altera_amp.php?codigo_fun=<?php echo $cod; ?>')
            </script>";
     exit();
    }

    
    

?>