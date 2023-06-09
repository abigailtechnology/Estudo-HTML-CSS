<?php 
	session_start(); 

	//Apaga o conteúdo das variáveis de sessão
	$_SESSION = array();
	session_unset(); // desconfigura sessão

	//Apaga/Encerra a sessão aberta
	echo "<script> 
			location.href = ('index.php')
		 </script>";

?>