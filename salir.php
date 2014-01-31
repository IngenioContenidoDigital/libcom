<?php
	session_start();
	require('classes/usuarios.php');
	$login = new Usuario();
	$login->Logout();
	header("Location: colombia.php"); 
?>