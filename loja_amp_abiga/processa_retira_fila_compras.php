<?php
	$conectar = mysqli_connect("localhost", "root", "", "336076");// 1º Conexão com BD

	$cod_amp = $_GET["codigo_amp"]; //2º Receber cod enviado via link

	//3º 
	$sql_altera = "UPDATE amplificadores
                   SET fila_compra_amp = 'N'
                   WHERE cod_amp = '$cod_amp'";

    $sql_resultado_alteracao = mysqli_query($conectar, $sql_altera);
     

     if ($sql_resultado_alteracao == true) {
     	//Script de satisfação


     	echo "<script>
     			alert('Amplificador retirado da fila de compra com sucesso!')
     		 </script>";
     	echo "<script> 
     	 		location.href = ('ver_fila_compras.php')
     	 	   </script>";	 
     	exit(); 	   
     }
     else{
     	echo "<script>
     			alert('Ocorreu um erro no servidor. O amplificador não foi retirado da fila de compras. Tente de novo!')
     		 </script>";
     	echo "<script> 
     	 		location.href = ('ver_fila_compras.php')
     	 	   </script>";	 
     }                
?>