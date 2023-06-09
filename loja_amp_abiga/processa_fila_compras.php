<?php
	$conectar = mysqli_connect("localhost", "root", "", "336076"); //1º Conexão com BD

	$cod_amp = $_GET ["codigo_amp"]; //2º Receber código que veio do link

	//3º Alteração
	 $sql_altera = "UPDATE amplificadores
                   SET fila_compra_amp = 'S'
                   WHERE cod_amp = '$cod_amp'";

     $sql_resultado_alteracao = mysqli_query($conectar, $sql_altera);
     

     if ($sql_resultado_alteracao == true) {
     	//Script de satisfação


     	echo "<script>
     			alert('Amplificador colocado na fila de compra com sucesso!')
     		 </script>";
     	echo "<script> 
     	 		location.href = ('vendas.php')
     	 	   </script>";	 
     	exit(); 	   
     }
     else{
     	echo "<script>
     			alert('Ocorreu um erro no servidor. O amplificador não foi colocado na fila de compras. Tente de novo!')
     		 </script>";
     	echo "<script> 
     	 		location.href = ('vendas.php')
     	 	   </script>";	 
     }
?>