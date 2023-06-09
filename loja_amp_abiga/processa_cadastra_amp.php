<?php
	
	//Conexão com BD
	$conectar = mysqli_connect("localhost", "root", "", "336076");

	//Entrada
	$marca = $_POST["marca"];
	$modelo = $_POST["modelo"];
	$preco = $_POST["preco"];
	$tipo = $_POST["tipo"];
	$foto = $_FILES["foto"];

	//Dados dos arquivos de imagem
	$foto_nome = "img/".$foto["name"];
	move_uploaded_file($foto["tmp_name"], $foto_nome);

	$sql_cadastrar = "INSERT INTO amplificadores (marca_amp, 
								  modelo_amp, preco_amp, tipo_amp, foto_amp)
	
						VALUES ('$marca' , '$modelo', '$preco', '$tipo', '$foto_nome')";

   $sql_resultado_cadastrar = mysqli_query($conectar, $sql_cadastrar);

   	if ($sql_resultado_cadastrar == true) {
   		echo "<script>
   				alert('$modelo cadastrado com sucesso!')
   		     </script>";
   		echo "<script>
   		 		location.href = ('cadastra_amp.php')
   		 	 </script>";
   	} else{
   		echo "<script>
   			  alert('Ocorreu um erro no servidor! Tente novamente!')
   			  </script>";
   		echo "<script>
   			location.href = ('cadastra_amp.php')
   			</script> ";
   	}
?>