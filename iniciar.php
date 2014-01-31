<?php
	session_start();
	require('classes/usuarios.php');
	$login = new Usuario();
	$login->Login($_POST['user'],md5($_POST['pass']));
    echo $login->Conectado();
?>