<?php
	/* Página include responsável por validar o login */

	if ( isset($_SESSION["login"]) ) {
		
		echo "Olá ".$_SESSION["nome"];
	}
	else{
		echo "<script>
				alert('Você não está logado!!!')
			  </script>";
		echo "<script> 
				location.href = ('index.php') 
			  </script>";
	}
?>